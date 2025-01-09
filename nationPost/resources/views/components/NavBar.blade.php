<!-- Barre de Navigation -->
<header>
  <!-- Navbar principale (fixed-top) -->
  <nav class="navbar fixed-top">
    <div class="container-fluid">
      <div class="row">
        <!-- Bouton "Section" + Offcanvas (mobile) -->
        <div class="col-4 gap-2 d-md-block">
          <!-- Bouton pour activer le menu offcanvas -->
          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                  data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>Section
          </button>

          <!-- Menu offcanvas -->
          <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar"
               aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="offcanvasNavbarLabel">National Post</h5>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="{{ route('index') }}">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('article') }}">Article</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('recherche') }}">Search</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('listDates') }}">Liste des Dates</a>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Champ de recherche + Bouton "Menu" -->
        <div class="col-8 d-flex align-items-center justify-content-end">
          <!-- Formulaire de recherche -->
          <form class="d-flex me-3" role="search" action="{{ route('search') }}" method="POST">
            @csrf
            <button class="btn btn-outline-success" type="submit">
              <img src="{{ asset('media/icone/icons8-chercher.svg') }}" alt="Search">
            </button>
            <input class="form-control me-2" type="search" name="query" placeholder="Search" aria-label="Search">
          </form>

          <!-- Nouveau bouton "Menu" avec dropdown pour Recherche + Liste des Dates -->
          <div class="btn-group">
            <button type="button" class="btn btn-secondary dropdown-toggle"
                    data-bs-toggle="dropdown" aria-expanded="false">
              Menu
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="{{ route('recherche') }}">Recherche</a></li>
              <li><a class="dropdown-item" href="{{ route('listDates') }}">Liste des Dates</a></li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Logo cliquable renvoyant vers la page d'accueil -->
      <div class="col text-center">
        <a href="{{ route('index') }}">
          <img
            src="{{ asset('media/icone/National_Post-Logo.wine-cropped.svg') }}"
            alt="National Post"
            class="mx-auto"
            id="Logo"
          >
        </a>
      </div>

      <!-- Abonnements, Article, et Connexion (tous en gris) -->
      <div class="col-left gap-2 d-md-block">
        <a class="btn btn-secondary" href="{{ route('article') }}">Article</a>
        <button class="btn btn-secondary" type="button">Subscribe</button>
        <button type="button" class="btn btn-secondary">Sign In</button>
      </div>
    </div>
  </nav>

  <!-- Navbar secondaire (navbar-expand-lg) -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
              data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" 
              aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mx-auto">
          <!-- Supprimé le lien "Index" afin de ne plus rafraîchir via un bouton dédié -->
          <!-- (Si tu souhaites d'autres liens ici, tu peux les ajouter) -->
        </ul>
      </div>
    </div>
  </nav>
</header>
