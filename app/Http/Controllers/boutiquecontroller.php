<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\login;
use Illuminate\Http\Request;
use App\Models\vente;
use App\Models\objectif;
use App\Models\produit;
use Illuminate\Support\Facades\Auth;


class boutiquecontroller extends Controller
{
    public function liste(Request $request)
    {   $nombreDeVendeurs = vente::distinct('vendeur')->count();
       $nombrepdv=vente::distinct('pdv')->count();
        $ventes = vente::query();
        $annees = $ventes->distinct()->pluck('annee');
     
        $moisSelectionnes = $request->input('mois', []);
        if (empty($moisSelectionnes)) {
            $moisSelectionnes = ['Janvier', 'Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre']; // Par défaut, vous pouvez choisir les mois que vous préférez
        }
        if ($request->filled('produit')) {
            $nomProduit = $request->input('produit');
        } else {
            $nomProduit = 'ACTIVATIONS'; // Utilisez "ACTIVATIONS" comme valeur par défaut
        }
        
        if ($request->filled('annee')) {
            $annee = $request->input('annee');
            $an = $request->input('annee');
            $ventes->where('annee',$annee);
        }
        else {
        $an="2023";}
        // Recherchez l'idproduit correspondant au nom de produit
        $idProduit = produit::where('nom_produit', $nomProduit)->value('idproduit');
        
        // Utilisez l'idProduit pour filtrer les ventes
        $ventes->where('idproduit', $idProduit);
        if ($request->filled('pdv')) {
            $pdv = $request->input('pdv');
            $ventes->where('pdv',$pdv);
        }
        
        if ($request->filled('vendeur')) {
            $vendeur = $request->input('vendeur');
            $ventes->where('vendeur', 'like', '%' . $vendeur . '%');
        }
        
        if ($request->filled('mois')) {
           
           
            if (is_array($moisSelectionnes) && !empty($moisSelectionnes)) {
                $ventes = $ventes->whereHas('objectif', function ($query) use ($moisSelectionnes) {
                    $query->whereIn('mois', $moisSelectionnes);
                });
            }
        }
        

        $produits = produit::all();
        
//dd($moisSelectionnes);
  

    // Récupérer les données des objectifs (liés aux ventes)
    $objectifs = objectif::all();
                         
    $ventes = $ventes->get();
    $podv =vente::all();
    return view('boutique.liste', compact('ventes', 'objectifs','produits','moisSelectionnes','annees','podv','nombreDeVendeurs','nombrepdv','an'));
    }
    public function tbl(Request $request) {
        $nombreDeVendeurs = vente::distinct('vendeur')->count();
        $nombrepdv = vente::distinct('pdv')->count();
        $produits = produit::all();
        $moisSelectionnes = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre']; // Par défaut, vous pouvez choisir les mois que vous préférez
        $objectifs = objectif::all();
        $ventes = vente::all();
        // Récupérez le vendeur sélectionné depuis la requête
        $selectedProduit = $request->input('produit');
        $selectedVendeur = $request->input('vendeur');
        
        // Filtrer les ventes en fonction du vendeur sélectionné
        $vent = Vente::join('objectif', 'vente.id_vente', '=', 'objectif.id_vente')
        ->select('vente.vendeur', 'objectif.mois', 'objectif.objectif', 'objectif.realisation');
        if ($selectedProduit) {
            $vent->where('vente.idproduit', $selectedProduit);  
        }
        else {$vent->where('vente.idproduit', "1");  
        }
        
    if ($selectedVendeur) {
        $vent->where('vente.vendeur', $selectedVendeur);
    }
    else {
        $vent->where('vente.vendeur',"HLB");
    
    }
    $vent = $vent->get();
    
    $data = [];
      
    $totalObjectifCu = 0; // Initialise le total
    $totalRealisationCu = 0;
    foreach ($vent as $vente) {
        $ro = ($vente->objectif !== 0) ? ($vente->realisation / $vente->objectif)*100 : 0;
    
        $data[] = [
            'vendeur' => $vente->vendeur,
            'mois' => $vente->mois,
            'objectif' => $vente->objectif,
            'realisation' => $vente->realisation,
            'ro' => $ro, // Ajoutez 'ro' avec la valeur calculée $ro
        ];
        $totalObjectifCu += $vente->objectif;
        $totalRealisationCu += $vente->realisation;
    }
    
    
   

    return view('boutique.tbl', compact('data', 'produits', 'moisSelectionnes', 'nombreDeVendeurs', 'nombrepdv','ventes','totalObjectifCu', 'totalRealisationCu'));
}
    
   
    public function recap(Request $request)
    {   
        $objectifs = objectif::all();
        $pdt = produit::all();
        $ventes = vente::query();
      //$ventes=vente::all();
      $produitFiltre = $request->input('produits',[]);
      $annees = $ventes->distinct()->pluck('annee');
$vendeurFiltre = $request->input('vendeur');
      if (empty($produitFiltre)) {
       
      $produitFiltre= $pdt->pluck( 'idproduit')->all();
      
    } 
    // Obtenez la liste des mois distincts
$moisDistincts = Objectif::distinct()->pluck('mois');
// Obtenez une liste distincte des vendeurs
$vendeurs = Vente::distinct('vendeur')->pluck('vendeur');
$vendeurFiltre = $request->input('vendeur');


    if ($vendeurFiltre) {
        // Si un nom de vendeur est spécifié, filtrez les ventes par nom de vendeur
        $ventes->where('vendeur', 'like', '%' . $vendeurFiltre . '%');
    }
    if ($request->filled('pdv')) {
        $pdv = $request->input('pdv');
        $ventes->where('pdv',$pdv);
    }

$ventes = $ventes->get();
// Obtenez la liste des produits distincts
$produits = Vente::distinct('idproduit')->pluck('idproduit');

// Créez un tableau pour stocker les totaux
$totauxParVendeur = [];

// Pour chaque vendeur
foreach ($vendeurs as $vendeur) {
    // Initialisez un tableau pour stocker les totaux des produits pour ce vendeur
    $totauxParProduit = [];

    // Pour chaque produit
    foreach ($produits as $produit) {
        if (!empty($produitFiltre) && !in_array($produit, $produitFiltre)) {
            continue; // Passe au produit suivant si le filtre ne correspond pas
        }
       
        // Initialisez les totaux
        $totalObjectif = 0;
        $totalRealisation = 0;

        // Pour chaque vente de ce vendeur et de ce produit
        $ventesDuVendeur = Vente::where('vendeur', $vendeur)->where('idproduit', $produit)->get();

        foreach ($ventesDuVendeur as $vente) {
            // Initialisez les totaux
            $totalObjectif = 0;
            $totalRealisation = 0;

            // Pour chaque mois
            $mois = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
            foreach ($mois as $mois) {
                $objectif = Objectif::where('id_vente', $vente->id_vente)->where('mois', $mois)->first();
                if ($objectif) {
                    $totalObjectif += $objectif->objectif;
                    $totalRealisation += $objectif->realisation;
                }
            }

            // Stockez les totaux pour ce produit dans le tableau
            $totauxParProduit[] = [
                'produit' => $produit,
                'totalObjectif' => $totalObjectif,
                'totalRealisation' => $totalRealisation,
            ];
        }
    }

    // Stockez les totaux pour ce vendeur
    $totauxParVendeur[] = [
        'vendeur' => $vendeur,
        'totauxParProduit' => $totauxParProduit,
    ];
}

// Vous avez maintenant un tableau $totauxParVendeur contenant les totaux des objectifs par produit pour chaque vendeur distinct.
$podv =vente::all();


        return view('boutique.recap',compact('ventes','pdt','totauxParVendeur','produitFiltre','podv' ,'annees'));
    }
    public function ajouter(Request $request)
    { $produit = $request->input('produit');
        // Utilisez les filtres pour obtenir les données filtrées
        $query = vente::query(); 
    
        if ($produit) { $nomProduit = $produit;
            $idProduit = produit::where('nomproduit', $nomProduit)->value('idproduit');
            $query->where('idproduit', $idProduit); 
        } 
        else{
            $produit="ACTIVATIONS";
            $nomProduit = $produit;
            $idProduit = produit::where('nom_produit', $nomProduit)->value('idproduit');
            $query->where('idproduit', $idProduit); 
        }
       
        return view('boutique.ajouter',compact('idProduit'));
    }
   
public function store(Request $request){
    $vendeur =  vente::create([
            
            'vendeur' => $request->input('vendeur'),
            'prestataire' => $request->input('prestataire'),
            'cvse' => $request->input('cvse'),
            'pdv' => $request->input('pdv'),
            'idproduit'=>$request->input('idpro')
        ]); $vendeurId = $vendeur->id_vente;

        // Liste des mois
        $moisList = [
            1 => 'Janvier',
            2 => 'Février',
            3 => 'Mars',
            4 => 'Avril',
            5 => 'Mai',
            6 => 'Juin',
            7 => 'Juillet',
            8 => 'Août',
            9 => 'Septembre',
            10 => 'Octobre',
            11 => 'Novembre',
            12 => 'Décembre'
        ];
    
        // Bouclez à travers les mois et initialisez les objectifs à zéro
        foreach ($moisList as $idMois => $nomMois) {
            objectif::create([
                
                'id_mois' => $idMois,
                'mois' => $nomMois,
                'objectif' => 0,
                'realisation' => 0,
                'id_vente' => $vendeurId,
            ]);
        }
   
    return redirect()->route('boutique.liste');
}
public function suppr($id_vente){
    $vente=vente::Find($id_vente);
  $vente->delete();
  return redirect()->route('boutique.liste')->with('success', 'supprimer mis à jour avec succès.');
  }

 
  public function modifier($id_vente)
{
    $vente = Vente::find($id_vente);
    $objectifs = Objectif::where('id_vente', $vente->id_vente)->get();
    $mois = $objectifs->pluck('mois', 'mois');
    
    return view('boutique.modifier', compact('vente', 'mois'));
}
public function update(Request $request, $id_vente)
{
    // Validation des données
    $this->validate($request, [
        'objectif' => 'required',
        'realisation' => 'required',
        // Ajoutez d'autres règles de validation au besoin
    ]);

    // Récupérez l'objectif spécifique en fonction de l'ID de la vente et du mois
    $objectif = objectif::where('id_vente', $id_vente)
        ->where('mois', $request->mois) // Assurez-vous d'avoir le mois dans la requête
        ->first();

    if ($objectif) {
        // Mettez à jour les données de l'objectif avec les données validées
        $objectif->objectif = $request->objectif;
        $objectif->realisation = $request->realisation;
        $objectif->save();

        return redirect()->route('boutique.liste')->with('success', 'Objectif et réalisation mis à jour avec succès.');
    }
}
  
}