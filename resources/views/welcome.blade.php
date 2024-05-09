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
                                <span>-10€ avec le code PARIS24</span>
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
                                <h3 class="text-xl font-medium text-gray-900 tracking-tight font-display">Tarification claire</h3>
                                <p class="mt-2 text-base text-gray-500 tracking-tight">Nos tarifs sont connus à l'avance, ce qui évite les mauvaises surprises à la fin du trajet.</p>
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
                                <h3 class="text-xl font-medium text-gray-900 tracking-tight font-display">Annulation gratuite</h3>
                                <p class="mt-2 text-base text-gray-500 tracking-tight">Vous pouvez annuler votre réservation gratuitement jusqu'à 24 heures avant le départ.</p>
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
                                <h3 class="text-xl font-medium text-gray-900 tracking-tight font-display">Payez à l'arrivée</h3>
                                <p class="mt-2 text-base text-gray-500 tracking-tight">Nous vous offrons l'option de payer plus tard.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="faq" aria-labelledby="faq-title" class="relative overflow-hidden bg-slate-50 py-20 sm:py-32">
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
                                    <p class="mt-4 text-sm text-slate-700">Vous pouvez réserver un trajet en remplissant le <a href="{{ route('welcome') }}" class="text-indigo-600 underline hover:no-underline">formulaire de réservation</a>.</p>
                                    <p class="mt-4 text-sm text-slate-700 font-semibold">Lors de la réservation, nous vous laissons le choix d'effectuer le paiement en ligne ou de payer plus tard.</p>
                                </li>
                                <li>
                                    <h3 class="font-display text-lg leading-7 text-slate-900">Quels sont les modes de paiement acceptés ?</h3>
                                    <p class="mt-4 text-sm text-slate-700">Nous acceptons les paiements par carte de crédit, Apple Pay, uniquement pour les réservations effectuées depuis le <a href="{{ route('welcome') }}" class="text-indigo-600 underline hover:no-underline">formulaire de réservation</a>.</p>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <ul role="list" class="flex flex-col gap-y-8">
                                <li>
                                    <h3 class="font-display text-lg leading-7 text-slate-900">Puis-je annuler ma réservation ?</h3>
                                    <p class="mt-4 text-sm text-slate-700">Oui, vous pouvez annuler votre réservation gratuitement jusqu'à 24 heures avant le départ. Au-delà, des frais peuvent s'appliquer.</p>
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
                            <a class="inline-block rounded-lg px-2 py-1 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900" href="{{ route('welcome') }}">Réserver un trajet</a>
                        </div>
                    </nav>
                    <nav class="mt-10 text-sm" aria-label="quick links">
                        <div class="-my-1 flex justify-center gap-x-6 flex-col md:flex-row md:text-center">
                            <a class="inline-block rounded-lg px-2 py-1 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900" href="{{ route('welcome') }}">Transferts Paris-Charles de Gaulle (CDG)</a>
                            <a class="inline-block rounded-lg px-2 py-1 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900" href="{{ route('welcome') }}">Transferts Paris-Orly (ORY)</a>
                            <a class="inline-block rounded-lg px-2 py-1 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900" href="{{ route('welcome') }}">Aéroport vers Disneyland Paris</a>
                            <a class="inline-block rounded-lg px-2 py-1 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900" href="{{ route('welcome') }}">Aéroport vers Paris</a>
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
