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
        <header class="py-10">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <nav class="relative z-50 flex justify-between">
                    <div class="flex items-center md:gap-x-12">
                        <a aria-label="Home" href="/" class="font-semibold">{{ config('app.name') }}</a>
                        <!-- <div class="hidden md:flex md:gap-x-6">
                            <a class="inline-block rounded-lg px-2 py-1 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900" href="#features">Features</a>
                            <a class="inline-block rounded-lg px-2 py-1 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900" href="#testimonials">Testimonials</a>
                            <a class="inline-block rounded-lg px-2 py-1 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900" href="#pricing">Pricing</a>
                        </div> -->
                    </div>
                    <div class="flex items-center gap-x-5 md:gap-x-8">
                        <a class="group inline-flex items-center justify-center rounded-full py-2 px-4 text-sm font-semibold focus:outline-none focus-visible:outline-2 focus-visible:outline-offset-2 bg-blue-600 text-white hover:text-slate-100 hover:bg-blue-500 active:bg-blue-800 active:text-blue-100 focus-visible:outline-blue-600 gap-2" color="blue" variant="solid" href="https://wa.me/33695831493" rel="noreferrer">
                            <span class="hidden md:block">{{ __('lang.whatsapp') }}</span>
                            <span class="md:hidden">WhatsApp</span>
                            <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-white"><title>WhatsApp</title><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                        </a>
                        <div class="-mr-1 md:hidden">
                            <div data-headlessui-state="">
                                <button class="relative z-10 flex h-8 w-8 items-center justify-center ui-not-focus-visible:outline-none" aria-label="Toggle Navigation" type="button" aria-expanded="false" data-headlessui-state="" id="headlessui-popover-button-:Rbpnla:">
                                    <svg aria-hidden="true" class="h-3.5 w-3.5 overflow-visible stroke-slate-700" fill="none" stroke-width="2" stroke-linecap="round"><path d="M0 1H14M0 7H14M0 13H14" class="origin-center transition"></path><path d="M2 2L12 12M12 2L2 12" class="origin-center transition scale-90 opacity-0"></path></svg>
                                </button>
                            </div>
                            <div style="position:fixed;top:1px;left:1px;width:1px;height:0;padding:0;margin:-1px;overflow:hidden;clip:rect(0, 0, 0, 0);white-space:nowrap;border-width:0;display:none"></div>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
        <main>
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pb-16 pt-20 text-center lg:pt-32">
                <h1 class="mx-auto max-w-4xl font-display text-5xl font-medium tracking-tight text-slate-900 sm:text-7xl">{{ __('lang.heading.1') }}</h1>
                <p class="mx-auto mt-6 max-w-2xl text-lg tracking-tight text-slate-700">{{ __('lang.heading.2') }}</p>
                <div class="mt-10 flex justify-center gap-x-6">
                    <a class="group inline-flex items-center justify-center rounded-full py-4 px-8 text-xl font-semibold focus:outline-none focus-visible:outline-2 focus-visible:outline-offset-2 bg-slate-900 text-white hover:bg-slate-700 hover:text-slate-100 active:bg-slate-800 active:text-slate-300 focus-visible:outline-slate-900 gap-1" variant="solid" color="slate" href="{{ route('booking') }}">
                        <span>{{ __('lang.book') }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                        </svg>
                    </a>
                </div>
            </div>
            <section id="get-started-today" class="relative overflow-hidden bg-blue-600 py-32">
                <img alt="" loading="lazy" width="2347" height="1244" decoding="async" data-nimg="1" class="absolute left-1/2 top-1/2 max-w-none -translate-x-1/2 -translate-y-1/2" style="color:transparent" src="/_next/static/media/background-call-to-action.6a5a5672.jpg">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative">
                    <div class="mx-auto max-w-lg text-center">
                        <h2 class="font-display text-3xl tracking-tight text-white sm:text-4xl">{{ __('lang.heading.3') }}</h2>
                        <p class="mt-4 text-lg tracking-tight text-white">{{ __('lang.heading.4') }}</p>
                        <a class="group inline-flex items-center justify-center rounded-full py-4 px-8 text-xl font-semibold focus:outline-none focus-visible:outline-2 focus-visible:outline-offset-2 bg-white text-slate-900 hover:bg-blue-50 active:bg-blue-200 active:text-slate-600 focus-visible:outline-white mt-10 gap-1" color="white" variant="solid" href="tel:+33695831493">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd" d="M1.5 4.5a3 3 0 0 1 3-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 0 1-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 0 0 6.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 0 1 1.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 0 1-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5Z" clip-rule="evenodd" />
                            </svg>
                            <span>(+33) 6 95 83 14 93</span>
                        </a>
                    </div>
                </div>
            </section>
            <section id="secondary-features" aria-label="Features for simplifying everyday business tasks" class="pb-14 pt-20 sm:pb-20 sm:pt-32 lg:pb-32">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="mx-auto max-w-2xl md:text-center">
                        <h2 class="font-display text-3xl tracking-tight text-slate-900 sm:text-4xl">{{ __('lang.heading.5') }}</h2>
                        <p class="mt-4 text-lg tracking-tight text-slate-700">{{ __('lang.heading.6') }}</p>
                    </div>
                    <!-- <div class="-mx-4 mt-20 flex flex-col gap-y-10 overflow-hidden px-4 sm:-mx-6 sm:px-6 lg:hidden">
                        <div>
                            <div class="mx-auto max-w-2xl">
                                <div class="w-9 rounded-lg bg-blue-600"><svg aria-hidden="true" class="h-9 w-9" fill="none">
                                        <defs>
                                            <linearGradient id=":R2menla:" x1="11.5" y1="18" x2="36" y2="15.5" gradientUnits="userSpaceOnUse">
                                                <stop offset=".194" stop-color="#fff"></stop>
                                                <stop offset="1" stop-color="#6692F1"></stop>
                                            </linearGradient>
                                        </defs>
                                        <path d="m30 15-4 5-4-11-4 18-4-11-4 7-4-5" stroke="url(#:R2menla:)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg></div>
                                <h3 class="mt-6 text-sm font-medium text-blue-600">Reporting</h3>
                                <p class="mt-2 font-display text-xl text-slate-900">Stay on top of things with always up-to-date reporting features.</p>
                                <p class="mt-4 text-sm text-slate-600">We talked about reporting in the section above but we needed three items here, so mentioning it one more time for posterity.</p>
                            </div>
                        </div>
                        <div>
                            <div class="mx-auto max-w-2xl">
                                <div class="w-9 rounded-lg bg-blue-600"><svg aria-hidden="true" class="h-9 w-9" fill="none">
                                        <path opacity=".5" d="M8 17a1 1 0 0 1 1-1h18a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H9a1 1 0 0 1-1-1v-2Z" fill="#fff"></path>
                                        <path opacity=".3" d="M8 24a1 1 0 0 1 1-1h18a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H9a1 1 0 0 1-1-1v-2Z" fill="#fff"></path>
                                        <path d="M8 10a1 1 0 0 1 1-1h18a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H9a1 1 0 0 1-1-1v-2Z" fill="#fff"></path>
                                    </svg></div>
                                <h3 class="mt-6 text-sm font-medium text-blue-600">Inventory</h3>
                                <p class="mt-2 font-display text-xl text-slate-900">Never lose track of what’s in stock with accurate inventory tracking.</p>
                                <p class="mt-4 text-sm text-slate-600">We don’t offer this as part of our software but that statement is inarguably true. Accurate inventory tracking would help you for sure.</p>
                            </div>
                        </div>
                        <div>
                            <div class="mx-auto max-w-2xl">
                                <div class="w-9 rounded-lg bg-blue-600"><svg aria-hidden="true" class="h-9 w-9" fill="none">
                                        <path opacity=".5" d="M25.778 25.778c.39.39 1.027.393 1.384-.028A11.952 11.952 0 0 0 30 18c0-6.627-5.373-12-12-12S6 11.373 6 18c0 2.954 1.067 5.659 2.838 7.75.357.421.993.419 1.384.028.39-.39.386-1.02.036-1.448A9.959 9.959 0 0 1 8 18c0-5.523 4.477-10 10-10s10 4.477 10 10a9.959 9.959 0 0 1-2.258 6.33c-.35.427-.354 1.058.036 1.448Z" fill="#fff"></path>
                                        <path d="M12 28.395V28a6 6 0 0 1 12 0v.395A11.945 11.945 0 0 1 18 30c-2.186 0-4.235-.584-6-1.605ZM21 16.5c0-1.933-.5-3.5-3-3.5s-3 1.567-3 3.5 1.343 3.5 3 3.5 3-1.567 3-3.5Z" fill="#fff"></path>
                                    </svg></div>
                                <h3 class="mt-6 text-sm font-medium text-blue-600">Contacts</h3>
                                <p class="mt-2 font-display text-xl text-slate-900">Organize all of your contacts, service providers, and invoices in one place.</p>
                                <p class="mt-4 text-sm text-slate-600">This also isn’t actually a feature, it’s just some friendly advice. We definitely recommend that you do this, you’ll feel really organized and professional.</p>
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="hidden lg:mt-20 lg:block"> -->
                    <div class="mt-10 lg:mt-20 lg:block">
                        <div role="tablist" aria-orientation="horizontal">
                            <div class="relative overflow-x-auto">
                                <!-- <div class="w-9 rounded-lg bg-blue-600">
                                    <svg aria-hidden="true" class="h-9 w-9" fill="none">
                                        <defs>
                                            <linearGradient id=":Rarenla:" x1="11.5" y1="18" x2="36" y2="15.5" gradientUnits="userSpaceOnUse">
                                                <stop offset=".194" stop-color="#fff"></stop>
                                                <stop offset="1" stop-color="#6692F1"></stop>
                                            </linearGradient>
                                        </defs>
                                        <path d="m30 15-4 5-4-11-4 18-4-11-4 7-4-5" stroke="url(#:Rarenla:)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </div> -->
                                <!-- <h3 class="mt-6 font-display text-xl text-slate-900">Ponctualité et disponibilité</h3> -->
                                <!-- <p class="mt-4 text-sm text-slate-600"></p> -->
                                <table class="border-collapse table-auto w-max md:w-full text-sm">
                                    <thead>
                                        <tr>
                                            <th class="border-b font-display text-sm text-slate-900 p-4 text-left">Trajet simple</th>
                                            <th class="border-b font-display text-sm text-slate-900 p-4">
                                                <span class="flex gap-2 justify-end items-center">
                                                    <span>Berline</span>
                                                    <span class="flex gap-1 items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                                        </svg>
                                                        4
                                                    </span>
                                                    <span class="flex gap-1 items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                                        </svg>
                                                        2/3
                                                    </span>
                                                </span>
                                            </th>
                                            <th class="border-b font-display text-sm text-slate-900 p-4">
                                                <span class="flex gap-2 justify-end items-center">
                                                    <span>Van</span>
                                                    <span class="flex gap-1 items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                                        </svg>
                                                        7
                                                    </span>
                                                    <span class="flex gap-1 items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                                        </svg>
                                                        6
                                                    </span>
                                                </span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white">
                                        <tr class="cursor-pointer hover:bg-slate-50" onclick="window.location='{{ route('booking') }}'">
                                            <td class="border-b border-slate-100 p-4 text-slate-500 text-left flex items-center gap-2">
                                                <span>Paris</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21 3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                                                </svg>
                                                <span>Aéroport Paris-Charles de Gaulle</span>
                                            </td>
                                            <td class="border-b border-slate-100 p-4 text-slate-500 text-right">50,00 €</td>
                                            <td class="border-b border-slate-100 p-4 text-slate-500 text-right">70,00 €</td>
                                        </tr>
                                        <tr class="cursor-pointer hover:bg-slate-50" onclick="window.location='{{ route('booking') }}'">
                                            <td class="border-b border-slate-100 p-4 text-slate-500 text-left flex items-center gap-2">
                                                <span>Paris</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21 3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                                                </svg>
                                                <span>Aéroport Paris-Orly</span>
                                            </td>
                                            <td class="border-b border-slate-100 p-4 text-slate-500 text-right">40,00 €</td>
                                            <td class="border-b border-slate-100 p-4 text-slate-500 text-right">60,00 €</td>
                                        </tr>
                                        <tr class="cursor-pointer hover:bg-slate-50" onclick="window.location='{{ route('booking') }}'">
                                            <td class="border-b border-slate-100 p-4 text-slate-500 text-left flex items-center gap-2">
                                                <span>Paris</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21 3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                                                </svg>
                                                <span>Disneyland Paris</span>
                                            </td>
                                            <td class="border-b border-slate-100 p-4 text-slate-500 text-right">60,00 €</td>
                                            <td class="border-b border-slate-100 p-4 text-slate-500 text-right">80,00 €</td>
                                        </tr>
                                        <tr class="cursor-pointer hover:bg-slate-50" onclick="window.location='{{ route('booking') }}'">
                                            <td class="border-b border-slate-100 p-4 text-slate-500 text-left flex items-center gap-2">
                                                <span>Aéroport Paris-Charles de Gaulle</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21 3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                                                </svg>
                                                <span>Disneyland Paris</span>
                                            </td>
                                            <td class="border-b border-slate-100 p-4 text-slate-500 text-right">50,00 €</td>
                                            <td class="border-b border-slate-100 p-4 text-slate-500 text-right">70,00 €</td>
                                        </tr>
                                        <tr class="cursor-pointer hover:bg-slate-50" onclick="window.location='{{ route('booking') }}'">
                                            <td class="border-b border-slate-100 p-4 text-slate-500 text-left flex items-center gap-2">
                                                <span>Aéroport Paris-Orly</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21 3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                                                </svg>
                                                <span>Disneyland Paris</span>
                                            </td>
                                            <td class="border-b border-slate-100 p-4 text-slate-500 text-right">60,00 €</td>
                                            <td class="border-b border-slate-100 p-4 text-slate-500 text-right">70,00 €</td>
                                        </tr>
                                        <tr class="cursor-pointer hover:bg-slate-50" onclick="window.location='{{ route('booking') }}'">
                                            <td class="border-b border-slate-100 p-4 text-slate-500 text-left flex items-center gap-2">
                                                <span>Paris</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21 3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                                                </svg>
                                                <span>Aéroport Paris-Beauvais</span>
                                            </td>
                                            <td class="border-b border-slate-100 p-4 text-slate-500 text-right">130,00 €</td>
                                            <td class="border-b border-slate-100 p-4 text-slate-500 text-right">160,00 €</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="faq" aria-labelledby="faq-title" class="relative overflow-hidden bg-slate-50 py-20 sm:py-32">
                <img alt="" loading="lazy" width="1558" height="946" decoding="async" data-nimg="1" class="absolute left-1/2 top-0 max-w-none -translate-y-1/4 translate-x-[-30%]" style="color:transparent" src="/_next/static/media/background-faqs.55d2e36a.jpg">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative">
                    <div class="mx-auto max-w-2xl lg:mx-0">
                        <h2 id="faq-title" class="font-display text-3xl tracking-tight text-slate-900 sm:text-4xl">Questions fréquentes.</h2>
                        <p class="mt-4 text-lg tracking-tight text-slate-700">Retrouvez ici les réponses à toutes vos interrogations.</p>
                    </div>
                    <ul role="list" class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-8 lg:max-w-none lg:grid-cols-3">
                        <li>
                            <ul role="list" class="flex flex-col gap-y-8">
                                <li>
                                    <h3 class="font-display text-lg leading-7 text-slate-900">Comment puis-je réserver un trajet ?</h3>
                                    <p class="mt-4 text-sm text-slate-700">Vous pouvez réserver un trajet en remplissant le <a href="{{ route('booking') }}" class="text-indigo-600 underline hover:no-underline">formulaire de réservation</a>.</p>
                                    <p class="mt-4 text-sm text-slate-700 font-semibold">Lors de la réservation, nous vous laissons le choix d'effectuer le paiement en ligne ou de payer plus tard.</p>
                                </li>
                                <li>
                                    <h3 class="font-display text-lg leading-7 text-slate-900">Quels sont les modes de paiement acceptés ?</h3>
                                    <p class="mt-4 text-sm text-slate-700">Nous acceptons les paiements par carte de crédit uniquement pour les réservations effectuées depuis le <a href="{{ route('booking') }}" class="text-indigo-600 underline hover:no-underline">formulaire de réservation</a>.</p>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <ul role="list" class="flex flex-col gap-y-8">
                                <li>
                                    <h3 class="font-display text-lg leading-7 text-slate-900">Puis-je annuler ma réservation ?</h3>
                                    <p class="mt-4 text-sm text-slate-700">Oui, vous pouvez annuler votre réservation gratuitement.</p>
                                    <p class="mt-4 text-sm text-slate-700">Veuillez contacter notre service clientèle pour obtenir des informations spécifiques sur l'annulation ou la modification d'une réservation après avoir effectué le paiement en ligne.</p>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <ul role="list" class="flex flex-col gap-y-8">
                                <li>
                                    <h3 class="font-display text-lg leading-7 text-slate-900">Y a-t-il des frais supplémentaires pour les bagages volumineux ?</h3>
                                    <p class="mt-4 text-sm text-slate-700">Non, nous ne facturons pas de frais supplémentaires pour les bagages volumineux. Assurez-vous simplement de mentionner le nombre et la taille des bagages lors de la réservation.</p>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </section>
        </main>
        <footer class="bg-slate-50">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="py-16">
                    <nav class="mt-10 text-sm" aria-label="quick links">
                        <div class="-my-1 flex justify-center gap-x-6 flex-col md:flex-row md:text-center">
                            <a class="inline-block rounded-lg px-2 py-1 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900" href="/">Accueil</a>
                            <a class="inline-block rounded-lg px-2 py-1 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900" href="{{ route('booking') }}">Réserver un trajet</a>
                        </div>
                    </nav>
                    <nav class="mt-10 text-sm" aria-label="quick links">
                        <div class="-my-1 flex justify-center gap-x-6 flex-col md:flex-row md:text-center">
                            <a class="inline-block rounded-lg px-2 py-1 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900" href="{{ route('booking') }}">Transferts Paris-Charles de Gaulle (CDG)</a>
                            <a class="inline-block rounded-lg px-2 py-1 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900" href="{{ route('booking') }}">Transferts Paris-Orly (ORY)</a>
                            <a class="inline-block rounded-lg px-2 py-1 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900" href="{{ route('booking') }}">Aéroport vers Disneyland Paris</a>
                            <a class="inline-block rounded-lg px-2 py-1 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900" href="{{ route('booking') }}">Aéroport vers Paris</a>
                        </div>
                    </nav>
                </div>
                <div class="flex flex-col items-center border-t border-slate-400/10 py-10 sm:flex-row-reverse sm:justify-between">
                    <div class="flex gap-x-6">
                        <a class="group" aria-label="WhatsApp" href="https://wa.me/33695831493" rel="noreferrer">
                            <svg class="h-6 w-6 fill-slate-500 group-hover:fill-slate-700" aria-hidden="true" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                            </svg>
                        </a>
                    </div>
                    <p class="mt-6 text-sm text-slate-500 sm:mt-0">{{ config('app.name') }}</p>
                </div>
            </div>
        </footer>
    </body>
</html>
