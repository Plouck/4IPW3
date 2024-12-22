<!-- Barre de Navigation -->
<header>
 <!-- Navbar principale (fixed-top) -->
 <nav class="navbar fixed-top">
    <div class="container-fluid">
      <div class="row">
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
                          <a class="nav-link active" aria-current="page" href="./index.html">Home</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="./article.html">Article</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="./recherche.html">Search</a>
                      </li>
                  </ul>
              </div>
          </div>
        </div>
        <!-- Champ de recherche -->
        <div class="col-8">
          <form class="d-flex" role="search">
            <button class="btn btn-outline-success" type="submit">
              <img src="./media/icone/icons8-chercher.svg" alt="Search">
            </button>
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          </form>
        </div>
      </div>
      <!-- Logo -->
      <div class="col text-center">
        <img src="./media/icone/National_Post-Logo.wine-cropped.svg" alt="National Post" class="mx-auto" id="Logo">
      </div>
      <!-- Abonnements et Connexion -->
      <div class="col-left gap-2 d-md-block">
        <button class="btn btn-primary" type="button">Subscribe</button>
        <button type="button" class="btn btn-link">Sign In</button>
      </div>
    </div>
  </nav>

<!-- Navbar secondaire (navbar-expand-lg) -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mx-auto"> <!-- mx-auto pour centrer -->
          <li class="nav-item">
            <a class="nav-link" href="./index.html">Index</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./article.html">Article</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./recherche.html">Recherche</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

</header>