<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $article->title_art }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
    
</head>

<body>

    @include('partials.NavBar')

    <div class="container mt-4">
        <h1 class="mb-3 text-center">{{ $article->title_art }}</h1>
        <p class="text-center"><strong>Catégorie :</strong> {{ $category->name_cat ?? 'Non défini' }} | <strong>Date :</strong> {{ $article->date_art }}</p>

        <div class="text-center">
        <img src="{{ asset('media/' . $article->image_art) }}" 
            class="img-fluid mx-auto d-block" 
            alt="Image de {{ $article->title_art }}"
            onerror="this.onerror=null;this.src='{{ asset('media/article/default.jpg') }}';">

        </div>

        <div class="article-content mt-4">
            {!! $article->content_art !!}
        </div>
    </div>

    @include('partials.Footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

</body>
</html>
