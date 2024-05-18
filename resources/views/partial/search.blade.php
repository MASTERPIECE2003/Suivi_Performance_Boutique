<div class="container mt-4">
    <form action="{{route('liste.search')}}" method="GET">
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Rechercher" name="query" aria-label="Rechercher"  aria-describedby="button-addon2" value="{{ request()->input('query') ?? '' }}">
        <div class="input-group-append">
          <button type="submit" class="btn btn-info">rechercher</button>
        </div>
    </div>
    </form> 
  </div>