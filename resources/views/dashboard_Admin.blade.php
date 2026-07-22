<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-extrabold text-2xl text-gray-800 leading-tight">
                🎓 {{ __('Tableau de Bord BDE (VIP)') }}
            </h2>
            <!-- Bouton Créer un Événement -->
            <a href="{{ route('events.create') }}" class="bg-gradient-to-r from-gray-900 to-black hover:from-black hover:to-gray-900 text-amber-400 border border-amber-500/50 font-bold py-2 px-5 rounded-lg shadow-md transition-all duration-300 ease-in-out transform hover:scale-105 flex items-center group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 group-hover:animate-pulse" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Nouvel Événement
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Message de Succès (Mli kay-tzad chi événement) -->
            @if (session('success'))
                <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-r-lg shadow-sm" role="alert">
                    <p class="font-bold">Succès</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <!-- Section des Statistiques Rapides -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Stat Card 1 -->
                <div class="bg-white overflow-hidden shadow sm:rounded-xl border-l-4 border-indigo-500 transition hover:shadow-lg">
                    <div class="p-6">
                        <div class="text-indigo-500 text-xs font-bold uppercase tracking-wider">Total Événements</div>
                        <!-- Hna kay-7seb chhal mn événement kayn f l-base de données -->
                        <div class="mt-2 text-3xl font-extrabold text-gray-900">{{ $events->count() }}</div>
                    </div>
                </div>
                <!-- Stat Card 2 (Ghat-kdem mli n-saybo les réservations) -->
                <div class="bg-white overflow-hidden shadow sm:rounded-xl border-l-4 border-green-500 transition hover:shadow-lg opacity-75">
                    <div class="p-6">
                        <div class="text-green-500 text-xs font-bold uppercase tracking-wider">Total Réservations</div>
                        <div class="mt-2 text-3xl font-extrabold text-gray-900">À venir</div>
                    </div>
                </div>
            </div>

            <!-- Tableau de Suivi Dynamique (US 1.2) -->
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-100">
                <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-white">
                    <h3 class="text-xl font-bold text-gray-800">Suivi des Capacités & Réservations</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 border-b border-gray-200 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Événement</th>
                                <th class="px-6 py-4 border-b border-gray-200 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Date & Lieu</th>
                                <th class="px-6 py-4 border-b border-gray-200 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Capacité / Jauge</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">

                            <!-- Boucle 3la les événements mn l-Base de données -->
                            @forelse ($events as $event)
                                <tr class="hover:bg-gray-50 transition duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="font-bold text-gray-900">{{ $event->titre }}</div>
                                        <div class="text-sm font-medium {{ $event->prix > 0 ? 'text-amber-600' : 'text-green-600' }}">
                                            {{ $event->prix > 0 ? $event->prix . ' DH' : 'Gratuit' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <!-- \Carbon\Carbon bach n-afficchiw la date w l-weqt b tari9a n9iya -->
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }} à {{ \Carbon\Carbon::parse($event->heure)->format('H:i') }}
                                        </div>
                                        <div class="text-sm text-gray-500">{{ $event->lieu }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span class="px-4 py-1.5 inline-flex text-xs leading-5 font-bold rounded-full bg-blue-100 text-blue-800">
                                            Places Max : {{ $event->jauge_maximale }}
                                        </span>
                                    </td>
                                </tr>
                            <!-- Ila kant l-base de données khawya (makayn hta événement) -->
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-10 whitespace-nowrap text-center text-gray-500 font-medium">
                                        <svg class="mx-auto h-12 w-12 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                        Aucun événement n'a été publié pour le moment.
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
