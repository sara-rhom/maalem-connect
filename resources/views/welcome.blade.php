<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Maâlem Connect - Trouvez un artisan de confiance</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50 text-gray-800">

    <nav class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <span class="text-2xl">🛠️</span>
                <span class="text-xl font-bold text-indigo-600 tracking-wide">Maâlem Connect</span>
            </div>

            @if (Route::has('login'))
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-gray-700 hover:text-indigo-600 transition">Mon Tableau de Bord</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-700 hover:text-indigo-600 transition">Se connecter</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-4 py-2 rounded-md shadow-sm transition">S'inscrire</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        
        <div class="space-y-6">
            <span class="inline-block px-3 py-1 bg-indigo-100 text-indigo-800 text-xs font-semibold tracking-wider uppercase rounded-full">
                📍 Disponible à Kénitra et partout au Maroc
            </span>
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight">
                Trouvez un <span class="text-indigo-600">Maâlem</span> de confiance en quelques clics
            </h1>
            <p class="text-lg text-gray-600 leading-relaxed">
                Besoin d'un plombier, d'un électricien ou d'un peintre ? Maâlem Connect vous met en relation directe avec des professionnels qualifiés, validés par notre équipe. Réservez votre créneau dès aujourd'hui !
            </p>

            <div class="pt-4 flex flex-col sm:flex-row gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 transition">
                        🚀 Accéder à mon espace
                    </a>
                @else
                    <a href="{{ route('register') }}" class="inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 transition">
                        📅 Créer un compte (Client / Ouvrier)
                    </a>
                    <a href="{{ route('login') }}" class="inline-flex justify-center items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition">
                        🔑 Déjà inscrit ? Connexion
                    </a>
                @endauth
            </div>
        </div>

        <div class="relative">
            <div class="absolute -inset-1 bg-gradient-to-r from-indigo-600 to-blue-500 rounded-lg blur opacity-25"></div>
            <img class="relative rounded-lg shadow-xl w-full object-cover h-80 md:h-96" 
     src="{{ asset('images/notre-image.jpeg') }}" 
     alt="Artisan au travail">
        </div>

    </main>

    <footer class="bg-white border-t mt-12 py-6 text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} Maâlem Connect — ENSA Kénitra Project. Tous droits réservés.
    </footer>

</body>
</html>