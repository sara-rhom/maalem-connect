<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'ouvrier_id' => 'required|exists:users,id',
            'date_reservation' => 'required|date|after_or_equal:today',
            'creneau_horaire' => 'required|string',
            'description_demande' => 'required|string|max:500',
        ]);
    
        \DB::table('reservations')->insert([
            'client_id' => Auth::id(),
            'ouvrier_id' => $request->ouvrier_id,
            'date_rendez_vous' => $request->date_reservation,
            'creneau_horaire' => $request->creneau_horaire,
            'description_demande' => $request->description_demande,
            'statut' => 'en_attente',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        return redirect()->route('dashboard')->with('success', 'Votre demande de réservation a bien été envoyée !');
    }
    // Fonction pour accepter un rendez-vous
public function accepter($id)
{
    \DB::table('reservations')
        ->where('id', $id)
        ->update(['statut' => 'accepte', 'updated_at' => now()]);

    return redirect()->route('dashboard')->with('success', 'Vous avez accepté ce rendez-vous ! Le client en est informé.');
}

// Fonction pour refuser un rendez-vous
public function refuser($id)
{
    \DB::table('reservations')
        ->where('id', $id)
        ->update(['statut' => 'refuse', 'updated_at' => now()]);

    return redirect()->route('dashboard')->with('success', 'Le rendez-vous a été refusé.');
}
}