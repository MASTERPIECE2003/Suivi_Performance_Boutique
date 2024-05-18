<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CRUD LARAVEL</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
      </head>
  <body>
    <div class="container text-center">
      <div class="row">
        <div class="col s12">
          <h1>CRUD in LARAVEL</h1>
          <hr>
          @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
          @endif
          @include('partial.search')

          <a href="/etudiant/ajouter" class="btn btn-info">AJouter</a>
          <table class="table">
            <thead>
              <tr>
                <th>id</th>
                <th>nom</th>
                <th>prenom</th>
                <th>classe</th>
                <th>action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($etudiants as $etudiant)
                <tr>
                  <td>{{ $etudiant->id }}</td>
                  <td>{{ $etudiant->nom }}</td>
                  <td>{{ $etudiant->prenom }}</td>
                  <td>{{ $etudiant->classe }}</td>
                  <td>
                    <a href="/etudiant/modifier/{{$etudiant->id}}" class="btn btn-primary">MODIFIER</a>
                    <a href="/etudiant/suppr/{{$etudiant->id}}" class="btn btn-danger">SUPPRIMER</a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          
          <h6> 
            @if ($etudiants->total() == 0)
              Aucun résultat trouvé pour la recherche "{{ $query }}"
            @endif
        </h6>
        
        
          
        </div>
      </div>
    </div>

    <!-- ... (votre code de script JavaScript) ... -->
  </body>
</html>
