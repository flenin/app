<?php

namespace App\Services;

use App\Contracts\MapInterface;

use Illuminate\Support\Facades\Http;

class Google implements MapInterface
{
    public function distance($from_location, $to_location)
    {
        $response = Http::get('https://maps.googleapis.com/maps/api/distancematrix/json?parameters', [
            'origins' => 'place_id:'.$from_location,
            'destinations' => 'place_id:'.$to_location,
            'key' => env('GOOGLE_API_KEY'),
        ]);

        if ($response->ok()) {
            return $response->json();
        }

        return false;
    }
}
