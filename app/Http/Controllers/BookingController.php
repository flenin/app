<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

use App\Models\Trip;
use App\Models\Voucher;
use App\Models\Location;
use App\Http\Requests\BookingRequest;
use App\Http\Resources\TripResource;

use Carbon\Carbon;
use Stripe\StripeClient;

use Carbon\CarbonPeriod;

class BookingController extends Controller
{
    public function show(Request $request): View
    {
        return view('booking', [
            'trans' => collect(Lang::get('booking'))->toJson(),
            'times' => collect(CarbonPeriod::since('00:00')->minutes(15)->until('23:45'))->map(function (Carbon $date) {
                return $date->format('H:i');
            }),
        ]);
    }

    public function store(BookingRequest $request): mixed
    {
        $validated = $request->validated();

        if ($request->session()->has('tripId')) {
            $trip = Trip::findOrFail($request->session()->get('tripId'));
        } else {
            $trip = new Trip();
            $trip->save();

            $request->session()->put('tripId', $trip->id);
        }

        $trip->fill($validated);

        if ($validated['step'] < 3) {
            switch ($validated['step']) {
                case '0':
                    $json = Cache::rememberForever(sha1($validated['from_location']).sha1($validated['to_location']), function () use ($validated) {
                        $response = Http::get('https://maps.googleapis.com/maps/api/distancematrix/json?parameters', [
                            'origins' => 'place_id:'.$validated['from_location'],
                            'destinations' => 'place_id:'.$validated['to_location'],
                            'key' => env('GOOGLE_API_KEY'),
                        ]);

                        if ($response->ok()) {
                            return $response->json();
                        }

                        return false;
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

                    if ($location->isDirty()) {
                        // TODO : Throw error
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

                    $trip->amount = ceil($location->distance / 1000 * 1.77);

                    if (($validated['adults'] + $validated['children']) > 4) {
                        $trip->amount += 20;
                    }

                    // if amount == 0 : exit

                    break;
            }

            $trip->save();

            return new TripResource($trip);
        }

        do {
            $url = Str::random(5);
        } while (DB::table('trips')->where('url', $url)->exists());

        $trip->url = $url;

        $trip->save();

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
            'cancel_url' => route('booking'), // TODO
        ]);

        return redirect()->away($checkout_session->url);
    }

    public function success(Request $request, Trip $trip, $session_id): View
    {
        $stripe = new StripeClient(env('STRIPE_API_KEY'));

        try {
            $session = $stripe->checkout->sessions->retrieve($session_id);

            $trip->paid = true;

            $trip->save();

            return view('booking', [
            ]);
        } catch (Error $e) {
            return view('booking', [
            ]);
        }
    }
}
