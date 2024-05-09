<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Lang;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

class WelcomeController extends Controller
{
    public function show(Request $request): View
    {
        return view('welcome', [
            'trans' => collect(Lang::get('booking'))->toJson(),
            'times' => collect(CarbonPeriod::since('00:00')->minutes(15)->until('23:45'))->map(function (Carbon $date) {
                return $date->format('H:i');
            }),
        ]);
    }
}
