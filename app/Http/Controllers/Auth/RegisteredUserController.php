<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */

    public function store(Request $request): RedirectResponse
{
    // 1. On valide que les données reçues sont correctes
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        // --- NOS AJOUTS ---
        'role' => ['required', 'string', 'in:client,ouvrier'],
        'telephone' => ['required', 'string'],
        'ville' => ['required', 'string'],
        'metier' => ['nullable', 'string'],
        'tarifs' => ['nullable', 'string'],
    ]);

    // 2. On insère l'utilisateur dans la table SQL 'users'
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        // --- NOS AJOUTS ---
        'role' => $request->role,
        'telephone' => $request->telephone,
        'ville' => $request->ville,
        'metier' => $request->metier,
        'tarifs' => $request->tarifs,
        // Si c'est un client, il est validé d'office. Si c'est un ouvrier, il attend la validation de l'admin
        'statut_validation' => $request->role === 'ouvrier' ? 'en_attente' : 'valide',
    ]);

    event(new Registered($user));

    Auth::login($user);

    return redirect(route('dashboard', absolute: false));
}
}