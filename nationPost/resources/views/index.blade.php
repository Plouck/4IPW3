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
          <div class="article-card mb-4" data-article-id="{{ $article->id_art }}" 
            data-article-title="{{ $article->title_art }}" 
            data-article-author="{{ $article->author_art ?? 'Auteur inconnu' }}" 
            data-article-idimage="{{ $article->image_art }}" 
            data-article-date="{{ date('d/m/Y', strtotime($article->date_art)) }}" 
            data-article-read-time="{{ $article->readtime_art }} minutes" 
            data-article-category="{{ $article->category->name_cat }}">
            
            <img src="{{ asset('media/article/'.$article->image_art) }}" class="article-image" alt="{{ $article->title_art }}">
            <div class="card-body">
              <a href="{{ route('article.show', ['id' => $article->id_art]) }}" class="article-title">
                {{ $article->title_art }}
              </a>
              <div class="comments-info">
                <img src="./media/icone/commenter.png" alt="commenter"> 102 comments
              </div>
              <!-- Bouton Like -->
              <form action="{{ route('favorites.add', ['id' => $article->id_art]) }}" method="POST">
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

  <!-- Panneau d'informations au survol -->
  <div id="article-hover-info">
    <h5 id="article-title"></h5>
    <p id="article-excerpt"></p>
    <button class="btn btn-outline-light">Lire l'article</button>
  </div>

  <!--Footer-->
  @include('components.Footer')

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      // Lors du survol d'une carte d'article
      $('.article-card').hover(
        function() {
          // Récupérer les informations de l'article (titre, date, auteur, etc.)
          var articleTitle = $(this).data('article-title');
          var articleAuthor = $(this).data('article-author');
          var articleDate = $(this).data('article-date');
          var articleReadTime = $(this).data('article-read-time');
          var articleCategory = $(this).data('article-category');

          // Créer un extrait avec ces données pour l'utilisateur
          var hoverInfo = "";

          @auth
            // Si l'utilisateur est authentifié, afficher la date de création, durée de lecture et catégorie
            hoverInfo += "<strong>Date de création:</strong> " + articleDate + "<br>" +
                         "<strong>Durée de lecture:</strong> " + articleReadTime + "<br>" +
                         "<strong>Catégorie:</strong> " + articleCategory + "<br>";
            
            // Si l'utilisateur est un admin, ajouter plus d'informations
            @if(Auth::user()->role === 'admin')
              hoverInfo += "<strong>Titre:</strong> " + articleTitle + "<br>" +
                           "<strong>Auteur:</strong> " + articleAuthor + "<br>" +
                           "<strong>ID:</strong> " + $(this).data('article-id') + "<br>" +
                           "<strong>ID de l'image:</strong> " + $(this).data('article-idimage');
            @endif
          @endauth

          // Afficher les informations dans le panneau
          $('#article-title').html(articleTitle);
          $('#article-excerpt').html(hoverInfo);
          
          // Afficher le panneau
          $('#article-hover-info').fadeIn(300);

          // Cacher le panneau après 3 secondes
          setTimeout(function() {
            $('#article-hover-info').fadeOut(300);
          }, 3000); // 3000 millisecondes = 3 secondes
        },
        function() {
          // On ne fait rien ici, car le panneau se cachera après 3 secondes automatiquement
        }
      );
    });
  </script>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>
