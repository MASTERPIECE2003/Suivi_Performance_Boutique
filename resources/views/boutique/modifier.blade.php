<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MODIFIER LARAVEL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,400;0,600;0,700;0,800;0,900;1,800&family=Roboto:wght@500;700;900&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
        }
        
    </style>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c8/Orange_logo.svg/284px-Orange_logo.svg.png" alt="logo" style="width: 50px; height: auto; margin-right: 10px;">
        <a class="navbar-brand" href="#">BOTIKA | ORANGE</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#" style="color: white;">ACCUEIL</a>
                </li>
                <form action="{{ route('logout') }}" class="d-flex" role="search" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit" style="background-color: #ff5500;">Se déconnecter</button>
                </form>
            </ul>
        </div>
    </div>
</nav>

    
<div class="container">
    <div class="row">
        <div class="col-8 offset-2">
            <div class="card" style="margin-top: 15px;">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1>MODIFICATIONS</h1>
                        <a href="/etudiant/liste" class="btn btn-danger" style="margin-left: 500px;">Back</a>
                    </div>

                    <form action="{{ route('modifier.update', ['id_vente' => $vente->id_vente]) }}" method="POST" class="form-group">
                        @csrf
                        <div class="form-group">
                            <label for="mois" class="form-label">Mois</label>

                            <select class="form-control" id="mois" name="mois" required>
                                <option value="">Selectionner le mois</option>
                                @foreach($mois as $moisValue => $moisLabel)
                                    <option value="{{ $moisValue }}">{{ $moisLabel }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" id="id_vente" value="{{ $vente->id_vente }}">

                        <div class="form-group" style="margin-top: 10px;">
                            <label for="objectif" class="form-label">OBJECTIF</label>
                            <input type="text" class="form-control" id="objectif" name="objectif" required>
                        </div>

                        <div class="form-group">
                            <label for="realisation" class="form-label">RÉALISER</label>
                            <input type="text" class="form-control" id="realisation" name="realisation" required>
                        </div>
                        <div class="d-flex align-items-center" style="margin-top: 10px;">
                            <button type="submit" class="btn btn-primary">MODIFIER</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <br>
    </div>
</div>


<script>$(document).ready(function () {
  $('#mois').on('change', function () {
      // Récupérez la valeur du mois sélectionné
      var selectedMonth = $(this).val();
      
      // Récupérez l'ID de la vente depuis l'élément HTML
      var idVente = $('#id_vente').val();
    // Utilisez AJAX pour obtenir les objectifs et réalisations pour le mois sélectionné depuis le serveur
      $.ajax({
          type: 'GET',
          url: '/obtenir',
          data: {
              id_vente: idVente, // Utilisez l'ID de la vente récupéré depuis l'élément HTML
              mois: selectedMonth,
          },
          success: function (data) {
              // Mettez à jour les champs "objectif" et "réalisation" avec les données obtenues
              $('#objectif').val(data.objectif);
              $('#realisation').val(data.realisation);
          }
      });
  });
});
</script>
  



  </body>
</html>