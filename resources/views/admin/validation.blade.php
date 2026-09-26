<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-red-600 leading-tight">
            🛡️ Espace Admin — Validation des Maâlems
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Inscriptions en attente de vérification :</h3>

                @if($ouvriersEnAttente->isEmpty())
                    <p class="text-gray-500">Aucun ouvrier en attente de validation. Tout est à jour ! ✨</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($ouvriersEnAttente as $ouvrier)
                            <div class="border p-4 rounded-lg bg-yellow-50 flex justify-between items-center">
                                <div>
                                    <h4 class="font-bold text-gray-900">{{ $ouvrier->name }}</h4>
                                    <p class="text-sm text-gray-600">🛠️ Métier : {{ $ouvrier->metier }}</p>
                                    <p class="text-sm text-gray-600">📍 Ville : {{ $ouvrier->ville }}</p>
                                    <p class="text-sm text-gray-600">📞 Tél : {{ $ouvrier->telephone }}</p>
                                </div>
                                
                                <form action="{{ route('admin.valider', $ouvrier->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white text-xs font-bold px-4 py-2 rounded transition shadow">
                                        ✓ Approuver & Publier
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>