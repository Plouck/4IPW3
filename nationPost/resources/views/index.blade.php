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
  <!--NavBar-->
  @include('components.NavBar')

  <section class="container">
    <div class="row">
      @foreach($articles as $article)
        <div class="col-md-3">
          <div class="article-card mb-4">
            <img src="{{ asset('media/article/'.$article->image_art) }}" class="article-image" alt="{{ $article->title_art }}">
            <div class="card-body">
              <a href="{{ route('article.show', ['id' => $article->id_art]) }}" class="article-title">
                {{ $article->title_art }}
              </a>
              <div class="comments-info">
                <img src="./media/icone/commenter.png" alt="commenter"> 102 comments
              </div>
              <!-- Bouton Like -->
              <form action="{{ route('article.addFavorite', ['id' => $article->id_art]) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-primary mt-3">
                  <i class="fa fa-heart"></i> Like
                </button>
              </form>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </section>

  <!--Footer-->
  @include('components.Footer')

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>
