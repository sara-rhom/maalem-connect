<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de bord') }} — Espace {{ ucfirst(Auth::user()->role) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <h3 class="text-xl font-bold mb-4">Bienvenue, {{ Auth::user()->name }} ! 👋</h3>
                        @if(session('success'))
                        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100" role="alert">
                            {{ session('success') }}
                        </div>
                        @endif

                    @if(Auth::user()->role === 'client')
                        <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50" role="alert">
                            <span class="font-medium">Profil Client :</span> Vous pouvez rechercher un artisan qualifié et gérer vos demandes.
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                            <a href="{{ route('ouvriers.index') }}" class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-50 transition">
                                <h5 class="mb-2 text-xl font-bold text-blue-600">🔍 Trouver un Maâlem</h5>
                                <p class="text-gray-700">Voir la liste des électriciens, plombiers et peintres disponibles dans votre ville.</p>
                            </a>

                            <a href="#" class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-50 transition">
                                <h5 class="mb-2 text-xl font-bold text-gray-900">📅 Mes Réservations</h5>
                                <p class="text-gray-700">Suivre l'état de vos demandes (En attente, Acceptée, Terminée).</p>
                            </a>
                            <div class="mt-8 bg-white p-4 rounded-lg border">
    <h4 class="font-bold text-md text-gray-800 mb-4">📅 Suivi de vos demandes de rendez-vous :</h4>
    
    @if($reservations->isEmpty())
        <p class="text-sm text-gray-500">Vous n'avez fait aucune demande pour le moment.</p>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="px-4 py-2">Maâlem</th>
                        <th class="px-4 py-2">Métier</th>
                        <th class="px-4 py-2">Date du RDV</th>
                        <th class="px-4 py-2">Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservations as $res)
                        <tr class="border-b bg-white">
                            <td class="px-4 py-3 font-medium text-gray-900">{{ $res->ouvrier_name }}</td>
                            <td class="px-4 py-3">{{ $res->metier }}</td>
                            <td class="px-4 py-3">{{ date('d/m/Y', strtotime($res->date_rendez_vous)) }}</td>
                            <td class="px-4 py-3">
                                @if($res->statut === 'en_attente')
                                    <span class="px-2 py-1 text-xs font-semibold rounded bg-yellow-100 text-yellow-800">⏳ En attente</span>
                                @elseif($res->statut === 'accepte')
                                    <span class="px-2 py-1 text-xs font-semibold rounded bg-green-100 text-green-800">✅ Acceptée</span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold rounded bg-red-100 text-red-800">❌ Refusée</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
                        </div>
                    @endif

                    @if(Auth::user()->role === 'ouvrier')
                        
                        @if(Auth::user()->statut_validation === 'en_attente')
                            <div class="p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50" role="alert">
                                <span class="font-medium">⏳ Compte en attente :</span> Votre profil est en cours de validation par l'administrateur.
                            </div>
                        @else
                            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                                <span class="font-medium">✅ Profil Validé :</span> Vous êtes visible dans la liste des ouvriers à {{ Auth::user()->ville }}.
                            </div>
                        @endif

                        <div class="bg-gray-50 p-4 rounded-lg border my-6">
                            <h4 class="font-semibold text-md text-gray-800 mb-2">📋 Vos informations professionnelles :</h4>
                            <p class="text-sm text-gray-600"><strong>Métier :</strong> {{ Auth::user()->metier }}</p>
                            <p class="text-sm text-gray-600"><strong>Téléphone :</strong> {{ Auth::user()->telephone }}</p>
                            <p class="text-sm text-gray-600"><strong>Ville :</strong> {{ Auth::user()->ville }}</p>
                        </div>

                        <div class="mt-6">
                            <a href="#" class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-50 transition max-w-md">
                                <h5 class="mb-2 text-xl font-bold text-yellow-600">🛠️ Demandes de chantiers reçues</h5>
                                <p class="text-gray-700">Consulter et accepter les demandes de dépannage des clients.</p>
                            </a>
                            <div class="mt-6 bg-white p-4 rounded-lg border">
    <h4 class="font-bold text-md text-gray-800 mb-4">📋 Demandes de dépannage reçues :</h4>
    
    @if($reservations->isEmpty())
        <p class="text-sm text-gray-500">Aucune demande reçue pour le moment.</p>
    @else
        <div class="space-y-4">
            @foreach($reservations as $res)
                <div class="p-4 border rounded-lg shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center bg-gray-50">
                    <div>
                        <p class="text-sm text-gray-900 font-bold">👤 Client : {{ $res->client_name }}</p>
                        <p class="text-xs text-gray-600">📞 Téléphone : {{ $res->telephone }}</p>
                        <p class="text-sm text-indigo-600 font-semibold mt-1">📅 Date prévue : {{ date('d/m/Y', strtotime($res->date_rendez_vous)) }}</p>
                    </div>
                    
                    <div class="mt-3 md:mt-0 flex gap-2">
                        @if($res->statut === 'en_attente')
                            <!-- On mettra les vrais boutons Accepter/Refuser juste après -->
                            <div class="flex gap-2">
    <form action="{{ route('reservations.accepter', $res->id) }}" method="POST">
        @csrf
        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white text-xs font-bold px-3 py-1.5 rounded transition">
            ✓ Accepter
        </button>
    </form>

    <form action="{{ route('reservations.refuser', $res->id) }}" method="POST">
        @csrf
        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-xs font-bold px-3 py-1.5 rounded transition" onclick="return confirm('Êtes-vous sûr de vouloir refuser ?')">
            ✕ Refuser
        </button>
    </form>
</div>
                            
                        @elseif($res->statut === 'accepte')
                            <span class="text-xs font-bold text-green-600 bg-green-100 px-3 py-1.5 rounded">✅ Vous avez accepté</span>
                        @else
                            <span class="text-xs font-bold text-red-600 bg-red-100 px-3 py-1.5 rounded">❌ Refusée</span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>