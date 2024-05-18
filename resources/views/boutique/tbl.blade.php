<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SUIVIE DES PERFORMANCES DES BOUTIQUES</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


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
            max-height: 650px;
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
            overflow-y: hidden; /* Désactiver le défilement vertical */
        }
          .table-container table {
              font-size: 12px; /* Réduire la taille de la police */
          }
          .dashboard { 
                  
              display: flex;

          }
        .card-nmbpdv p {
            margin-left: 140px; 
        }
        .card-nmbrv p {
            margin-left: 140px; 
        } #myChart{
        width: 200px;}


        .card-nmbpdv,.card-real,.card-obj,.card-nmbrv  {
            width: 400px;
            height: 150px;
            background: #EB861A;
            color: #fff;
            border-radius: 20px;
            display: flex;
            flex-direction: row; 
            justify-content: center; /* Centrer horizontalement */
            align-items: center; /* Centrer verticalement */
            font-size: 24px;
            font-weight: bold;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            white-space: nowrap;
            margin-bottom: 20px;
            margin-top: 20px;
            margin-left: 40px;
        }

        .cardBox {
            position: relative;
            padding: 20px;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-gap: 195px; /* Augmentez l'espace entre les cartes */
            margin: 40px;
            margin-left: 170px;
            margin-top: 25px;
        }
        .cardBox .card {
          position: relative;
          background: rgb(255, 123, 15);
          padding: 30px;
          border-radius: 12px;
          display: flex;
          justify-content: space-between;
          box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
          transition: background 0.3s ease;
          width: 250%;
          margin-right: 20px !important; /* Ajoutez !important */
          height: 90px; /* Ajustez la hauteur selon vos besoins */



        }
        .cardBox .card .numbers {
          position: relative;
          font-weight: 500;
          font-size: 2.5rem;
          color: var(--blue);
          display: flex;
          align-items: center;
          font-family: 'Poppins', sans-serif; /* Centrer verticalement le texte et l'icône */
        }
        .cardBox .card .cardName {
          color: var(--black2);
          font-size: 1.1rem;
          margin-top: 5px;
          font-family: 'Poppins', sans-serif; 
        }
        .cardBox .card .iconBx {
          font-size: 3.5rem;
          color: var(--black2);
          display: flex;
          align-items: center; /* Centrer verticalement l'icône */
        }
        .cardBox .card:hover {
          background: rgb(249, 181, 126);
        }
        .cardBox .card:hover .numbers,
        .cardBox .card:hover .cardName,
        .cardBox .card:hover .iconBx {
          color: var(--white);
        }
        #filterButton {  
          background-color: #CCCCCC;
          color: #000000;
          padding: 10px 20px;
          font-size: 9px;
          border-radius: 5px;
        }

        @media (max-width: 768px) {
          #filterButton {
            width: 100%;
            padding: 0;
            font-size: 24px;
            line-height: 2;
          }
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

                @php
                    $totalObjectifCumule = 0;
                    $totalrealCumule = 0;
                @endphp



