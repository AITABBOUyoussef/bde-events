<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-gray-800 leading-tight flex items-center gap-2">
            <!-- Icon dyal Plus (+) -->
            <svg class="w-7 h-7 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            {{ __('Créer un Nouvel Événement') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <!-- Card dyal l-Formulaire -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100">
                <div class="p-8 sm:p-10">

                    <div class="mb-8 border-b border-gray-100 pb-5">
                        <h3 class="text-xl font-black text-gray-900 uppercase tracking-wide">Détails de l'événement</h3>
                        <p class="text-sm text-gray-500 mt-2">Remplissez les informations ci-dessous pour publier un événement officiel sur la plateforme du BDE.</p>
                    </div>

                    <!-- L-Formulaire (Kay-sifet l-data l route 'events.store') -->
                    <form action="{{ route('events.store') }}" method="POST">
                        <!-- Token CSRF darouri f Laravel bach l-formulaire y-doz sécurisé -->
                        @csrf

                        <!-- Titre -->
                        <div class="mb-6">
                            <label for="titre" class="block text-sm font-bold text-gray-700 mb-2">Titre de l'événement <span class="text-red-500">*</span></label>
                            <input type="text" name="titre" id="titre" value="{{ old('titre') }}" required
                                class="w-full rounded-xl border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm transition duration-150"
                                placeholder="Ex: Soirée d'intégration, Tournoi E-Sport...">
                            <!-- Hna kay-bano les erreurs dyal l-validation -->
                            @error('titre') <span class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</span> @enderror
                        </div>

                        <!-- Date et Heure -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="date" class="block text-sm font-bold text-gray-700 mb-2">Date <span class="text-red-500">*</span></label>
                                <input type="date" name="date" id="date" value="{{ old('date') }}" required
                                    class="w-full rounded-xl border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm transition duration-150">
                                @error('date') <span class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="heure" class="block text-sm font-bold text-gray-700 mb-2">Heure <span class="text-red-500">*</span></label>
                                <input type="time" name="heure" id="heure" value="{{ old('heure') }}" required
                                    class="w-full rounded-xl border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm transition duration-150">
                                @error('heure') <span class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Lieu, Prix, w Jauge Maximale -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                            <div>
                                <label for="lieu" class="block text-sm font-bold text-gray-700 mb-2">Lieu <span class="text-red-500">*</span></label>
                                <input type="text" name="lieu" id="lieu" value="{{ old('lieu') }}" required
                                    class="w-full rounded-xl border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm transition duration-150"
                                    placeholder="Ex: Salle Info 2, Campus...">
                                @error('lieu') <span class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="prix" class="block text-sm font-bold text-gray-700 mb-2">Prix (DH) <span class="text-red-500">*</span></label>
                                <input type="number" step="0.01" min="0" name="prix" id="prix" value="{{ old('prix') }}" required
                                    class="w-full rounded-xl border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm transition duration-150"
                                    placeholder="0 pour Gratuit">
                                @error('prix') <span class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="jauge_maximale" class="block text-sm font-bold text-gray-700 mb-2">Places Max <span class="text-red-500">*</span></label>
                                <input type="number" min="1" name="jauge_maximale" id="jauge_maximale" value="{{ old('jauge_maximale') }}" required
                                    class="w-full rounded-xl border-amber-300 focus:border-amber-500 focus:ring-amber-500 shadow-sm transition duration-150 bg-amber-50"
                                    placeholder="Ex: 100">
                                @error('jauge_maximale') <span class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-8">
                            <label for="description" class="block text-sm font-bold text-gray-700 mb-2">Description <span class="text-red-500">*</span></label>
                            <textarea name="description" id="description" rows="5" required
                                class="w-full rounded-xl border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm transition duration-150"
                                placeholder="Décrivez le programme de l'événement, les invités..."></textarea>
                            @error('description') <span class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</span> @enderror
                        </div>

                        <!-- Boutons d'action -->
                        <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-100">
                            <!-- Bouton Annuler -->
                            <a href="{{ route('dashboard_Admin') }}" class="px-6 py-3 text-sm font-bold text-gray-600 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 hover:text-gray-900 transition-all">
                                Annuler
                            </a>

                            <!-- Bouton Publier (VIP Style) -->
                            <button type="submit" class="px-8 py-3 text-sm font-bold text-white bg-gradient-to-r from-gray-900 to-black border border-amber-500/50 rounded-xl shadow-lg hover:shadow-amber-500/20 hover:scale-105 transition-all flex items-center gap-2 group">
                                <svg class="w-5 h-5 text-amber-400 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Publier l'événement
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
