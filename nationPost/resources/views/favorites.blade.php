<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Favoris</title>
</head>

<body>

  <!--NavBar-->
  @include('components.NavBar')

  <section class="container">
    <h2 class="text-center my-4">Articles Favoris</h2>
    <div class="row">
      @foreach($favoriteArticles as $article)
        <div class="col-md-3">
          <div class="article-card mb-4">
            <img src="{{ asset('media/article/'.$article->image_art) }}" class="article-image" alt="{{ $article->title_art }}">
            <div class="card-body">
              <a href="{{ route('article.show', ['id' => $article->id_art]) }}" class="article-title">
                {{ $article->title_art }}
              </a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </section>

  <!--Footer-->
  @include('components.Footer')

</body>

</html>
