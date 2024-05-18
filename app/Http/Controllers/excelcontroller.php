<?php

namespace App\Http\Controllers;
use PhpOffice\PhpSpreadsheet\Spreadsheet;


use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Http\Request;
use App\Models\vente;
use App\Models\objectif;
use App\Models\produit;
use Carbon\Carbon;

class excelcontroller extends Controller
{
    

    
    public function importExcel(Request $request)
    {
        try {
            $file = request()->file('excel');
            $selectedSheet = $request->input('nomproduit');
            
            $annee = $request->input('annee');
            $spreadsheet = IOFactory::load($file);
            $spreadsheet->setActiveSheetIndexByName($selectedSheet);
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();
            $produit = produit::where('nom_produit', $selectedSheet)->first();
           
            $moisNumeriques = [
                'Janvier' => 1,
                'Février' => 2,
                'Mars' => 3,
                'Avril' => 4,
                'Mai' => 5,
                'Juin' => 6,
                'Juillet' => 7,
                'Août' => 8,
                'Septembre' => 9,
                'Octobre' => 10,
                'Novembre' => 11,
                'Décembre' => 12,
            ];  
    
            $currentVente = null;
            $vente = null;
            $firstRowProcessed = false;
    
            for ($i = 2; $i < count($rows); $i++) {
                $row = $rows[$i];
                // Assurez-vous que la ligne a suffisamment de colonnes
                if (count($row) >= 4) {
                    $vendeur = $row[0];
                    if (empty($vendeur)) {
                        // Si la cellule "vendeur" est vide, passez à la ligne suivante
                        continue;
                    }
                    $pdv = $row[3]; // Récupérez le pdv du fichier Excel
                    // Vérifiez si le vendeur existe dans la base de données
                    $existingVente = vente::where('vendeur', $vendeur)
                        ->where('idproduit', $produit->idproduit)
                        ->where('annee', $annee)
                        ->first();
                    
                    if ($existingVente) {
                        // Vérifiez le pdv associé au vendeur
                        if ($existingVente->pdv !== $pdv) {
                            // Si le pdv est différent, créez une nouvelle entrée
                            $vente = new vente();
                            $vente->vendeur = $vendeur;
                            $vente->prestataire = !empty($row[1]) ? $row[1] : 0;
                            $vente->cvse = $row[2];
                            $vente->pdv = $pdv; // Utilisez le nouveau pdv du fichier Excel
                            $vente->idproduit = $produit->idproduit;
                            $vente->annee = $annee;
                            $vente->save();
                            $currentVente = $vendeur;
                        } else {
                            // Le vendeur et le pdv correspondent, utilisez l'entrée existante
                            $vente = $existingVente;
                        }
                    } else {
                        // Le vendeur n'existe pas encore dans la base de données, créez une nouvelle entrée
                        $vente = new vente();
                        $vente->vendeur = $vendeur;
                        $vente->prestataire = !empty($row[1]) ? $row[1] : 0;
                        $vente->cvse = $row[2];
                        $vente->pdv = $pdv;
                        $vente->idproduit = $produit->idproduit;
                        $vente->annee = $annee;
                        $vente->save();
                        $currentVente = $vendeur;
                    }
                    for ($colonne = 4; $colonne < 40; $colonne += 3) {
                        // Obtenez le mois correspondant à cette colonne depuis la première ligne
                        $mois = $rows[0][$colonne];
                        // Traitez les valeurs de cette colonne
                        $cellObjectif = $row[$colonne];
                        $cellRealisation = $row[$colonne + 1];
                        $cellObjectif = iconv('ISO-8859-1', 'UTF-8', $cellObjectif);
                        $cellObjectif = preg_replace('/[^0-9]/', '', $cellObjectif);
                        $cellRealisation = iconv('ISO-8859-1', 'UTF-8', $cellRealisation);
                        $cellRealisation = preg_replace('/[^0-9]/', '', $cellRealisation);
                        $objectif = !empty($cellObjectif) ? $cellObjectif : 0;
                        $realisation = !empty($cellRealisation) ? $cellRealisation : 0;
                        $objectifRecord = objectif::firstOrNew([
                            'id_vente' => $vente->id_vente,
                            'id_mois' => $moisNumeriques[$mois] ?? null,
                        ]);
    
                        $objectifRecord->mois = $mois;
                        $objectifRecord->objectif = $objectif;
                        $objectifRecord->realisation = $realisation;
                        $objectifRecord->save();
                    }
                    $currentVente = null;
                }
            }
            return redirect()->route('boutique.liste');
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e->getMessage());
        }
    }
    
        
  
   public function exportExcel(Request $request)
{$moisSelectionnes = ['Janvier', 'Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'];
    $produit = $request->input('produit');
    $vendeur = $request->input('vendeur');
    $moisSelectionnes = $request->input('mois', []);

    // Utilisez les filtres pour obtenir les données filtrées
    $query = vente::query();

    if ($produit) { $nomProduit = $produit;
        $idProduit = produit::where('nom_produit', $nomProduit)->value('idproduit');
        $query->where('idproduit', $idProduit);
    }

    if ($vendeur) {
        $query->where('vendeur', 'like', '%' . $vendeur . '%');
    }

    if (!empty($moisSelectionnes)) {
        if (count($moisSelectionnes) === 1) {
            // Si un seul mois est sélectionné, utilisez une requête simple avec "="
            $query->whereHas('objectif', function ($query) use ($moisSelectionnes) {
                $query->where('mois', $moisSelectionnes[0]);
            });
        } else {
            // Si plusieurs mois sont sélectionnés, utilisez "whereIn" pour les inclure tous
            $query->whereHas('objectif', function ($query) use ($moisSelectionnes) {
                $query->whereIn('mois', $moisSelectionnes);
            });
        }
    }
    
 
    $data = $query->get();
    

 // Remplacez Vente par le modèle que vous utilisez

    // Créez un nouvel objet Spreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $colonne = 'E'; // Commencez depuis la colonne Eaaa

    foreach ($moisSelectionnes as $mois) {
        // Définissez les valeurs "Objectif" et "Réalisation" dans la même ligne pour chaque mois
        $sheet->setCellValue($colonne . '1', $mois);
        $sheet->setCellValue($colonne . '2', 'Objectif');
        $colonne++; // Passez à la prochaine colonne
        $sheet->setCellValue($colonne . '2', 'Réalisation');
        $colonne++; // Passez à la prochaine colonne
        $sheet->setCellValue($colonne . '2', 'RO');
        
    
        $colonne++;
    }
    
    // Ajoutez les en-têtes de colonnes
    $sheet->setCellValue('A2', 'Vendeur');
    $sheet->setCellValue('B2', 'Prestataire');
    $sheet->setCellValue('C2', 'CVSE');
    $sheet->setCellValue('D2', 'PDV');
  
    // Bouclez à travers les données et ajoutez-les au fichier Excel
   // ...
$row = 3; // Commencez à la ligne 3
$currentVendeur = null; // Initialisez la variable pour suivre le vendeur actuel

foreach ($data as $item) {
    // Vérifiez si le vendeur a changé
    if ($item->vendeur !== $currentVendeur) {
        $currentVendeur = $item->vendeur; // Mettez à jour le vendeur actuel
        $colonne = 'E'; // Réinitialisez la colonne pour les objectifs pour ce vendeur
    }

    $sheet->setCellValue('A' . $row, $item->vendeur);
    $sheet->setCellValue('B' . $row, $item->prestataire);
    $sheet->setCellValue('C' . $row, $item->cvse);
    $sheet->setCellValue('D' . $row, $item->pdv);

    // Utilisez ->get() pour obtenir une collection de résultats
    $datao = objectif::query()->where('id_vente', $item->id_vente)->get();

    // Remplissez les données d'objectif pour chaque mois
    foreach ($moisSelectionnes as $mois) {
        $objectif = $datao->where('mois', $mois)->first();

        if ($objectif) {
            $sheet->setCellValue($colonne . $row, $objectif->objectif);
            $colonne++;
            $sheet->setCellValue($colonne . $row, $objectif->realisation);
            $colonne++;
            if ($objectif->objectif != 0) {
                $ro = ($objectif->realisation * 100) / $objectif->objectif;
            } else {
                $ro = 0; // Évitez la division par zéro en définissant RO à 0 si l'objectif est de zéro
            }
            $sheet->setCellValue($colonne . $row, $ro);
            $colonne++;
        } else {
            // Si aucune donnée d'objectif n'est trouvée pour ce mois, laissez les cellules vides
            $colonne += 3;
        }
    }

    $row++; // Passez à la prochaine ligne uniquement lorsque le vendeur change
}
// ...


    // Créez un objet Writer pour exporter au format XLSX
    $writer = new Xlsx($spreadsheet);

    // Spécifiez les en-têtes pour le téléchargement
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="exported_data.xlsx"');

    // Écrivez le fichier Excel dans la sortie
    $writer->save('php://output');
} 

