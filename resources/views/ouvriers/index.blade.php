<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🛠️ Trouver un Maâlem (Artisans Disponibles)
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
        <div class="bg-white p-6 rounded-lg shadow-sm mb-6">
    <form action="{{ route('ouvriers.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
        
        <div>
            <label for="metier" class="block text-sm font-medium text-gray-700">Filtrer par métier :</label>
            <select name="metier" id="metier" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">Tous les métiers</option>
                <option value="Plombier" {{ request('metier') == 'Plombier' ? 'selected' : '' }}>Plombier</option>
                <option value="Électricien" {{ request('metier') == 'Électricien' ? 'selected' : '' }}>Électricien</option>
                <option value="Peintre" {{ request('metier') == 'Peintre' ? 'selected' : '' }}>Peintre</option>
                <option value="Menuisier" {{ request('metier') == 'Menuisier' ? 'selected' : '' }}>Menuisier</option>
            </select>
        </div>

        <div>
            <label for="ville" class="block text-sm font-medium text-gray-700">Filtrer par ville :</label>
            <select name="ville" id="ville" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">Toutes les villes</option>
                <option value="Kénitra" {{ request('ville') == 'Kénitra' ? 'selected' : '' }}>Kénitra</option>
                <option value="Rabat" {{ request('ville') == 'Rabat' ? 'selected' : '' }}>Rabat</option>
                <option value="Casablanca" {{ request('ville') == 'Casablanca' ? 'selected' : '' }}>Casablanca</option>
                <option value="Salé" {{ request('ville') == 'Salé' ? 'selected' : '' }}>Salé</option>
            </select>
        </div>

        <div>
            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-md shadow-sm transition font-medium">
                🔍 Rechercher
            </button>
        </div>
        
    </form>
</div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($ouvriers as $ouvrier)
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200 p-6 flex flex-col justify-between">
                        <div>
                            <span class="inline-block bg-indigo-100 text-indigo-800 text-xs font-semibold px-2.5 py-0.5 rounded mb-3">
                                {{ $ouvrier->metier }}
                            </span>
                            <h3 class="text-lg font-bold text-gray-900">{{ $ouvrier->name }}</h3>
                            <p class="text-sm text-gray-500 mb-4">📍 Ville : {{ $ouvrier->ville }}</p>
                            
                            <div class="bg-gray-50 p-3 rounded text-sm text-gray-700 mb-4">
                                <strong>Tarifs / Prestations :</strong><br>
                                {{ $ouvrier->tarifs ?? 'Non spécifiés' }}
                            </div>
                        </div>

                        <div>
                            <p class="text-sm text-gray-600 mb-3">📞 {{ $ouvrier->telephone }}</p>
                        </div>
                            
                            
                            <form action="{{ route('reservations.store') }}" method="POST" class="mt-3 space-y-3">
    @csrf
    <input type="hidden" name="ouvrier_id" value="{{ $ouvrier->id }}">
    
    <div>
        <label class="block text-xs font-medium text-gray-600">Date du rendez-vous :</label>
        <input type="date" name="date_reservation" required class="mt-1 block w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
    </div>

    <div>
        <label class="block text-xs font-medium text-gray-600">Créneau horaire :</label>
        <select name="creneau_horaire" required class="mt-1 block w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            <option value="Matin (8h - 12h)">Matin (8h - 12h)</option>
            <option value="Après-midi (12h - 16h)">Après-midi (12h - 16h)</option>
            <option value="Fin de journée (16h - 20h)">Fin de journée (16h - 20h)</option>
        </select>
    </div>

    <div>
        <label class="block text-xs font-medium text-gray-600">Description du problème :</label>
        <textarea name="description_demande" rows="2" required placeholder="Ex: Fuite d'eau, court-circuit..." class="mt-1 block w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
    </div>

    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded text-sm transition">
        📅 Confirmer la demande
    </button>
</form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white p-6 rounded-lg shadow-sm text-center col-span-3 text-gray-500">
                        Aucun ouvrier disponible pour le moment dans cette catégorie.
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>