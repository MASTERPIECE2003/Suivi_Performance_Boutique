<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SUIVIE DES PERFORMANCES DES BOUTIQUES</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,400;0,600;0,700;0,800;0,900;1,800&family=Roboto:wght@500;700;900&display=swap');

    body {
        font-family: 'Poppins', sans-serif;
        
    }
    .custom-checkbox {
            margin-right: 98px; /* Ajustez la valeur selon vos besoins */
        }

      
    </style>
</head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="border-radius: 0;">
    <div class="container">
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c8/Orange_logo.svg/284px-Orange_logo.svg.png" alt="logo" style="width: 50px; height: auto; margin-right: 10px;">
        <a class="navbar-brand" href="#" style="margin-bottom: 20px;">BOTIKA | ORANGE</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav" style="margin-left: 650px; font-family: 'Poppins', sans-serif;">
            <ul class="navbar-nav ms-auto" style="margin-left: 300px;">
                <li class="nav-item">
                    <a class="nav-link" href="" style="color: white; ">A PROPOS</a>
                </li>
        
            </ul>
        </div>
    </div>
</nav>

<div class="container text-center" style="margin-top: 95px;">
  
<div class="container" style="margin-top: 20px;">
    <div class="row justify-content-center" style="margin-right: 30px;">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"></div>

                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <h1 style="font-size: 20px;"> INSCRIPTION BOTIKA</h1>
                <form method="GET" action="/register/registerPost">

                       @csrf

                       <div style="margin-bottom: 25px; margin-left: 100px; margin-top: 30px;" class="input-group">             
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input id="name" type="text" class="form-control" name="name" value="" placeholder="Entrez votre nom" required style="width: 300px; ">                                        
                                    
                        </div>

                        <div style="margin-bottom: 25px; margin-left: 100px;" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input id="password" type="password" class="form-control" name="password" placeholder="Nouveau mots de passe" required style="width: 300px; ">
                        </div>
                        <div style="margin-bottom: 25px; margin-left: 100px; margin-top: 30px;" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" placeholder="Confirmer le mot de passe" required style="width: 300px;">
                        </div>
                        

                        @if ($errors->has('password'))
                            <div class="alert alert-danger">{{ $errors->first('password') }}</div>
                        @endif
                                    <!-- Ajoutez une case à cocher pour l'acceptation des conditions -->
                                    <div class="form-check form-check-inline custom-checkbox" style="margin-left: 110px;">
                                        <input class="form-check-input" type="checkbox" name="accept_terms" id="accept_terms" required>
                                        <label class="form-check-label" for="accept_terms">
                                            J'accepte les <a href="/login/terme">conditions d'utilisation</a> et la <a href="/login/privacy">politique de confidentialité</a>.
                                        </label>
                                    </div>
                                            

                        
                        <div class="mb-3">
                            <div class="col-sm-12 controls">
                                
                                <button type="submit" class="btn btn-warning" >S'INSCIRE</button>
                            </div>
                        </div>
                        <div class="row" >
                            <p style="margin-top: 20px;">Vous avez déja un compte ? <a href="/login/login">SE CONNECTER</a></p>
                        </div>
                   </form>
                </div>
            </div>
        </div>
    </div>          
</div>
   </div>
 
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>