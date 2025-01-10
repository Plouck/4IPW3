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
    /* Application du thème et taille de police */
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

      font-family: 'Arial', sans-serif;
    }

    .navbar {
      background-color: #343a40;
    }

    .navbar .navbar-brand {
      color: #fff;
    }

    .navbar .navbar-brand:hover {
      color: #ddd;
    }

    .article-header {
      margin-top: 30px;
      font-size: 1.8rem;
      font-weight: bold;
      text-align: center;
    }

    .article-image {
      width: 100%;
      height: 250px;
      object-fit: cover;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .article-card {
      transition: transform 0.3s ease-in-out;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .article-card:hover {
      transform: scale(1.05);
    }

    .card-body {
      padding: 20px;
    }

    .article-title {
      font-size: 1.2rem;
      font-weight: bold;
      color: #007bff;
      text-decoration: none;
    }

    .article-title:hover {
      color: #0056b3;
    }

    .comments-info img {
      width: 20px;
      margin-right: 5px;
    }

    .comments-info {
      font-size: 0.9rem;
      color: #888;
      margin-top: 10px;
    }

    .section-title {
      font-size: 1.5rem;
      font-weight: bold;
      margin-bottom: 20px;
      color: #343a40;
    }

    .video-section iframe {
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .col-md-3, .col-md-5, .col-md-4 {
      margin-bottom: 30px;
    }
  </style>
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
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </section>

  <hr>

  <section class="container">
    <div class="row">
      <div class="col-md-3">
        <h5 class="section-title">CANADA</h5>
        <a href="#" class="card-link">The Liberals are hustling to stop a 'seismic shift' in one of their safest seats</a>
        <br>
        <img src="./media/icone/camera-video.png" alt="video"> with video
        <br>
        <img src="./media/icone/commenter.png" alt="commenter"> 102 comments
        <hr>
        <h5 class="section-title">CANADIAN POLITICS</h5>
        <a href="#" class="card-link">Former Calgary mayor Naheed Nenshi voted new Alberta NDP leader in landslide victory</a>
      </div>

      <div class="col-md-5">
        <a href="./article.html">
          <img src="./media/article/harry-potter-4-theorie.jpg" class="article-image mb-3" alt="Harry Potter">
        </a>
        <h6>PERDU, IL DECOUVRIR LA COUPE DE FEU !</h6>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
        <div class="comments-info">
          <img src="./media/icone/commenter.png" alt="commenter"> 240 comments
        </div>
        <hr>
        <div class="row">
          <div class="col-6">
            <h6>CANADA</h6>
            <a href="#" class="card-link">Article Link</a>
            <div class="comments-info">
              <img src="./media/icone/commenter.png" alt="commenter"> 102 comments
            </div>
          </div>
          <div class="col-6">
            <h6>CANADA</h6>
            <a href="#" class="card-link">Article Link</a>
            <div class="comments-info">
              <img src="./media/icone/commenter.png" alt="commenter"> 102 comments
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4 video-section">
        <h5 class="section-title">LATEST VIDEOS</h5>
        <iframe width="420" height="280" src="https://www.youtube.com/watch?v=KYuQZUwb4OI"></iframe>
        <p>Heroes Among Us: Courage in the Presence of the Enemy</p>
        <p>3 days ago 5:11</p>

        <h5 class="section-title">UP NEXT</h5>
        <iframe width="420" height="280" src="https://www.youtube.com/watch?v=KYuQZUwb4OI"></iframe>
        <p>Heroes Among Us: Courage in the Presence of the Enemy</p>
        <p>5 days ago 8:11</p>
      </div>
    </div>
  </section>

  <!--Footer-->
  @include('components.Footer')

  <!--Script-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>
