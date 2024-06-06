<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

use App\Models\Trip;
use App\Models\Voucher;
use App\Models\Location;
use App\Http\Requests\BookingRequest;
use App\Http\Resources\TripResource;
use App\Facades\Mobile;
use App\Facades\Map;
use Illuminate\Validation\ValidationException;
use Stripe\StripeClient;

class BookingController extends Controller
{
    public function store(BookingRequest $request): mixed
    {
        $trip = $request->session()->get('tripId');

        if ($trip !== null) {
            $trip = Trip::find($trip);
        }

        if ($trip === null) {
            $trip = Trip::create();

            $request->session()->put('tripId', $trip->id);
        }

        $validated = $request->validated();

        $trip->fill($validated);

        if ($validated['step'] < 4) {
            switch ($validated['step']) {
                case '0':
                    $json = Cache::rememberForever(sha1($validated['from_location']).sha1($validated['to_location']), function () use ($validated) {
                        return Map::distance($validated['from_location'], $validated['to_location']);
                    });

                    if ($json !== false) {
                        if ($json['status'] === 'OK') {
                            $origin_addresses = $json['origin_addresses'][0] ?? '';
                            $destination_addresses = $json['destination_addresses'][0] ?? '';
                            $rows = $json['rows'][0]['elements'][0] ?? [];

                            if (!empty($rows)) {
                                if ($rows['status'] === 'OK') {
                                    $distance = $rows['distance']['value'];
                                    $duration = $rows['duration']['value'];

                                    $location = Location::firstOrCreate(
                                        [
                                            'from_place_id' => $validated['from_location'],
                                            'to_place_id' => $validated['to_location'],
                                        ],
                                        [
                                            'from_address' => $origin_addresses,
                                            'to_address' => $destination_addresses,
                                            'distance' => $distance,
                                            'duration' => $duration,
                                        ],
                                    );

                                    $trip->location()->associate($location);
                                }
                            }
                        }
                    }

                    if (!empty($validated['voucher'])) {
                        $voucher = Voucher::where('code', $validated['voucher'])->first();

                        if ($voucher !== null) {
                            $trip->voucher()->associate($voucher);
                        }
                    } else {
                        if ($trip->voucher !== null) {
                            $trip->voucher()->dissociate();
                        }
                    }

                    if (
                        empty($location)
                        || (($location->distance / 1000) > 300)
                    ) {
                        throw ValidationException::withMessages([
                            'from_location' => 'Impossible deffectuer cette course 1',
                        ]);
                    }

                    $trip->amount = ceil($location->distance / 1000 * env('COST_PER_KILOMETER'));

                    if ($trip->amountWithVoucher < 10) {
                        throw ValidationException::withMessages([
                            'from_location' => 'Impossible deffectuer cette course 2',
                        ]);
                    }

                    if (($validated['adults'] + $validated['children']) > 4) {
                        $trip->amount += 20;
                    }

                    break;
            }

            $trip->save();

            return new TripResource($trip);
        }

        do {
            $url = Str::random(5);
            $url = Str::of($url)->lower();
        } while (DB::table('trips')->where('url', $url)->exists());

        $trip->url = $url;

        $trip->save();

        Mobile::notify("New trip {$url}");

        $request->session()->forget('tripId');

        return (new TripResource($trip))
            ->additional([
                'stripe_url' => route('booking.stripe', ['trip' => $url]),
            ]);
    }

    public function stripe(Request $request, Trip $trip): RedirectResponse
    {
        $stripe = new StripeClient(env('STRIPE_API_KEY'));

        $checkout_session = $stripe->checkout->sessions->create([
            'line_items' => [[
                'price_data' => [
                'currency' => 'eur',
                'product_data' => [
                    'name' => config('app.name'),
                ],
                'unit_amount' => $trip->amount * 100,
                ],
                'quantity' => 1,
        ]],
            'mode' => 'payment',
            'success_url' => Str::replace('CHECKOUT_SESSION_ID', '{CHECKOUT_SESSION_ID}', route('booking.success', ['trip' => $trip, 'session_id' => 'CHECKOUT_SESSION_ID'])),
            'cancel_url' => route('booking.cancel', ['trip' => $trip]),
        ]);

        return redirect()->away($checkout_session->url);
    }

    public function success(Request $request, Trip $trip, $session_id): mixed
    {
        $stripe = new StripeClient(env('STRIPE_API_KEY'));

        try {
            $session = $stripe->checkout->sessions->retrieve($session_id);

            $trip->paid = true;

            $trip->save();

            Mobile::notify("Paid {$trip->url}");

            return view('success');
        } catch (Error $e) {
            return redirect()->route('booking.cancel', ['trip' => $trip]);
        }
    }

    public function cancel(Request $request, Trip $trip): View
    {
        return view('cancel');
    }
}
