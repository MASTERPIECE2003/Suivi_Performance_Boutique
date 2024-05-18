<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\objectif;

class ObjectifRealisationController extends Controller
{
    public function ObjectifsEtRealisations(Request $request)
    {
        try {
            $id_vente = $request->input('id_vente');
            $mois = $request->input('mois');
            
            // Récupérez les objectifs et réalisations correspondants depuis la base de données
            $data = objectif::where('id_vente', $id_vente)
                            ->where('mois', $mois)
                            ->first();
    
            if ($data) {
                return response()->json($data);
            } else {
                return response()->json(['error' => 'Données non trouvées'], 404);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
}
