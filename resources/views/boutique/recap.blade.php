<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SUIVIE DES PERFORMANCES DES BOUTIQUES</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,400;0,600;0,700;0,800;0,900;1,800&family=Roboto:wght@500;700;900&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
        }
        .table-container {
            max-height: 500px;
            max-width: 500%; /* Ajustez cette valeur en fonction de vos besoins */
            overflow: auto;
        }
    
        .container {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        }

        th:nth-child(4), td:nth-child(4) {
            width: 200px;
        }
        .fade {
        transition: opacity 0.25s;
        }
        .card {
        
            margin-left: -140px;
            width: 122%;
            position: -webkit-sticky;
            margin-top: 10px;
            top: 0;
            z-index: 2;
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
<nav class="sidebar">
      <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c8/Orange_logo.svg/284px-Orange_logo.svg.png" alt="logo" style="width: 50px; height: auto; margin-right: 10px;"> 
      <a href="#" class="logo" style="margin-top: 25px;">BOTIKA</a>
        <div class="menu-content">
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
                <div class="card">
                    <div class="card-body">
                        
                            <form method="get" action="{{ route('boutique.recap') }}">
                            <div class="form-group" style="margin-left: 5px;">      
                                    <label for="produits">FILTRER PAR PRODUIT :</label>
                                    <select name="produits[]" id="produits" multiple>
                                        <option value=" ">Tous les produits</option>
                                            @foreach($pdt as $produit)
                                        <option value="{{ $produit->idproduit }}">{{ $produit->nom_produit }}</option>
                                        @endforeach
                                    </select>
                                </div> 
                                <div class="form-group" style="margin-top: 15px;">
                                <label for="annee" class="col-form-label col-sm-3" style="margin-top: 0px;left:-1000px;">FILTRER PAR ANNEE :</label>   
                                    <select class="form-control" name="annee" id="annee" style="height: 35px; width: 25%;margin-left: 470px">
                                        <option value="">Annee</option>
                                            @foreach ($annees as $annee)
                                                <option value="{{ $annee }}">{{ $annee}}</option>
                                            @endforeach
                                    </select> 
                                </div>
                            <a href="{{ route('exportrecap.excel', ['produits' => request('produits'), 'vendeur' => request('vendeur'), 'pdv' => request('pdv')]) }}" class="btn btn-success">Exporter vers Excel</a>

                            <div class="input-group">
                                <label for="vendeur">FILTRER PAR VENDEUR :</label>
                                <input type="text" class="form-control" name="vendeur" id="vendeur">
                            </div> <div class="form-group">
                                <label for="produit">FILTRER PAR PDV :</label>
                                <select class="form-control" name="pdv" id="pdv">
                                    <option value="">Tous les pdv</option>
                                    @foreach ($podv->unique('pdv') as $vente)
                                        <option value="{{ $vente->pdv }}">{{ $vente->pdv }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group row" style="margin-top: 15px;margin-right: 210px;">
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary" style="margin-right: 15px;">FILTRER</button>
                                </div>
                            </div>
                            </form>
                    </div>    
                </div>
                <div class=" card-body table-container" style="width: 122%; margin-left: -138px; border-radius: 20px; margin-top: 10px;">
                    <div>

                            <div class="table-container">
                                <table id="example1" class="table table-bordered table-striped" >
                                    <thead>
                                    <tr>
                                            <th rowspan="2" style="text-align: center; color: black;">VENDEUR</th>
                                            <th rowspan="2" style="text-align: center; color: black;">PRESTATAIRE</th>
                                            <th rowspan="2" style="text-align: center; color: black;"> CVSE</th>
                                            <th rowspan="2" style="text-align: center; color: black;">PDV</th>
                                            <!-- Les colonnes des produits -->
                                            @foreach($produitFiltre as $idProduit)
                                            <?php
                                                $produit = App\Models\produit::find($idProduit); // Remplacez "\App\Produit" par le namespace de votre modèle Produit
                                            ?>
                                            @if ($produit)
                                                <th colspan="3">{{ $produit->nom_produit }}</th>
                                            @endif
                                        @endforeach
                                        </tr>
                                        <tr> @foreach($produitFiltre as $idProduit)
                                        <?php
                                            $produit = App\Models\produit::find($idProduit); // Remplacez "\App\Produit" par le namespace de votre modèle Produit
                                        ?>
                                        @if ($produit)
                                                <th style="text-align: center; color: black;">Objectif</th>
                                                <th style="text-align: center; color: black;">Réaliser</th>
                                                <th style="text-align: center; color: black;">R/O</th>
                                        
                                            @endif 
                                            @endforeach  
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($ventes->unique('vendeur') as $vente)
                                            <tr>
                                                <td>{{ $vente->vendeur }}</td>
                                                <td>{{ $vente->prestataire }}</td>
                                                <td>{{ $vente->cvse }}</td>
                                                <td>{{ $vente->pdv }}</td>
                                                @foreach($produitFiltre as $idProduit)
                                                <?php
                                                    $produit = App\Models\produit::find($idProduit); // Remplacez "\App\Produit" par le namespace de votre modèle Produit
                                                ?>
                                                @if ($produit)
                                                    @php
                                                        $totalObjectif = 0;
                                                        $totalRealisation = 0;
                                                    @endphp
                                                    @foreach($totauxParVendeur as $totauxVendeur)
                                                        @if ($totauxVendeur['vendeur'] === $vente->vendeur)
                                                            @foreach ($totauxVendeur['totauxParProduit'] as $totauxProduit)
                                                                @if ($totauxProduit['produit'] === $produit->idproduit)
                                                                    @php
                                                                        $totalObjectif = $totauxProduit['totalObjectif'];
                                                                        $totalRealisation = $totauxProduit['totalRealisation'];
                                                                    @endphp
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                    <td>{{ $totalObjectif }}</td>
                                                    <td>{{ $totalRealisation }}</td>
                                                    <td>
                                                        @if ($totalObjectif != 0)
                                                            {{ number_format(($totalRealisation * 100) / $totalObjectif, 2) . '%' }}
                                                        @else
                                                            0
                                                        @endif
                                                    </td> @endif
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                    
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</main>


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
