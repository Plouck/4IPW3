<!-- Vérification des erreurs -->
@if(session('message'))
    <div class="alert alert-info" role="alert">
        {{ session('message') }}
    </div>
@endif

<!-- Barre de Navigation -->
<nav class="navbar fixed-top bg-light">
    <div class="container-fluid">
        
        <!-- Bloc pour afficher le titre du site -->
        <div class="col-12 text-center py-3" style="background-color: #6a0dad;">
            <h1 class="fw-bold m-0" style="font-size: 2.5rem; font-family: 'Playfair Display', serif; color: white;">
                NationalPost
            </h1>
        </div>

        <div class="row w-100 align-items-center">

            <!-- Menu Offcanvas -->
            <div class="col-4">
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <span class="navbar-toggler-icon"></span> Menu
                </button>
                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav">
                            <li class="nav-item"><a class="nav-link" href="{{ route('index') }}">Accueil</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('article.favorites') }}">Favoris</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('search') }}">Recherche</a></li>  
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Options de présentation -->
            <div class="col-4 text-end">
                <form method="POST" action="{{ route('set.preferences') }}" class="d-inline-block">
                    @csrf
                    <select name="theme" onchange="this.form.submit()" class="form-select">
                        <option value="light" {{ session('theme', 'light') === 'light' ? 'selected' : '' }}>Clair</option>
                        <option value="dark" {{ session('theme', 'light') === 'dark' ? 'selected' : '' }}>Sombre</option>
                        <option value="grey" {{ session('theme', 'light') === 'grey' ? 'selected' : '' }}>Gris</option>
                    </select>
                    <select name="font_size" onchange="this.form.submit()" class="form-select">
                        <option value="small" {{ session('font_size', 'medium') === 'small' ? 'selected' : '' }}>Petit</option>
                        <option value="medium" {{ session('font_size', 'medium') === 'medium' ? 'selected' : '' }}>Moyen</option>
                        <option value="large" {{ session('font_size', 'medium') === 'large' ? 'selected' : '' }}>Grand</option>
                    </select>
                </form>
            </div>

            <!-- Connexion / Déconnexion -->
            <div class="col-4 text-end">
                @if(session()->has('user'))
                    <span class="me-3">Bonjour, {{ session('user.username') }} !</span>
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">Se déconnecter</button>
                    </form>
                @else
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">Se connecter</button>
                @endif
            </div>
        </div>
    </div>
</nav>

<!-- Modal de connexion -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Connexion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="username" class="form-label">Nom d'utilisateur</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Se connecter</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Importation de la police Playfair Display -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
