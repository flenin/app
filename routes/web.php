<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\WelcomeController;

use App\Http\Middleware\SetLocale;
use App\Http\Middleware\EnsureTripIsNotPaid;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware([SetLocale::class])->group(function () {
    Route::get('/', [WelcomeController::class, 'show'])->name('welcome');

    Route::post('/booking', [BookingController::class, 'store']);

    Route::get('/terms', [WelcomeController::class, 'terms'])->name('terms');

    Route::middleware([EnsureTripIsNotPaid::class])->group(function () {
        Route::get('/booking/{trip:url}', [BookingController::class, 'stripe'])->name('booking.stripe');
        Route::get('/booking/{trip:url}/cancel', [BookingController::class, 'cancel'])->name('booking.cancel');
        Route::get('/booking/{trip:url}/{session_id}/success', [BookingController::class, 'success'])->name('booking.success');
    });

    Route::get('/{lang}', [LocaleController::class, 'store'])->where('lang', 'fr|en');
});