<!-- Sale & Revenue Start -->
<div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fas fa-user fa-3x" style="color: rgb(255, 123, 15);"></i>
                            <div class="ms-3">
                                <p class="mb-2">NOMBRE VENDEUR</p>
                                <h6 class="mb-0">{{$nombreDeVendeurs}}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fas fa-store fa-3x" style="color: rgb(255, 123, 15);"></i>
                            <div class="ms-3">
                                <p class="mb-2">NOMBRE POINT DE VENTE</p>
                                <h6 class="mb-0">{{$nombrepdv}}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fas fa-bullseye fa-3x" style="color: rgb(255, 123, 15);"></i>
                            <div class="ms-3">
                                <p class="mb-2">TOTAL OBJECTIFS</p>
                                <h6 class="mb-0">{{$totalObjectifCu}}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fas fa-chart-bar fa-3x"  style="color: rgb(255, 123, 15);"></i>
                            <div class="ms-3">
                                <p class="mb-2">TOTAL REALISATION</p>
                                <h6 class="mb-0">{{$totalRealisationCu}}</h6>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


                <form action="{{ route('boutique.tbl') }}" method="GET" style="margin-top: 29px;">
                    <label for="produit">Produit :</label>
                    <select name="produit" id="produit" style="height: 41px;">
                        <option value="">Tous les produits</option>
                        @foreach ($produits as $produit)
                            <option value="{{ $produit->idproduit }}">{{ $produit->nom_produit }}</option>
                        @endforeach
                    </select>
                    <label for="vendeur">Sélectionnez un vendeur :</label>
                    <select name="vendeur" id="vendeur" style="height: 41px;">
                        <option value="">Tous les vendeurs</option>
                        @foreach($ventes->unique('vendeur') as $v)
                            <option value="{{ $v->vendeur }}">{{ $v->vendeur }}</option>
                        @endforeach
                    </select>
                    <button id="filterButton" type="submit" style="background-color: #CCCCCC; color: #000000; font-size: 12px;">Afficher le graphique</button>
                </form>

                <div class="card-responsive" style="background-color: #fff; width: 122%; margin-left: -145px; border-radius: 15px; margin-top: 29px;">
                    <canvas id="myChart" width="1560%" height="700"></canvas>
                    <div id="vendeurName" style="display: none; color: #000; font-weight: bold;"></div>
                </div>
            </div>
        </div>
    </div>
<script>
 

    document.getElementById('produit').addEventListener('change', () => {
        var chartData = @json($data);
        // Réaffichez le graphique avec les nouvelles données
    });

    document.getElementById('vendeur').addEventListener('change', () => {
        var chartData = @json($data);
        // Réaffichez le graphique avec les nouvelles données
    });
</script>

        <script>
    var chartData = @json($data); // Assurez-vous que $chartData contient vos données dynamiques
</script>
                <script>
                  var customLabels = chartData.map(entry => entry.mois );
                  
  // Récupérez les données pour le graphique depuis votre contrôleur ou une autre source
  var data = {
    labels: customLabels, 
    datasets: [
        {
            label: "R/O",
            data: chartData.map(entry => entry.ro),
            backgroundColor: chartData.map(entry => entry.ro < 20 ? "rgb(255, 0, 0, 0.2)" : "rgba(75, 500, 192, 0.2)"),
            borderColor: chartData.map(entry => entry.ro < 20 ? "rgb(255, 0, 0, 1)" : "rgba(75, 192, 192, 1)"),
            borderWidth: 1,
        }
    ],
};
var vendeurLabels = chartData.map(entry => entry.vendeur);

data.labels = data.labels.map((label, index) => {
    return `${label} - ${vendeurLabels[index]}`;
});

  // Configuration du graphique
  var config = {
    type: "bar", // Type de graphique (par exemple, bar, line, pie, etc.)
    data: data,
    options: {
        responsive: false, // Désactivez la réactivité par défaut
        maintainAspectRatio: false, // Désactivez le maintien du rapport hauteur/largeur
        scales: {
    x: {
        beginAtZero: true, // Vous pouvez configurer d'autres options ici
    },
    y: {
        beginAtZero: true,  min: 0,     // Définissez la valeur minimale de l'axe Y à 0%
                max: 100,   // Définissez la valeur maximale de l'axe Y à 100%
                ticks: {
                    stepSize: 10,  // Réglez l'intervalle entre les étiquettes de l'axe Y
                }// Vous pouvez configurer d'autres options ici
    }
}
,   
        width: 1000, // Largeur en pixels
        height: 2000, // Hauteur en pixels
    }
  };
  console.log(chartData);
  // Créez une instance du graphique
  var myChart = new Chart(document.getElementById("myChart"), config);

// Rendre le graphique visible
document.getElementById("myChart").style.display = "block";

</script>




</body>
</html>
