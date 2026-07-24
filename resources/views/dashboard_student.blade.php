<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-gray-800 leading-tight">
            👋 {{ __('Bienvenue,') }} <span class="text-green-600">{{ Auth::user()->name }}</span>
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Message de Succès (Vert) -->
            @if (session('success'))
                <div class="mb-8 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-r-lg shadow-sm flex items-center"
                    role="alert">
                    <svg class="w-6 h-6 mr-4 text-green-500 shrink-0" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <p class="font-bold">Réservation confirmée !</p>
                        <p class="text-sm">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- Message d'Erreur (Rouge) -->
            @if (session('error'))
                <div class="mb-8 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-r-lg shadow-sm flex items-center"
                    role="alert">
                    <svg class="w-6 h-6 mr-4 text-red-500 shrink-0" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <p class="font-bold">Impossible de réserver</p>
                        <p class="text-sm">{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            <div class="mb-8">
                <h3 class="text-xl font-black text-gray-900 uppercase tracking-wide">Événements à venir</h3>
                <p class="text-sm text-gray-500 mt-1">Découvrez les prochains événements du campus et réservez votre
                    place.</p>
            </div>

            <!-- Grid dyal les Événements -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                @forelse ($events as $event)
                    <!-- Code PHP bach n-verifiw wach l-user li connecté deja m-réserver f had l-event -->
                    @php
                        $userReservation = \App\Models\Reservation::where('event_id', $event->id)
                            ->where('user_id', Auth::id())
                            ->first();
                    @endphp

                    <!-- Carte Événement -->
                    <div
                        class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 overflow-hidden group flex flex-col relative">

                        <!-- Décoration l-fou9 dyal l-carte (Kat-tbedel 3la 7sab l-état) -->
                        <div
                            class="h-3 w-full {{ $userReservation ? 'bg-gradient-to-r from-emerald-500 to-teal-600' : ($event->jauge_maximale <= 0 ? 'bg-red-400' : 'bg-gradient-to-r from-green-400 to-green-600') }}">
                        </div>

                        <div class="p-6 flex-grow">
                            <div class="flex justify-between items-start mb-4">
                                <h4
                                    class="text-xl font-bold text-gray-900 leading-tight group-hover:text-green-600 transition-colors">
                                    {{ $event->titre }}</h4>

                                <!-- Badge dyal l-Prix -->
                                <span
                                    class="inline-flex items-center justify-center px-3 py-1 rounded-full text-xs font-bold {{ $event->prix > 0 ? 'bg-amber-100 text-amber-800' : 'bg-green-100 text-green-800' }}">
                                    {{ $event->prix > 0 ? $event->prix . ' DH' : 'Gratuit' }}
                                </span>
                            </div>

                            <p class="text-gray-600 text-sm line-clamp-2 mb-6" title="{{ $event->description }}">
                                {{ $event->description }}
                            </p>

                            <!-- Détails (Date, Heure, Lieu) -->
                            <div class="space-y-3 text-sm font-medium text-gray-700">
                                <div class="flex items-center gap-3">
                                    <div class="bg-gray-100 p-1.5 rounded-lg text-gray-500">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                    <span>{{ \Carbon\Carbon::parse($event->date)->translatedFormat('d F Y') }}</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="bg-gray-100 p-1.5 rounded-lg text-gray-500">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <span>{{ \Carbon\Carbon::parse($event->heure)->format('H:i') }}</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="bg-gray-100 p-1.5 rounded-lg text-gray-500">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
                                    <span>{{ $event->lieu }}</span>
                                </div>

                                <!-- BLASSA DYAL L-CAPACITÉ (DYNAMIQUE) -->
                                @if ($userReservation)
                                    <!-- Etat 1: Deja inscrit -->
                                    <div class="flex items-center gap-3 pt-2 border-t border-gray-100">
                                        <div class="bg-emerald-50 p-1.5 rounded-lg text-emerald-600">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <span class="text-emerald-700 font-extrabold text-sm">Vous êtes déjà inscrit
                                            🎟️</span>
                                    </div>
                                @elseif ($event->jauge_maximale <= 0)
                                    <!-- Etat 2: Event Complet -->
                                    <div class="flex items-center gap-3 pt-2 border-t border-gray-100">
                                        <div class="bg-red-50 p-1.5 rounded-lg text-red-500">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <span class="text-red-600 font-extrabold text-sm">Événement Complet (0
                                            place)</span>
                                    </div>
                                @else
                                    <!-- Etat 3: Places disponibles -->
                                    <div class="flex items-center gap-3 pt-2 border-t border-gray-100">
                                        <div class="bg-blue-50 p-1.5 rounded-lg text-blue-500">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                                </path>
                                            </svg>
                                        </div>
                                        <span class="text-blue-700 font-extrabold text-sm">{{ $event->jauge_maximale }}
                                            places disponibles</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- L-BOUTON DYAL ACTION (DYNAMIQUE) -->
                        <div class="p-6 pt-0 mt-auto">
                            @if ($userReservation)
                                <!-- Option 1: User DEJA RESERVÉ -> Bouton Vert/Emerald "Voir mon ticket" -->
                                <form action="{{ route('reservations.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="event_id" value="{{ $event->id }}">
                                    <button type="submit"
                                        class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 px-4 rounded-xl shadow-md transition-all duration-300 flex items-center justify-center gap-2">
                                        <span>Voir mon ticket</span>
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z">
                                            </path>
                                        </svg>
                                    </button>
                                </form>
                            @elseif ($event->jauge_maximale <= 0)
                                <!-- Option 2: EVENT COMPLET -> Bouton Ramadi M-bloki (Disabled) -->
                                <button type="button" disabled
                                    class="w-full bg-gray-100 text-gray-400 border border-gray-200 font-bold py-3 px-4 rounded-xl cursor-not-allowed flex items-center justify-center gap-2">
                                    <span>Événement complet</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                        </path>
                                    </svg>
                                </button>
                            @else
                                <!-- Option 3: DISPONIBLE -> Bouton Khder "Réserver ma place" -->
                                <form action="{{ route('reservations.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="event_id" value="{{ $event->id }}">
                                    <button type="submit"
                                        class="w-full bg-green-50 text-green-700 border border-green-200 hover:bg-green-600 hover:text-white hover:border-green-600 font-bold py-3 px-4 rounded-xl transition-all duration-300 flex items-center justify-center gap-2">
                                        Réserver ma place
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                        </svg>
                                    </button>
                                </form>
                            @endif
                        </div>

                    </div>
                @empty
                    <!-- Ila kan l-bde mazal ma-publiya walo -->
                    <div
                        class="col-span-1 md:col-span-2 lg:col-span-3 bg-white rounded-2xl border border-dashed border-gray-300 p-12 text-center">
                        <div class="mx-auto w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-1">Aucun événement prévu</h3>
                        <p class="text-gray-500">Le BDE n'a pas encore publié d'événements. Revenez plus tard !</p>
                    </div>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>
