<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-gray-800 leading-tight">
            🎟️ {{ __('Votre Pass Numérique') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen flex items-center justify-center">
        <div class="max-w-2xl w-full mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Alert d'information -->
            <div class="text-center mb-6">
                <p class="text-gray-500 text-sm">Présentez ce ticket numérique à l'entrée de l'événement.</p>
            </div>

            <!-- LE TICKET -->
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100 transform transition-all hover:scale-[1.02]">

                <!-- HEADER DU TICKET (En Vert) -->
                <div class="bg-gradient-to-r from-green-500 to-green-700 px-8 py-6 text-white flex justify-between items-center relative">
                    <div>
                        <span class="bg-white/20 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-widest border border-white/30 backdrop-blur-sm">
                            Billet Officiel
                        </span>
                        <h3 class="text-2xl font-black mt-3 leading-tight">{{ $ticket->titre }}</h3>
                    </div>
                    <!-- Logo BDE Sghir -->
                    <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-inner transform rotate-3">
                        <span class="text-green-600 font-black text-sm tracking-tighter">BDE</span>
                    </div>
                </div>

                <!-- CORPS DU TICKET (Informations) -->
                <div class="px-8 py-6 grid grid-cols-2 gap-6 relative">

                    <!-- Utilisateur -->
                    <div class="col-span-2 bg-gray-50 rounded-xl p-4 border border-gray-100 flex items-center gap-4">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center text-green-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-bold uppercase tracking-wider">Titulaire du billet</p>
                            <!-- Data dyal l-User li connecté -->
                            <p class="text-lg font-black text-gray-900">{{ Auth::user()->name }}</p>
                        </div>
                    </div>

                    <!-- Date & Heure -->
                    <div>
                        <p class="text-xs text-gray-500 font-bold uppercase tracking-wider mb-1">Date & Heure</p>
                        <p class="font-bold text-gray-900">{{ \Carbon\Carbon::parse($ticket->date)->translatedFormat('d M Y') }}</p>
                        <p class="text-sm font-medium text-gray-600">{{ \Carbon\Carbon::parse($ticket->heure)->format('H:i') }}</p>
                    </div>

                    <!-- Lieu -->
                    <div>
                        <p class="text-xs text-gray-500 font-bold uppercase tracking-wider mb-1">Lieu</p>
                        <p class="font-bold text-gray-900">{{ $ticket->lieu }}</p>
                    </div>

                    <!-- Prix -->
                    <div>
                        <p class="text-xs text-gray-500 font-bold uppercase tracking-wider mb-1">Tarif</p>
                        <span class="inline-flex items-center justify-center px-3 py-1 rounded-full text-sm font-bold {{ $ticket->prix > 0 ? 'bg-amber-100 text-amber-800' : 'bg-green-100 text-green-800' }}">
                            {{ $ticket->prix > 0 ? $ticket->prix . ' DH' : 'Gratuit' }}
                        </span>
                    </div>
                </div>

                <!-- SEPARATEUR (L-khet m9te3 bhal ticket dyal bsseh) -->
                <div class="relative flex items-center px-4">
                    <div class="h-6 w-6 bg-gray-50 rounded-full absolute -left-3 shadow-inner"></div>
                    <div class="h-6 w-6 bg-gray-50 rounded-full absolute -right-3 shadow-inner"></div>
                    <div class="w-full border-t-2 border-dashed border-gray-200"></div>
                </div>

                <!-- FOOTER DU TICKET (Le Code Unique) -->
                <div class="bg-gray-50 px-8 py-8 text-center flex flex-col items-center justify-center">
                    <p class="text-xs text-gray-500 font-bold uppercase tracking-widest mb-3">Code de Réservation</p>

                    <!-- L-Code stylisé -->
                    <div class="bg-white border-2 border-gray-800 px-6 py-3 rounded-lg shadow-sm w-full max-w-xs mx-auto">
                        <span class="text-3xl font-black text-gray-900 tracking-[0.2em] font-mono">
                            {{ $Code }}
                        </span>
                    </div>

                    <!-- Bouton Retour -->
                    <div class="mt-8">
                        <a href="{{ route('dashboard') }}" class="text-green-600 font-bold text-sm hover:text-green-700 transition flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            Retour au tableau de bord
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
