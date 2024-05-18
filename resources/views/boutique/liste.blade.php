<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SUIVIE DES PERFORMANCES DES BOUTIQUES</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,400;0,600;0,700;0,800;0,900;1,800&family=Roboto:wght@500;700;900&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
        }
        .custom-form {
            display: flex;
            flex-wrap: wrap;
        }
        .table-container {
            max-height: 620px;
            max-width: 300%;
            overflow: auto;
            
        }
        .container {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        }
        .card {
        margin-left: -140px;
        width: 122%;
        position: -webkit-sticky;
        margin-top: 10px;
        top: 0;
        z-index: 2;
        }


        th:nth-child(4), td:nth-child(4) {
            width: 200px;
        }
        .fade {
        transition: opacity 0.25s;
    }
    
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 48px 0 0;
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
            width: 250px; 
            color: black; 
            height: 100vh; /* Ajustez la hauteur en fonction de vos besoins */
            overflow-y: hidden; /* Désactiver le défilement vertical */
        }

        .sidebar-sticky {
            position: relative;
            top: 0;
            height: calc(100vh - 48px);
            padding-top: .5rem;
            overflow-x: hidden;
            overflow-y: auto;
        }
        .sidebar {
            position: fixed;
            height: 100%;
            width: 260px;
            background: black;
            padding: 15px;
            z-index: 99;
          }
          .logo {
            font-size: 35px;
            margin-top: 15px !important;
          }
          .sidebar a {
            color: #fff;
            text-decoration: none;
          }
          .menu-content {
            position: relative;
            height: 100%;
            width: 100%;
            margin-top: 40px;
            overflow-y: scroll;
          }
          .menu-content::-webkit-scrollbar {
            display: none;
          }
          .menu-items {
            height: 100%;
            width: 100%;
            list-style: none;
            transition: all 0.4s ease;
          }
          .submenu-active .menu-items {
            transform: translateX(-56%);
          }
          .menu-title {
            color: #fff;
            font-size: 14px;
            padding: 15px 20px;
          }
          .item a,
          .submenu-item {
            padding: 16px;
            display: inline-block;
            width: 100%;
            border-radius: 12px;
          }
          .item i {
            font-size: 12px;
          }
          .item a:hover,
          .submenu-item:hover,
          .submenu .menu-title:hover {
            background: #ff6600;
          }
          .submenu-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #fff;
            cursor: pointer;
          }
          .submenu {
            position: absolute;
            height: 100%;
            width: 100%;
            top: 0;
            right: calc(-100% - 26px);
            height: calc(100% + 100vh);
            background: #11101d;
            display: none;
          }
          .show-submenu ~ .submenu {
            display: block;
          }
          .submenu  {
            border-radius: 12px;
            cursor: pointer;
          }
          .submenu  i {
            margin-right: 10px;
          }
          .navbar,
          .main {
            left: 260px;
            width: calc(100% - 260px);
            transition: all 0.5s ease;
            z-index: 1000;
          }
          .sidebar.close ~ .navbar,
          .sidebar.close ~ .main {
            left: 0;
            width: 100%;
          }
          .navbar {
            position: fixed;
            color: #fff;
            padding: 15px 20px;
            font-size: 25px;
            background: #4070f4;
            cursor: pointer;
          }
          .navbar #sidebar-close {
            cursor: pointer;
          }
          .main {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            z-index: 100;
            background: #e7f2fd;
            color: #11101d;
            font-size: 15px;
            text-align: center;
          }
          .table-container table {
              font-size: 12px; /* Réduire la taille de la police */
          }
    </style>
</head>
<body>
<nav class="sidebar" style="height: 100vh; overflow-y: hidden;">
      <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c8/Orange_logo.svg/284px-Orange_logo.svg.png" alt="logo" style="width: 50px; height: auto; margin-right: 10px;"> 
      <a href="#" class="logo" style="margin-top: 25px;">BOTIKA</a>
        <div class="menu-content" style="max-height: calc(100vh - 100px); overflow-y: auto;">
            <ul class="menu-items">
                <li class="item">
                    
                <a class="nav-link" href="/boutique/tbl" style="color: white; margin-top: 10px;"><i class="fas fa-chart-line"></i> &nbsp;&nbsp; TABLEAU DE BORD </a>
                <a class="nav-link" href="/boutique/liste" style="color: white; margin-top: 10px;">
                    <i class="fas fa-list"></i> &nbsp;&nbsp; LISTAGE
                </a>
                <a class="nav-link" href="/boutique/recap" style="color: white;">
                    <i class="fas fa-file-alt"></i> &nbsp;&nbsp; RECAPITULATION
                </a>
                    <form action="{{ route('logout') }}" class="d-flex" role="search" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit" style="background-color: #ff5500; margin-top: 595px;">
                            <i class="fas fa-sign-out-alt"></i>  &nbsp;&nbsp; Se déconnecter
                        </button>
                    </form>
                </li>
            </ul>
        </div>

    </nav>
