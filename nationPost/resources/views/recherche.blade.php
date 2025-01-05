<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>National Post - Recherche</title>
  <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png" sizes="32x32">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>
  <!-- NavBar -->
  @include('components.NavBar')

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="search-form">
          <h1 class="mb-4 text-center">Page de Recherche</h1>
          <form action="{{ route('search') }}" method="GET">
            <!-- Champ de texte pour le titre -->
            <div class="form-group mb-3">
              <label for="inputText1">Nom de l'article</label>
              <input type="text" class="form-control" name="title" id="inputText1" placeholder="Entrez le nom de l'article">
            </div>

            <!-- Liste déroulante des catégories -->
            <div class="form-group mb-3">
              <label for="inputSelect1">Catégorie</label>
              <select id="inputSelect1" name="category" class="form-control">
                <option value="" selected>Toutes les catégories</option>
                @foreach($categories as $category)
                  <option value="{{ $category->id_cat }}">{{ $category->name_cat }}</option>
                @endforeach
              </select>
            </div>

            <!-- Liste déroulante des plages de dates -->
            <div class="form-group mb-3">
              <label for="inputSelect2">Date de parution</label>
              <select id="inputSelect2" name="date_range" class="form-control">
                <option value="" selected>Toutes les dates</option>
                <option value="before_2020">Avant 2020</option>
                <option value="2020_2023">Entre 2020 et 2023</option>
                <option value="after_2023">Après 2023</option>
              </select>
            </div>

            <!-- Champ de texte pour le mot-clé -->
            <div class="form-group mb-3">
              <label for="inputText3">Mot-clé</label>
              <input type="text" class="form-control" name="keyword" id="inputText3" placeholder="Entrez un mot-clé">
            </div>

            <!-- Bouton de soumission -->
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Rechercher</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Résultats -->
    @if(isset($articles) && $articles->isNotEmpty())
      <h2 class="mt-5">Résultats :</h2>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Titre</th>
            <th>Date</th>
            <th>Catégorie</th>
            <th>Résumé</th>
          </tr>
        </thead>
        <tbody>
          @foreach($articles as $article)
            <tr>
              <td>{{ $article->title_art }}</td>
              <td>{{ $article->date_art }}</td>
              <td>{{ $categories->firstWhere('id_cat', $article->fk_category_art)->name_cat ?? 'Non défini' }}</td>
              <td>{{ $article->hook_art }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <p class="mt-5">Aucun résultat trouvé.</p>
    @endif
  </div>

  <!-- Footer -->
  @include('components.Footer')

  <!-- Script -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>
