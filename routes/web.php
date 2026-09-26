<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = Auth::user();
    $reservations = [];

    if ($user->role === 'client') {
        // Le client voit les maâlems qu'il a réservés
        $reservations = DB::table('reservations')
            ->join('users', 'reservations.ouvrier_id', '=', 'users.id')
            ->where('reservations.client_id', $user->id)
            ->select('reservations.*', 'users.name as ouvrier_name', 'users.metier', 'users.telephone')
            ->orderBy('reservations.date_rendez_vous', 'asc')
            ->get();
    } elseif ($user->role === 'ouvrier') {
        // L'ouvrier voit les clients qui l'ont réservé
        $reservations = DB::table('reservations')
            ->join('users', 'reservations.client_id', '=', 'users.id')
            ->where('reservations.ouvrier_id', $user->id)
            ->select('reservations.*', 'users.name as client_name', 'users.telephone')
            ->orderBy('reservations.date_rendez_vous', 'asc')
            ->get();
    }

    return view('dashboard', compact('reservations'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Route pour afficher la liste des ouvriers aux clients connectés
Route::get('/ouvriers', [App\Http\Controllers\OuvrierController::class, 'index'])->name('ouvriers.index');
Route::post('/reservations', [App\Http\Controllers\ReservationController::class, 'store'])->name('reservations.store');
// Routes pour que l'ouvrier change le statut d'une réservation
Route::post('/reservations/{id}/accepter', [App\Http\Controllers\ReservationController::class, 'accepter'])->name('reservations.accepter');
Route::post('/reservations/{id}/refuser', [App\Http\Controllers\ReservationController::class, 'refuser'])->name('reservations.refuser');
// Routes pour l'administration des ouvriers
Route::get('/admin/validation', function() {
    // On récupère les ouvriers en attente de validation
    $ouvriersEnAttente = DB::table('users')->where('role', 'ouvrier')->where('statut_validation', 'en_attente')->get();
    return view('admin.validation', compact('ouvriersEnAttente'));
})->name('admin.validation');

Route::post('/admin/ouvrier/{id}/valider', function($id) {
    DB::table('users')->where('id', $id)->update(['statut_validation' => 'valide']);
    return redirect()->back()->with('success', 'L\'ouvrier a été validé avec succès et est maintenant visible sur le site !');
})->name('admin.valider');
require __DIR__.'/auth.php';
