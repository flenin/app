<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class WelcomeController extends Controller
{
    public function show(Request $request): View
    {
        return view('welcome');
    }

    public function stripe(Request $request): RedirectResponse
    {
        $stripe = new \Stripe\StripeClient('sk_test_51MQBtPLZqABXcdlvilYHvso34BPdvMV3argBY1KfXpdAMpOJGGhxyH0Ctrq2FLIl3t0xRqJGLpTg0mvbDJuH9SeK00rRriGAj8');

        $checkout_session = $stripe->checkout->sessions->create([
            'line_items' => [[
                'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                    'name' => 'T-shirt',
                ],
                'unit_amount' => 2000,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => 'http://localhost:4242/success',
            'cancel_url' => 'http://localhost:4242/cancel',
        ]);

        // header("HTTP/1.1 303 See Other");
        // header("Location: " . $checkout_session->url);

        return redirect()->away($checkout_session->url);
    }
}
