<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth bg-white antialiased app-bg">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.bunny.net/css?family=lexend:400,600&display=swap" rel="stylesheet" />

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA52bbn4yHE2fKCnpUiCVQSHaPYQHmvwmI&libraries=places&callback=initMap"></script>

        <!-- Styles -->
        @viteReactRefresh
        @vite(['resources/css/app.css', 'resources/js/app.jsx'])
    </head>
    <body class="flex h-full flex-col">
        <header class="py-10">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <nav class="relative z-50 flex justify-between">
                    <div class="flex items-center md:gap-x-12">
                        <a aria-label="Home" href="/" class="font-semibold text-xl">{{ config('app.name') }}</a>
                    </div>
                    <div class="flex items-center gap-x-5 md:gap-x-8">
                        <a class="group inline-flex items-center justify-center rounded-full py-2 px-4 text-base font-semibold focus:outline-none focus-visible:outline-2 focus-visible:outline-offset-2 bg-[#25d366] text-white hover:bg-[#25d366bf] active:bg-[#25d366] focus-visible:outline-[#25d366] gap-2 shadow-sm" color="green" variant="solid" href="https://wa.me/33695831493" rel="noreferrer">
                            <span class="hidden md:block">{{ __('lang.whatsapp') }}</span>
                            <span class="md:hidden">WhatsApp</span>
                            <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 fill-white"><title>WhatsApp</title><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                        </a>
                    </div>
                </nav>
            </div>
        </header>
        <main>
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pb-16 pt-20 lg:pt-32">
                <div class="grid gap-4 grid-cols-1 lg:grid-cols-3">
                    <div class="order-2 lg:order-1 bg-white rounded-xl shadow-xl p-6">
                        <div
                            id="root"
                            data-trans="{{ $trans }}"
                            data-times="{{ $times }}"
                        ></div>
                    </div>
                    <div class="order-1 lg:order-2 lg:col-span-2 text-center">
                        <h1 class="mx-auto max-w-4xl font-display text-5xl font-medium tracking-tight text-white sm:text-7xl">{{ __('lang.heading.1') }}</h1>
                        <p class="mx-auto mt-6 max-w-2xl text-lg tracking-tight text-white">{{ __('lang.heading.2') }}</p>
                        <div class="mt-10 flex justify-center gap-x-6">
                            <a class="group inline-flex items-center justify-center rounded-full py-4 px-8 text-xl font-semibold focus:outline-none focus-visible:outline-2 focus-visible:outline-offset-2 bg-slate-900 text-white hover:bg-slate-700 hover:text-slate-100 active:bg-slate-800 active:text-slate-300 focus-visible:outline-slate-900 gap-1" variant="solid" color="slate" href="{{ route('welcome') }}">
                                <span>{{ __('booking.discount.paris24') }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <section id="get-started-today" class="relative overflow-hidden bg-blue-600 py-32">
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
            <section id="secondary-features" aria-label="Features for simplifying everyday business tasks" class="pb-14 pt-20 sm:pb-20 sm:pt-32 lg:pb-32 bg-white">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="mx-auto mt-12 grid max-w-sm grid-cols-1 gap-x-8 gap-y-10 sm:max-w-none lg:grid-cols-3">
                        <div class="text-center lg:block lg:text-center">
                            <div class="sm:shrink-0">
                                <div class="flow-root">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto h-24 w-24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 7.756a4.5 4.5 0 1 0 0 8.488M7.5 10.5h5.25m-5.25 3h5.25M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-3 lg:ml-0 lg:mt-6">
                                <h3 class="text-xl font-medium text-gray-900 tracking-tight font-display">{{ __('lang.incentives.1.title') }}</h3>
                                <p class="mt-2 text-base text-gray-500 tracking-tight">{{ __('lang.incentives.1.text1') }}</p>
                            </div>
                        </div>
                        <div class="text-center lg:block lg:text-center">
                            <div class="sm:shrink-0">
                                <div class="flow-root">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto h-24 w-24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-3 lg:ml-0 lg:mt-6">
                                <h3 class="text-xl font-medium text-gray-900 tracking-tight font-display">{{ __('lang.incentives.2.title') }}</h3>
                                <p class="mt-2 text-base text-gray-500 tracking-tight">{{ __('lang.incentives.2.text1') }}</p>
                            </div>
                        </div>
                        <div class="text-center lg:block lg:text-center">
                            <div class="sm:shrink-0">
                                <div class="flow-root">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto h-24 w-24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-3 lg:ml-0 lg:mt-6">
                                <h3 class="text-xl font-medium text-gray-900 tracking-tight font-display">{{ __('lang.incentives.3.title') }}</h3>
                                <p class="mt-2 text-base text-gray-500 tracking-tight">{{ __('lang.incentives.3.text1') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="faq" aria-labelledby="faq-title" class="relative overflow-hidden bg-slate-50 py-20 sm:py-32">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative">
                    <div class="mx-auto max-w-2xl lg:mx-0">
                        <h2 id="faq-title" class="font-display text-3xl tracking-tight text-slate-900 sm:text-4xl">{{ __('lang.faq.heading') }}</h2>
                        <p class="mt-4 text-lg tracking-tight text-slate-700">{{ __('lang.faq.subtitle') }}</p>
                    </div>
                    <ul role="list" class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-8 lg:max-w-none lg:grid-cols-3">
                        <li>
                            <ul role="list" class="flex flex-col gap-y-8">
                                <li>
                                    <h3 class="font-display text-lg leading-7 text-slate-900">{{ __('lang.faq.1.title') }}</h3>
                                    <p class="mt-4 text-sm text-slate-700">{{ __('lang.faq.1.text1') }}</p>
                                    <p class="mt-4 text-sm text-slate-700 font-semibold">{{ __('lang.faq.1.text2') }}</p>
                                </li>
                                <li>
                                    <h3 class="font-display text-lg leading-7 text-slate-900">{{ __('lang.faq.2.title') }}</h3>
                                    <p class="mt-4 text-sm text-slate-700">{{ __('lang.faq.2.text1') }}</p>
                                    <p class="mt-4 text-sm text-slate-700">{{ __('lang.faq.2.text2') }}</p>
                                    <div class="mx-auto mt-4 grid max-w-sm grid-cols-3 gap-x-8 sm:max-w-none justify-items-center lg:justify-items-start">
                                        <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="size-10">
                                            <path d="M9.112 8.262L5.97 15.758H3.92L2.374 9.775c-.094-.368-.175-.503-.461-.658C1.447 8.864.677 8.627 0 8.479l.046-.217h3.3a.904.904 0 01.894.764l.817 4.338 2.018-5.102zm8.033 5.049c.008-1.979-2.736-2.088-2.717-2.972.006-.269.262-.555.822-.628a3.66 3.66 0 011.913.336l.34-1.59a5.207 5.207 0 00-1.814-.333c-1.917 0-3.266 1.02-3.278 2.479-.012 1.079.963 1.68 1.698 2.04.756.367 1.01.603 1.006.931-.005.504-.602.725-1.16.734-.975.015-1.54-.263-1.992-.473l-.351 1.642c.453.208 1.289.39 2.156.398 2.037 0 3.37-1.006 3.377-2.564m5.061 2.447H24l-1.565-7.496h-1.656a.883.883 0 00-.826.55l-2.909 6.946h2.036l.405-1.12h2.488zm-2.163-2.656l1.02-2.815.588 2.815zm-8.16-4.84l-1.603 7.496H8.34l1.605-7.496z" />
                                        </svg>
                                        <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="size-10">
                                            <path d="M2.15 4.318a42.16 42.16 0 0 0-.454.003c-.15.005-.303.013-.452.04a1.44 1.44 0 0 0-1.06.772c-.07.138-.114.278-.14.43-.028.148-.037.3-.04.45A10.2 10.2 0 0 0 0 6.222v11.557c0 .07.002.138.003.207.004.15.013.303.04.452.027.15.072.291.142.429a1.436 1.436 0 0 0 .63.63c.138.07.278.115.43.142.148.027.3.036.45.04l.208.003h20.194l.207-.003c.15-.004.303-.013.452-.04.15-.027.291-.071.428-.141a1.432 1.432 0 0 0 .631-.631c.07-.138.115-.278.141-.43.027-.148.036-.3.04-.45.002-.07.003-.138.003-.208l.001-.246V6.221c0-.07-.002-.138-.004-.207a2.995 2.995 0 0 0-.04-.452 1.446 1.446 0 0 0-1.2-1.201 3.022 3.022 0 0 0-.452-.04 10.448 10.448 0 0 0-.453-.003zm0 .512h19.942c.066 0 .131.002.197.003.115.004.25.01.375.032.109.02.2.05.287.094a.927.927 0 0 1 .407.407.997.997 0 0 1 .094.288c.022.123.028.258.031.374.002.065.003.13.003.197v11.552c0 .065 0 .13-.003.196-.003.115-.009.25-.032.375a.927.927 0 0 1-.5.693 1.002 1.002 0 0 1-.286.094 2.598 2.598 0 0 1-.373.032l-.2.003H1.906c-.066 0-.133-.002-.196-.003a2.61 2.61 0 0 1-.375-.032c-.109-.02-.2-.05-.288-.094a.918.918 0 0 1-.406-.407 1.006 1.006 0 0 1-.094-.288 2.531 2.531 0 0 1-.032-.373 9.588 9.588 0 0 1-.002-.197V6.224c0-.065 0-.131.002-.197.004-.114.01-.248.032-.375.02-.108.05-.199.094-.287a.925.925 0 0 1 .407-.406 1.03 1.03 0 0 1 .287-.094c.125-.022.26-.029.375-.032.065-.002.131-.002.196-.003zm4.71 3.7c-.3.016-.668.199-.88.456-.191.22-.36.58-.316.918.338.03.675-.169.888-.418.205-.258.345-.603.308-.955zm2.207.42v5.493h.852v-1.877h1.18c1.078 0 1.835-.739 1.835-1.812 0-1.07-.742-1.805-1.808-1.805zm.852.719h.982c.739 0 1.161.396 1.161 1.089 0 .692-.422 1.092-1.164 1.092h-.979zm-3.154.3c-.45.01-.83.28-1.05.28-.235 0-.593-.264-.981-.257a1.446 1.446 0 0 0-1.23.747c-.527.908-.139 2.255.374 2.995.249.366.549.769.944.754.373-.014.52-.242.973-.242.454 0 .586.242.98.235.41-.007.667-.366.915-.733.286-.417.403-.82.41-.841-.007-.008-.79-.308-.797-1.209-.008-.754.615-1.113.644-1.135-.352-.52-.9-.578-1.09-.593a1.123 1.123 0 0 0-.092-.002zm8.204.397c-.99 0-1.606.533-1.652 1.256h.777c.072-.358.369-.586.845-.586.502 0 .803.266.803.711v.309l-1.097.064c-.951.054-1.488.484-1.488 1.184 0 .72.548 1.207 1.332 1.207.526 0 1.032-.281 1.264-.727h.019v.659h.788v-2.76c0-.803-.62-1.317-1.591-1.317zm1.94.072l1.446 4.009c0 .003-.073.24-.073.247-.125.41-.33.571-.711.571-.069 0-.206 0-.267-.015v.666c.06.011.267.019.335.019.83 0 1.226-.312 1.568-1.283l1.5-4.214h-.868l-1.012 3.259h-.015l-1.013-3.26zm-1.167 2.189v.316c0 .521-.45.917-1.024.917-.442 0-.731-.228-.731-.579 0-.342.278-.56.769-.593z" />
                                        </svg>
                                        <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="size-10">
                                            <path d="M3.963 7.235A3.963 3.963 0 00.422 9.419a3.963 3.963 0 000 3.559 3.963 3.963 0 003.541 2.184c1.07 0 1.97-.352 2.627-.957.748-.69 1.18-1.71 1.18-2.916a4.722 4.722 0 00-.07-.806H3.964v1.526h2.14a1.835 1.835 0 01-.79 1.205c-.356.241-.814.379-1.35.379-1.034 0-1.911-.697-2.225-1.636a2.375 2.375 0 010-1.517c.314-.94 1.191-1.636 2.225-1.636a2.152 2.152 0 011.52.594l1.132-1.13a3.808 3.808 0 00-2.652-1.033zm6.501.55v6.9h.886V11.89h1.465c.603 0 1.11-.196 1.522-.588a1.911 1.911 0 00.635-1.464 1.92 1.92 0 00-.635-1.456 2.125 2.125 0 00-1.522-.598zm2.427.85a1.156 1.156 0 01.823.365 1.176 1.176 0 010 1.686 1.171 1.171 0 01-.877.357H11.35V8.635h1.487a1.156 1.156 0 01.054 0zm4.124 1.175c-.842 0-1.477.308-1.907.925l.781.491c.288-.417.68-.626 1.175-.626a1.255 1.255 0 01.856.323 1.009 1.009 0 01.366.785v.202c-.34-.193-.774-.289-1.3-.289-.617 0-1.11.145-1.479.434-.37.288-.554.677-.554 1.165a1.476 1.476 0 00.525 1.156c.35.308.785.463 1.305.463.61 0 1.098-.27 1.465-.81h.038v.655h.848v-2.909c0-.61-.19-1.09-.568-1.44-.38-.35-.896-.525-1.551-.525zm2.263.154l1.946 4.422-1.098 2.38h.915L24 9.963h-.965l-1.368 3.391h-.02l-1.406-3.39zm-2.146 2.368c.494 0 .88.11 1.156.33 0 .372-.147.696-.44.973a1.413 1.413 0 01-.997.414 1.081 1.081 0 01-.69-.232.708.708 0 01-.293-.578c0-.257.12-.47.363-.647.24-.173.54-.26.9-.26Z" />
                                        </svg>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <ul role="list" class="flex flex-col gap-y-8">
                                <li>
                                    <h3 class="font-display text-lg leading-7 text-slate-900">{{ __('lang.faq.3.title') }}</h3>
                                    <p class="mt-4 text-sm text-slate-700">{{ __('lang.faq.3.text1') }}</p>
                                    <p class="mt-4 text-sm text-slate-700">{{ __('lang.faq.3.text2') }}</p>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <ul role="list" class="flex flex-col gap-y-8">
                                <li>
                                    <h3 class="font-display text-lg leading-7 text-slate-900">{{ __('lang.faq.4.title') }}</h3>
                                    <p class="mt-4 text-sm text-slate-700">{{ __('lang.faq.4.text1') }}</p>
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
                            <a class="inline-block rounded-lg px-2 py-1 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900" href="/">{{ __('lang.footer.link.home') }}</a>
                            <a class="inline-block rounded-lg px-2 py-1 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900" href="{{ route('welcome') }}">{{ __('lang.footer.link.book') }}</a>
                            <a class="inline-block rounded-lg px-2 py-1 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900" href="{{ route('terms') }}">{{ __('lang.footer.link.terms') }}</a>
                            @if (request()->session()->get('locale') == 'fr')
                                <a class="inline-block rounded-lg px-2 py-1 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900" href="/en">{{ __('lang.footer.link.english') }}</a>
                            @else
                                <a class="inline-block rounded-lg px-2 py-1 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900" href="/fr">{{ __('lang.footer.link.french') }}</a>
                            @endif
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