public function exportrecap(Request $request)
{  
    // Utilisez les filtres pour obtenir les données filtrées
    $ventes = vente::query();
 $produits = $request->input('produits', []);
 $produitNoms = [];
 $vendeurFiltre = $request->input('vendeur');
 if ($vendeurFiltre) {
    // Si un nom de vendeur est spécifié, filtrez les ventes par nom de vendeur
    $ventes->where('vendeur', 'like', '%' . $vendeurFiltre . '%');
}    $produitFiltre = $request->input('produits',[]);

 if (!empty($produits)) {
     $produitsModel = produit::whereIn('idproduit', $produits)->get();

     // Obtenir les noms des produits
     $produitNoms = $produitsModel->pluck('nom_produit', 'idproduit')->all();  
 }
 $vendeurs = Vente::distinct('vendeur')->pluck('vendeur');

 $ventes = $ventes->get();
    
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $colonne = 'E'; // Commencez depuis la colonne Eaaa
    
// Créez un tableau pour stocker les totaux
$totauxParVendeur = [];

// Pour chaque vendeur* 
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




    foreach ($produitNoms as $produit) {
        // Définissez les valeurs "Objectif" et "Réalisation" dans la même ligne pour chaque mois
        $sheet->setCellValue($colonne . '1', $produit);
        $sheet->setCellValue($colonne . '2', 'Objectif');
        $colonne++; // Passez à la prochaine colonne
        $sheet->setCellValue($colonne . '2', 'Réalisation');
        $colonne++; // Passez à la prochaine colonne
        $sheet->setCellValue($colonne . '2', 'RO');
        
    
        $colonne++;
    }



    // Ajoutez les en-têtes de colonnes
    $sheet->setCellValue('A2', 'Vendeur');
    $sheet->setCellValue('B2', 'Prestataire');
    $sheet->setCellValue('C2', 'CVSE');
    $sheet->setCellValue('D2', 'PDV');
    $row = 3; // Commencez depuis la 3ème ligne
    foreach ($ventes->unique('vendeur') as $vente) {
        $sheet->setCellValue('A' . $row, $vente->vendeur);
        $sheet->setCellValue('B' . $row, $vente->prestataire);
        $sheet->setCellValue('C' . $row, $vente->cvse);
        $sheet->setCellValue('D' . $row, $vente->pdv);

        $colonne = 'E'; // Réinitialisez la colonne
        foreach ($produitFiltre as $idProduit) {
            $totalObjectif = 0;
            $totalRealisation = 0;
            
            foreach ($totauxParVendeur as $totauxVendeur) {
                if ($totauxVendeur['vendeur'] === $vente->vendeur) {
                    foreach ($totauxVendeur['totauxParProduit'] as $totauxProduit) {
                        if ($totauxProduit['produit'] === $idProduit) {
                            $totalObjectif = $totauxProduit['totalObjectif'];
                            $totalRealisation = $totauxProduit['totalRealisation'];
                        }
                    }
                }
            }

            $sheet->setCellValue($colonne . $row, $totalObjectif);
            $colonne++;
            $sheet->setCellValue($colonne . $row, $totalRealisation);
            $colonne++;
            $sheet->setCellValue($colonne . $row, ($totalObjectif != 0) ? number_format(($totalRealisation * 100) / $totalObjectif, 2) . '%' : 0);
            $colonne++;
        }

        $row++;
    }
    $writer = new Xlsx($spreadsheet);

    // Spécifiez les en-têtes pour le téléchargement
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="exported_data.xlsx"');

    // Écrivez le fichier Excel dans la sortie
    $writer->save('php://output');
}


     }
   
       
  