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
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

  <style>
    /* Application du thème */
    body {
      @if(session('theme') == 'dark')
        background-color: #333;
        color: #fff;
      @elseif(session('theme') == 'grey')
        background-color: #888;
        color: #000;
      @else
        background-color: #fff;
        color: #000;
      @endif

      /* Application de la taille de la police */
      @if(session('font_size') == 'small')
        font-size: 12px;
      @elseif(session('font_size') == 'medium')
        font-size: 16px;
      @else
        font-size: 20px;
      @endif
    }

    .article-header {
      margin-top: 20px;
    }

    .article-image {
      width: 100%;
      height: auto;
      margin-bottom: 20px;
    }

    .article-body {
      margin-top: 20px;
    }

    .article-body h2, .article-body h3 {
      margin-top: 20px;
    }

  </style>
</head>

<body>

  <!--NavBar-->
  @include('components.NavBar')

  </div>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="article-header text-center">
          <h1>Harry Potter : Un Univers Magique</h1>
          <p class="lead">Par J.K. Rowling</p>
        </div>
        <div class="article-content">
          <img src="./media/article/94609.jpg" alt="Harry Potter" class="article-image">
          <div class="article-body">
            <h2>Introduction</h2>
            <p>
              Harry Potter est une série de sept romans fantastiques écrits par l'autrice britannique J.K. Rowling.
              L'histoire se concentre sur un jeune sorcier, Harry Potter, et ses aventures à l'école de sorcellerie Poudlard.
            </p>

            <h2>Les Personnages Principaux</h2>
            <p>
              Les personnages principaux de la série incluent Harry Potter, Hermione Granger, et Ron Weasley.
              Ensemble, ils affrontent diverses épreuves et découvrent les secrets de l'univers magique.
            </p>

            <h3>Harry Potter</h3>
            <p>
              Harry est le personnage principal, un jeune sorcier célèbre pour avoir survécu à une attaque du sorcier maléfique Voldemort
              alors qu'il n'était qu'un bébé.
            </p>

            <h3>Hermione Granger</h3>
            <p>
              Hermione est l'une des meilleures amies de Harry, connue pour son intelligence exceptionnelle et son dévouement aux études.
            </p>

            <h3>Ron Weasley</h3>
            <p>
              Ron est le meilleur ami de Harry et provient d'une famille de sorciers. Il est loyal et courageux, bien que souvent maladroit.
            </p>

            <h2>Le Monde Magique</h2>
            <p>
              Le monde de Harry Potter est rempli de magie, de créatures fantastiques, et d'écoles de sorcellerie.
              Poudlard, l'école où Harry et ses amis étudient, est un lieu central de l'histoire, riche en histoire et en mystère.
            </p>

            <h2>Impact Culturel</h2>
            <p>
              La série Harry Potter a eu un impact immense sur la culture populaire, inspirant des millions de lecteurs et donnant lieu à des films,
              des pièces de théâtre, des parcs à thème et bien plus encore.
            </p>

            <h2>Conclusion</h2>
            <p>
              Harry Potter est plus qu'une simple série de livres; c'est un phénomène mondial qui continue de captiver les imaginations de lecteurs de tous âges.
              L'univers magique créé par J.K. Rowling reste une source d'inspiration et d'émerveillement.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--Footer-->
  @include('components.Footer')

  <!--Script-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>