<main class="main">
    <div class="container text-center">
        <div class="row">
            <div class="col s12">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @php
                    $totalObjectifCumule = 0; // Déclaration de la variable au début
                    $totalrealCumule = 0;
                @endphp


                                    
            
                            @php
                            $totalObjectifCu = 0; // Réinitialise le total
                        $totalRealisationCu = 0; // Réinitialise le total
                            @endphp
                            @foreach ($ventes as $vente)
                                @foreach ($moisSelectionnes as $mois)
                                    @php
                                    $objectif = $vente->objectif->firstWhere('mois', $mois);
                                    $totalObjectifCu += $objectif->objectif ?? 0;
                                    $totalRealisationCu += $objectif->realisation ?? 0;
                                    @endphp
                                @endforeach
                            @endforeach
                    
                                    @php
                                    $totalObjectifCu = 0; // Réinitialise le total
                                    $totalRealisationCu = 0; // Réinitialise le total
                                    @endphp
                                    @foreach ($ventes as $vente)
                                        @foreach ($moisSelectionnes as $mois)
                                            @php
                                            $objectif = $vente->objectif->firstWhere('mois', $mois);
                                            $totalObjectifCu += $objectif->objectif ?? 0;
                                            $totalRealisationCu += $objectif->realisation ?? 0;
                                            @endphp
                                        @endforeach
                                    @endforeach

                <div class="card" style="position: sticky; top: 15px; margin-left: -140px; width: 122%;">
                    <div class="card-body" style="margin-left: 70px;">
                        <form action="{{ route('import.excel') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <select class="form-control" id="nomproduit" name="nomproduit" style="height: 30px; width: 21%; margin-left: 5px;">
                                <option value="">Sélectionnez la feuille que vous voulez importer</option>
                                @foreach ($produits->unique('nom_produit') as $produit)
                                    <option value="{{ $produit->nom_produit }}">{{ $produit->nom_produit }}</option>
                                @endforeach
                            </select>
                          
                                <label for="annee" style="margin-right: 96%;"> Année: </label>
                                <input type="text" class="form-control" name="annee" style="margin-right: 15px; width: 21%; margin-left: 5px;">
                       
                            
                            <div class="popoly" style="margin-left: -864px; margin-top: 5px;">
                                <input type="file" name="excel" style="margin-right: 80px;">
                                <button type="submit" class="btn btn-secondary" style="margin-left: 20px;">IMPORTER</button>
                                <a href="{{ route('export.excel', ['produit' => request('produit'), 'vendeur' => request('vendeur'), 'mois' => request('mois')]) }}" class="btn btn-success" style="margin-left: 15px; background-color: ;">EXPORTER</a>

                            </div>
                        </form>

                        
                        <form action="{{ route('boutique.liste') }}" method="GET">
                        <div class="custom-form">
                           
                            <div class="form-group" style="margin-left: 5px;">
                                <label for="produit" style="color: black; display: block;">FILTRER PAR PRODUIT :</label>
                                <select class="form-control" name="produit" id="produit" style="height: 30px; width: 180%;">
                                    <option value="">Tous les produits</option>
                                    @foreach ($produits->unique('nom_produit') as $produit)
                                        <option value="{{ $produit->nom_produit }}">{{ $produit->nom_produit }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" style="margin-left: 150px;">
                                <label for="vendeur" style="display: block; margin-right: 25px;" >FILTRER PAR VENDEUR :</label>
                                <input type="text" class="form-control" name="vendeur" id="vendeur" style="height: 30px; width: 130%;">
                            </div>
                            <div class="form-group" style="margin-left: 80px;">
                                <label for="produit" style="color: black; display: block; margin-right: 73px;">FILTRER PAR PDV :</label>
                                <select class="form-control" name="pdv" id="pdv" style="height: 30px; width: 140%;">
                                    <option value="">Tous les pdv</option>
                                    @foreach ($ventes->unique('pdv') as $vente)
                                        <option value="{{ $vente->pdv }}">{{ $vente->pdv }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" style="margin-left: 110px;">
                                <label for="mois" style="color: black; display: block;">FILTRER PAR MOIS :</label>
                                <select class="form-control" name="mois[]" id="mois" multiple style="height: 40px; width: 130%;">
                                    <option value="Janvier">Janvier</option>
                                    <option value="Février">Février</option>
                                    <option value="Mars">Mars</option>
                                    <option value="Avril">Avril</option>
                                    <option value="Mai">Mai</option>
                                    <option value="Juin">Juin</option>
                                    <option value="Juillet">Juillet</option>
                                    <option value="Août">Août</option>
                                    <option value="Septembre">Séptembre</option>
                                    <option value="Octobre">Octobre</option>
                                    <option value="Novembre">Novembre</option>
                                    <option value="Décembre">Décembre</option>
                                </select>
                            </div>
                            <div class="form-group" style="margin-left: 75px;">
                                <label for="annee" style="color: black; display: block;">FILTRER PAR ANNÉE :</label>
                                <select class="form-control" name="annee" id="annee" style="height: 30px; width: 130%;">
                                    <option value="">Année</option>
                                    @foreach ($annees as $annee)
                                        <option value="{{ $annee }}">{{ $annee}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group" style="margin-left: 80px; margin-top: 24px;">
                                <button type="submit" class="btn btn-primary">FILTRER</button>
                            </div>
                        </div>
                    </form>

                        
                        
                    </div>
                </div>
                

                <h1 style="margin-top: 15px;">ANNEE : {{$an}} </h1>
                @if(isset($_GET['produit']) || isset($_GET['vendeur']) || !empty($moisSelectionnes))
                <div class=" card-body table-container" style=" width: 122%; margin-left: -140px; border-radius: 20px; margin-top: 7px;">
                    <div>

                            <div class="table-container">
                                <table id="example1" class="table table-bordered table-striped" >
                                    <thead>
                                        @if (!$ventes->isEmpty())
                                        
                                        <tr>
                                            <th rowspan="2" style="text-align: center; color: black;">VENDEUR</th>
                                            <th rowspan="2" style="text-align: center; color: black; ">PRESTATAIRE</th>
                                            <th rowspan="2" style="text-align: center; color: black;">CVSE</th>
                                            <th rowspan="2" style="text-align: center; color: black; ">PDV</th>
                                            @foreach($moisSelectionnes as $mois)
                                                <th colspan="3" style="text-align: center; color: black;">{{ $mois }}</th>
                                            @endforeach
                                            <th colspan="3" style="text-align: center; color: black;">TOTAL</th>
                                        </tr>
                                        <tr>
                                            @foreach($moisSelectionnes as $mois)
                                                <th style="text-align: center; color: black;">Objectif</th>
                                                <th style="text-align: center; color: black;">Réaliser</th>
                                                <th style="text-align: center; color: black;">R/O</th>
                                            @endforeach
                                            <th style="text-align: center; color: black;">Objectif</th>
                                            <th style="text-align: center; color: black;">Réaliser</th>
                                            <th style="text-align: center; color: black;">R/O</th>
                                        </tr>
                                        
                                    </thead>
                                    <tbody>
                                        
                                        @foreach($ventes as $vente)
                                            <tr>
                                                <td>{{ $vente->vendeur }}</td>
                                                <td>{{ $vente->prestataire }}</td>
                                                <td>{{ $vente->cvse }}</td>
                                                <td>{{ $vente->pdv }}</td>
                                                @php
                                                
                                            $totalObjectif2023 = 0;
                                            $totalRealisation2023 = 0;
                                        @endphp

                                        @foreach($moisSelectionnes as $mois)
                                            @php
                                                $objectif = $vente->objectif->firstWhere('mois', $mois);
                                                $totalObjectif2023 += $objectif->objectif ?? 0;
                                                $totalRealisation2023 += $objectif->realisation ?? 0;
                                            @endphp
                                            <td>{{ $objectif->objectif != 0 ? $objectif->objectif : '-' }}</td>
                                    <td>{{ $objectif->realisation != 0 ? $objectif->realisation : '-' }}</td>
                                    
                                            <td>    
                                                 @if ($vente->idproduit === 8)
                                               
                                                    @if ($totalRealisation2023 == 18)
                                                        100%
                                                    @else
                                                        0%
                                                    @endif
                                                @else
                                                   @if (isset($objectif->objectif) && $objectif->objectif != 0)
                                                        {{ number_format(($objectif->realisation * 100) / $objectif->objectif, 2).'%' }}
                                                    @else
                                                        -
                                                    @endif
                                            @endif

                                            </td>
                                        @endforeach

                                            <td>{{ $totalObjectif2023 }}</td>
                                            <td>{{ $totalRealisation2023 }}</td>
                                            <td>
                                                @if ($totalObjectif2023 != 0)
                                                    {{ number_format(($totalRealisation2023 * 100) / $totalObjectif2023, 2).'%' }}
                                                @else
                                                    0
                                                @endif
                                            </td>   
                                            @php
                                                $totalObjectifCumule += $totalObjectif2023;
                                                $totalrealCumule+= $totalRealisation2023;
                                            @endphp
                                          </tr>
    
                                        @endforeach
                                        <tr> 
                                             <td style="text-align: center; color: black; ">Total cumulé</td>
                                             <td>{{ $totalObjectifCumule }}</td>
                                              <td>{{ $totalrealCumule }}</td> <!-- Vous pouvez laisser cette cellule vide pour la réalisation -->
                                             <td> 
                                            
                                                {{ number_format(( $totalrealCumule* 100) /  $totalObjectifCumule, 2).'%' }}
                                            
                                            </td> <!-- Vous pouvez laisser cette cellule vide pour le R/O -->
                                        </tr>
                                    </tbody>
                                @else
                                    <p>Aucune vente n'a été trouvée.</p>
                                @endif
                                @endif
                                </table>                  
                            </div>
                    </div>        
                </div>
            </div>
        </div>
    </div>
</main>



<script src="multiselect-dropdown.js" ></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
    $(function () {
        $("#example1").DataTable({
            paging: false,
            info: false,
            searching: false
        });
    });

   
</script>
</body>
</html>

