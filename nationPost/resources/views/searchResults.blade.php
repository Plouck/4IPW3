<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>National Post</title>
  <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png" sizes="32x32">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
</head>
<body>

    @include('partials.NavBar')

    <div class="container mt-4">
        <h1 class="mb-4 text-center">Résultats de Recherche</h1>

        @if($articles->isNotEmpty())
        <div class="row">
    @foreach($articles as $article)
                <div class="col-md-6">
                    <div class="card mb-4">
                        <img src="{{ asset('media/' . $article->image_art) }}" 
                            alt="Image de {{ $article->title_art }}" 
                            class="card-img-top"
                            onerror="this.onerror=null;this.src='{{ asset('media/default.jpg') }}';">
                        <div class="card-body">
                            <h5 class="card-title">{{ $article->title_art }}</h5>
                            <p class="card-text"><strong>Catégorie :</strong> 
                                {{ $article->category->name_cat ?? 'Non défini' }} <!-- relation chargée -->
                            </p>
                            <p class="card-text"><strong>Date :</strong> {{ $article->date_art }}</p>
                            <p class="card-text">{{ Str::limit($article->hook_art, 100) }}</p>
                            <a href="{{ route('article.show', ['id' => $article->id_art]) }}" class="btn btn-primary">Lire plus</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @else
            <p class="text-center">Aucun résultat trouvé.</p>
        @endif
    </div>

    @include('partials.Footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

</body>
</html>
