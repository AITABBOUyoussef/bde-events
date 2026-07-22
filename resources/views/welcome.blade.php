<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BDE-Events | Plateforme du Campus</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS (Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased selection:bg-green-500 selection:text-white">

    <!-- Navbar / En-tête -->
    <nav class="bg-white shadow-sm border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">

                <!-- Logo BDE -->
                <div class="flex-shrink-0 flex items-center gap-3 cursor-pointer">
                    <!-- Carré Vert avec texte BDE -->
                    <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-700 rounded-xl flex items-center justify-center shadow-md transform transition hover:rotate-3">
                        <span class="text-white font-extrabold text-xl tracking-wider">BDE</span>
                    </div>
                    <!-- Texte Events -->
                    <span class="font-extrabold text-2xl text-gray-900 tracking-tight">
                        Events<span class="text-green-600 text-3xl">.</span>
                    </span>
                </div>

                <!-- Liens d'Authentification (Login / Register) -->
                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <!-- Kayban ghir ila kan l-user m-connecté -->
                            <a href="{{ route('dashboard') }}" class="text-sm font-semibold text-gray-600 hover:text-green-600 transition">Mon Tableau de bord</a>
                        @else
                            <!-- Kayban l-ay wahed mazal ma-connecta -->
                            <a href="{{ route('login') }}" class="text-sm font-bold text-gray-600 hover:text-green-600 transition px-3">
                                Se connecter
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-6 py-2.5 text-sm font-bold text-white transition-all duration-200 bg-green-600 border border-transparent rounded-full shadow-md hover:bg-green-700 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600">
                                    Créer un compte
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Section Principale (Hero Section) -->
    <div class="relative bg-white overflow-hidden min-h-[calc(100vh-80px)] flex items-center">
        <!-- Décoration en arrière-plan (Cercle flouté) -->
        <div class="absolute top-0 left-1/2 transform -translate-x-1/2 w-full overflow-hidden flex justify-center opacity-30 pointer-events-none">
            <div class="w-[800px] h-[400px] bg-green-300 rounded-full blur-3xl filter"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 flex flex-col items-center text-center -mt-10">

            <!-- Petit Badge -->
            <span class="inline-flex items-center gap-2 py-1.5 px-4 rounded-full bg-green-50 text-green-700 text-sm font-bold mb-8 border border-green-200 shadow-sm animate-bounce">
                <span>🎉</span> La plateforme centralisée du campus
            </span>

            <!-- Titre Principal -->
            <h1 class="text-5xl md:text-7xl font-extrabold text-gray-900 tracking-tight mb-6 leading-tight">
                Vivez pleinement votre <br class="hidden sm:block">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-500 to-green-800">vie étudiante</span>
            </h1>

            <!-- Description -->
            <p class="mt-4 text-xl text-gray-600 max-w-2xl mx-auto mb-10 leading-relaxed font-medium">
                Géré par votre BDE. Découvrez les prochains événements, réservez votre place en un clic et obtenez votre
                <strong class="text-green-700">Pass Numérique</strong> directement sur votre profil.
            </p>

            <!-- Boutons d'Action Principaux -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center w-full max-w-md mx-auto sm:max-w-none">
                @auth
                    <!-- Bouton ila kan connecté -->
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center px-8 py-4 text-lg font-bold text-white transition-all duration-300 bg-gradient-to-r from-green-500 to-green-600 border border-transparent rounded-full shadow-lg hover:from-green-600 hover:to-green-700 hover:scale-105">
                        Accéder à mon espace étudiant
                        <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </a>
                @else
                    <!-- Boutons ila ma-connectéch -->
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 text-lg font-bold text-white transition-all duration-300 bg-green-600 border border-transparent rounded-full shadow-lg hover:bg-green-700 hover:scale-105 hover:shadow-green-500/30">
                        Rejoindre la plateforme
                    </a>
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-4 text-lg font-bold text-gray-700 transition-all duration-300 bg-white border border-gray-200 rounded-full shadow-sm hover:bg-gray-50 hover:border-green-500 hover:text-green-600 hover:scale-105">
                        J'ai déjà un compte
                    </a>
                @endauth
            </div>

        </div>
    </div>

</body>
</html>
