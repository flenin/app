<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth bg-white antialiased">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.bunny.net/css?family=lexend:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @viteReactRefresh
        @vite(['resources/css/app.css', 'resources/js/app.jsx'])
    </head>
    <body class="flex h-full flex-col">
        <div class="bg-white py-24 sm:py-32">
            <div class="mx-auto max-w-7xl px-6">
                <div class="mx-auto max-w-2xl">
                    <h2 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">@yield('title')</h2>
                    <p class="mt-6 text-lg leading-8 text-gray-600">@yield('text1')</p>
                    <p class="mt-2 text-lg leading-8 text-gray-600">@yield('text2')</p>
                    <div class="mt-10 flex justify-center gap-x-6">
                        <a class="group inline-flex items-center justify-center rounded-full py-4 px-8 text-xl font-semibold focus:outline-none focus-visible:outline-2 focus-visible:outline-offset-2 bg-slate-900 text-white hover:bg-slate-700 hover:text-slate-100 active:bg-slate-800 active:text-slate-300 focus-visible:outline-slate-900 gap-1" variant="solid" color="slate" href="{{ route('welcome') }}">{{ __('booking.back.to.home') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
