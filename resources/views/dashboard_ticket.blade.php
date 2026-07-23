<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-gray-800 leading-tight flex items-center gap-2">
            🎟️ {{ __('Mes Billets & Réservations') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-8">
                <h3 class="text-xl font-black text-gray-900 uppercase tracking-wide">Vos Pass Numériques</h3>
                <p class="text-sm text-gray-500 mt-1">Retrouvez ici tous les tickets des événements auxquels vous êtes inscrit.</p>
            </div>

            <!-- Grid dyal les Tickets -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                @forelse ($reservations as $reservation)
                    <!-- Carte Ticket Individuel -->
                    <div class="bg-white rounded-3xl shadow-lg overflow-hidden border border-gray-100 flex flex-col justify-between transform transition hover:scale-[1.02]">

                        <!-- Header dyal l-Ticket -->
                        <div class="bg-gradient-to-r from-green-500 to-green-700 px-6 py-5 text-white flex justify-between items-center">
                            <div>
                                <span class="bg-white/20 text-white text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-widest border border-white/30">
                                    Validé
                                </span>
                                <!-- Ism l-Event (Kan-وصلou lih b relation $reservation->event->titre) -->
                                <h4 class="text-xl font-black mt-2 leading-tight">{{ $reservation->event->titre ?? 'Événement supprimé' }}</h4>
                            </div>
                            <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-inner">
                                <span class="text-green-600 font-black text-xs">BDE</span>
                            </div>
                        </div>

                        <!-- Details dyal l-Event -->
                        <div class="p-6 space-y-3 text-sm font-medium text-gray-700">
                            <div class="flex items-center gap-3">
                                <div class="bg-gray-100 p-1.5 rounded-lg text-gray-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <span>{{ \Carbon\Carbon::parse($reservation->event->date)->translatedFormat('d M Y') }} à {{ \Carbon\Carbon::parse($reservation->event->heure)->format('H:i') }}</span>
                            </div>

                            <div class="flex items-center gap-3">
                                <div class="bg-gray-100 p-1.5 rounded-lg text-gray-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <span>{{ $reservation->event->lieu }}</span>
                            </div>
                        </div>

                        <!-- Separateur m9te3 (Dashed) -->
                        <div class="relative flex items-center px-4">
                            <div class="h-5 w-5 bg-gray-50 rounded-full absolute -left-2.5 shadow-inner"></div>
                            <div class="h-5 w-5 bg-gray-50 rounded-full absolute -right-2.5 shadow-inner"></div>
                            <div class="w-full border-t-2 border-dashed border-gray-200"></div>
                        </div>

                        <!-- Footer dyal l-Ticket (Code unique) -->
                        <div class="bg-gray-50 p-6 text-center">
                            <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mb-2">Code de Réservation</p>
                            <div class="bg-white border border-gray-300 py-2.5 px-4 rounded-xl shadow-sm inline-block w-full">
                                <span class="text-xl font-black text-gray-900 tracking-widest font-mono">
                                    {{ $reservation->reservation_code }}
                                </span>
                            </div>
                        </div>

                    </div>
                @empty
                    <!-- Ila makan 3ndo hta réservation -->
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 bg-white rounded-2xl border border-dashed border-gray-300 p-12 text-center">
                        <div class="mx-auto w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4 text-gray-400">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-1">Aucun billet pour le moment</h3>
                        <p class="text-gray-500 mb-6">Vous n'avez encore réservé aucune place pour les événements à venir.</p>
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-5 py-2.5 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl shadow-md transition">
                            Découvrir les événements
                        </a>
                    </div>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>
