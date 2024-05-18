<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD LARAVEL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />

<style>
     @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,400;0,600;0,700;0,800;0,900;1,800&family=Roboto:wght@500;700;900&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
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
        </style>
  
  </head>
  <body>
  <nav class="sidebar" style="height: 100vh; overflow-y: hidden;">
      <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c8/Orange_logo.svg/284px-Orange_logo.svg.png" alt="logo" style="width: 50px; height: auto; margin-right: 10px;"> 
      <a href="#" class="logo" style="margin-top: 25px;">BOTIKA</a>
        <div class="menu-content" style="max-height: calc(100vh - 100px); overflow-y: auto;">
            <ul class="menu-items">
                <li class="item">
                    <a class="nav-link" href="/etudiant/liste" style="color: white; margin-top: 10px;"><i class="fas fa-home"></i> &nbsp;&nbsp; LISTAGE</a>
                    <a class="nav-link" href="/etudiant/recap" style="color: white;"><i class="fas fa-list"></i> &nbsp;&nbsp; RECAPITULATION</a>
                    <form action="{{ route('logout') }}" class="d-flex" role="search" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit" style="background-color: #ff5500; margin-top: 650px;">
                            <i class="fas fa-sign-out-alt"></i>  &nbsp;&nbsp; Se déconnecter
                        </button>
                    </form>
                </li>
            </ul>
        </div>

    </nav>
   <div class="container ">
  <div class="row">
    <div class="col s12">
        <h1>Ajouter un vendeur</h1>
 
          <form action="/ajouter/store" method="GET" class="form-group">
          
            <div class="form-group">
                <label for="vendeur" class="form-label">Nom</label>
                <input type="text" class="form-control" id="vendeur" name="vendeur">
              </div>
              <div class="form-group">
                <label for="prestataire" class="form-label">prestataire</label>
                <input type="text" class="form-control" id="prestataire" name="prestataire" >
              </div>
              <div class="form-group">
                <label for="cvse" class="form-label">CVSE</label>
                <input type="text" class="form-control" id="cvse" name="cvse" >
            
              </div>
              <div class="form-group">
                <label for="pdv" class="form-label">POint devente</label>
                <input type="text" class="form-control" id="pdv" name="pdv" >
              </div>
              <input type="text" class="form-control" id="idpro" name="idpro" value="{{$idProduit}}" >
            <button type="submit" class="btn btn-primary">Ajouter</button>
          </form>
        
          <br> 
          <a href="/etudiant/liste" class="btn btn-danger">Liste</a>
    </div>
   <br>

  </div>
 
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>