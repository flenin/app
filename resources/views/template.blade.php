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

        <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA52bbn4yHE2fKCnpUiCVQSHaPYQHmvwmI&libraries=places&callback=initMap"></script>

        <!-- Styles -->
        @viteReactRefresh
        @vite(['resources/css/app.css', 'resources/js/app.jsx'])
    </head>
    <body class="flex h-full flex-col">
        <div class="relative flex min-h-full shrink-0 justify-center md:px-12 lg:px-0">
            <div class="relative z-10 flex flex-1 flex-col bg-white px-4 py-10 shadow-2xl sm:justify-center md:flex-none md:px-28">
                <main class="mx-auto w-full max-w-md sm:px-4 md:w-96 md:max-w-sm md:px-0">
                    <div class="flex">
                        <a aria-label="Home" href="/">{{ config('app.name') }}</a>
                    </div>
                    @yield('content')
                </main>
            </div>
            <div class="hidden sm:contents lg:relative lg:block lg:flex-1"></div>
        </div>
    </body>
</html>
