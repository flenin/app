<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class LocaleController extends Controller
{
    public function store(Request $request, $lang): RedirectResponse
    {
        $request->session()->put('locale', $lang);

        return back();
    }
}
