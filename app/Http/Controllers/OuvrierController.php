<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class OuvrierController extends Controller
{
    public function index(Request $request)
{
    // 1. On récupère uniquement les ouvriers qui ont été validés par l'admin
    $query = User::where('role', 'ouvrier')->where('statut_validation', 'valide');

    // 2. Filtrer par métier si le client a sélectionné un métier
    if ($request->has('metier') && $request->metier != '') {
        $query->where('metier', $request->metier);
    }

    // 3. NOUVEAU : Filtrer par ville si le client a sélectionné une ville
    if ($request->has('ville') && $request->ville != '') {
        $query->where('ville', $request->ville);
    }

    // 4. On récupère les résultats filtrés
    $ouvriers = $query->get();

    // 5. On renvoie les données à la vue
    return view('ouvriers.index', compact('ouvriers'));
}
}
