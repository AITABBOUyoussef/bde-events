<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                🎓 {{ __('Tableau de Bord BDE') }}
            </h2>
            <!-- Bouton Créer un Événement (US 1.1) -->
            <a href="#" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-5 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Nouvel Événement
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Section des Statistiques Rapides -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Stat Card 1 -->
                <div class="bg-white overflow-hidden shadow sm:rounded-xl border-l-4 border-indigo-500 transition hover:shadow-lg">
                    <div class="p-6">
                        <div class="text-indigo-500 text-xs font-bold uppercase tracking-wider">Total Événements Actifs</div>
                        <div class="mt-2 text-3xl font-extrabold text-gray-900">5</div>
                    </div>
                </div>
                <!-- Stat Card 2 -->
                <div class="bg-white overflow-hidden shadow sm:rounded-xl border-l-4 border-green-500 transition hover:shadow-lg">
                    <div class="p-6">
                        <div class="text-green-500 text-xs font-bold uppercase tracking-wider">Total Réservations</div>
                        <div class="mt-2 text-3xl font-extrabold text-gray-900">124</div>
                    </div>
                </div>
                <!-- Stat Card 3 -->
                <div class="bg-white overflow-hidden shadow sm:rounded-xl border-l-4 border-orange-500 transition hover:shadow-lg">
                    <div class="p-6">
                        <div class="text-orange-500 text-xs font-bold uppercase tracking-wider">Alertes (Presque complets)</div>
                        <div class="mt-2 text-3xl font-extrabold text-gray-900">1</div>
                    </div>
                </div>
            </div>

            <!-- Tableau de Suivi (US 1.2) -->
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
                                <th class="px-6 py-4 border-b border-gray-200 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Places Restantes (Temps Réel)</th>
                                <th class="px-6 py-4 border-b border-gray-200 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">

                            <!-- Ligne 1 : Événement avec places dispo -->
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-bold text-gray-900">Soirée d'Intégration BDE</div>
                                    <div class="text-sm text-gray-500">Gratuit</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">25 Juil 2026 - 20:00</div>
                                    <div class="text-sm text-gray-500">Campus Principal</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <!-- Label Vert pour places dispo -->
                                    <span class="px-4 py-1.5 inline-flex text-xs leading-5 font-bold rounded-full bg-green-100 text-green-800">
                                        80 / 100 Restantes
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900 hover:underline mr-4">Détails</a>
                                </td>
                            </tr>

                            <!-- Ligne 2 : Événement Complet (Test) -->
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-bold text-gray-900">Tournoi E-Sport FC25</div>
                                    <div class="text-sm text-gray-500">20 DH</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">30 Juil 2026 - 14:00</div>
                                    <div class="text-sm text-gray-500">Salle Info 2</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <!-- Label Rouge pour Complet -->
                                    <span class="px-4 py-1.5 inline-flex text-xs leading-5 font-bold rounded-full bg-red-100 text-red-800">
                                        0 / 30 (Complet)
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900 hover:underline mr-4">Détails</a>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
