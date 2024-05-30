<?php

namespace App\Services;

use App\Contracts\MobileInterface;

use Illuminate\Support\Facades\Http;

class Free implements MobileInterface
{
    public function notify($message)
    {
        Http::get('https://smsapi.free-mobile.fr/sendmsg', [
            'user' => '39856842',
            'pass' => 'myziqKTAmRfxWn',
            'msg' => $message,
        ]);

        Http::get('https://smsapi.free-mobile.fr/sendmsg', [
            'user' => '44125057',
            'pass' => 'YCSBr3Rpnk1YNs',
            'msg' => $message,
        ]);
    }
}
