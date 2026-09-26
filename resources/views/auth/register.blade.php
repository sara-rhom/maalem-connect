<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div class="mt-4">
    <x-input-label for="role" value="Vous êtes ?" />
    <select id="role" name="role" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required onchange="toggleOuvrierFields()">
        <option value="client">Un Client (Besoin d'un service)</option>
        <option value="ouvrier">Un Ouvrier / Maâlem (Je propose mes services)</option>
    </select>
</div>

<div class="mt-4">
    <x-input-label for="telephone" value="Numéro de téléphone" />
    <x-text-input id="telephone" class="block mt-1 w-full" type="text" name="telephone" required />
</div>

<div class="mt-4">
    <x-input-label for="ville" value="Votre Ville" />
    <select id="ville" name="ville" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
        <option value="Kénitra">Kénitra</option>
        <option value="Rabat">Rabat</option>
        <option value="Casablanca">Casablanca</option>
        <option value="Salé">Salé</option>
        <option value="Tanger">Tanger</option>
    </select>
</div>

<div id="champs_ouvrier" style="display: none;">
    <div class="mt-4">
        <x-input-label for="metier" value="Votre Métier" />
        <select id="metier" name="metier" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
            <option value="">-- Choisir un métier --</option>
            <option value="Plombier">Plombier</option>
            <option value="Électricien">Électricien</option>
            <option value="Peintre">Peintre</option>
            <option value="Menuisier">Menuisier</option>
        </select>
    </div>

    <div class="mt-4">
        <x-input-label for="tarifs" value="Tarifs / Prestations (Ex: 150 DH/heure, Pose de lustres...)" />
        <textarea id="tarifs" name="tarifs" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3"></textarea>
    </div>
</div>

<script>
    function toggleOuvrierFields() {
        var role = document.getElementById('role').value;
        var champsOuvrier = document.getElementById('champs_ouvrier');
        var metierInput = document.getElementById('metier');
        
        if (role === 'ouvrier') {
            champsOuvrier.style.display = 'block';
            metierInput.required = true;
        } else {
            champsOuvrier.style.display = 'none';
            metierInput.required = false;
            metierInput.value = '';
        }
    }
</script>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
