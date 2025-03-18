<!-- Importation de la police Playfair Display -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

<body class="{{ session('theme', 'default') }} {{ session('font_size', 'default') }} {{ session('font_family', 'default') }}">

<nav class="navbar fixed-top bg-light">
    <div class="container-fluid d-flex flex-column">
        
        <!-- Bloc pour afficher le titre du site, bien centré -->
        <div class="w-100 text-center py-3 bg-purple">
            <h1 class="fw-bold m-0 site-title">NationalPost</h1>
        </div>

        <!-- Deuxième ligne avec menu, préférences et connexion -->
        <div class="row w-100 align-items-center py-2">
            
            <!-- Menu Offcanvas -->
            <div class="col-4">
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar">
                    <span class="navbar-toggler-icon"></span> Menu
                </button>
                <div class="offcanvas offcanvas-start" id="offcanvasNavbar">
                    <div class="offcanvas-header">
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav">
                            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('favorites.show') }}">Favorites <span id="favoritesCount"></span></a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('search') }}">Search</a></li>
                            @auth
                                @if (Auth::user()->role === 'admin')
                                    <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
                                @endif
                            @endauth
                            <hr>
                            @foreach ($categories as $category)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('category.show', $category->id_cat) }}">
                                        {{ $category->name_cat }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Options de présentation -->
            <div class="col-4 text-center">
                <form method="POST" action="{{ route('set.preferences') }}" class="d-inline-block">
                    @csrf
                    <!-- Sélecteur de thème -->
                    <select name="theme" onchange="this.form.submit()" class="form-select d-inline-block w-auto">
                        <option value="default" {{ session('theme', 'default') === 'default' ? 'selected' : '' }}>Default</option>
                        <option value="light" {{ session('theme') === 'light' ? 'selected' : '' }}>Light</option>
                        <option value="dark" {{ session('theme') === 'dark' ? 'selected' : '' }}>Dark</option>
                        <option value="grey" {{ session('theme') === 'grey' ? 'selected' : '' }}>Grey</option>
                        <option value="yellow" {{ session('theme') === 'yellow' ? 'selected' : '' }}>Yellow</option>
                        <option value="rose" {{ session('theme') === 'rose' ? 'selected' : '' }}>Rose</option>
                        <option value="blue" {{ session('theme') === 'blue' ? 'selected' : '' }}>Blue</option>
                    </select>

                    <!-- Sélecteur de taille de police -->
                    <select name="font_size" onchange="this.form.submit()" class="form-select d-inline-block w-auto mx-2">
                        <option value="default" {{ session('font_size', 'default') === 'default' ? 'selected' : '' }}>Default</option>
                        <option value="small" {{ session('font_size') === 'small' ? 'selected' : '' }}>Small</option>
                        <option value="medium" {{ session('font_size') === 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="large" {{ session('font_size') === 'large' ? 'selected' : '' }}>Large</option>
                    </select>

                    <!-- Sélecteur de famille de police -->
                    <select name="font_family" onchange="this.form.submit()" class="form-select d-inline-block w-auto">
                        <option value="default" {{ session('font_family', 'default') === 'default' ? 'selected' : '' }}>Default</option>
                        <option value="arial" {{ session('font_family') === 'arial' ? 'selected' : '' }}>Arial</option>
                        <option value="times" {{ session('font_family') === 'times' ? 'selected' : '' }}>Times New Roman</option>
                        <option value="courier" {{ session('font_family') === 'courier' ? 'selected' : '' }}>Courier New</option>
                    </select>
                </form>
            </div>

            <!-- Connexion / Déconnexion -->
            <div class="col-4 text-end">
                @auth
                    <span class="me-3">Bonjour, {{ Auth::user()->name }} !</span>
                    <button class="btn btn-outline-danger" id="logoutButton">Se déconnecter</button>
                @else
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">Se connecter</button>
                    <a href="{{ route('register') }}" class="btn btn-secondary">S'inscrire</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<!-- Modal de Connexion -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Connexion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="username" class="form-label">{{ __('Username') }}</label>
                        <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus autocomplete="username">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
                        <label class="form-check-label" for="remember_me">{{ __('Remember me') }}</label>
                    </div>

                    @if (Route::has('password.request'))
                        <div class="mt-2">
                            <a href="{{ route('password.request') }}" class="text-sm text-primary">{{ __('Forgot your password?') }}</a>
                        </div>
                    @endif

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Connexion</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('logoutButton')?.addEventListener('click', function() {
        fetch("{{ route('logout') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
            },
            body: JSON.stringify({ _method: "POST" })
        })
        .then(response => {
            if (response.ok) {
                window.location.href = "{{ route('home') }}";
            } else {
                alert('Une erreur est survenue lors de la déconnexion.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Une erreur est survenue lors de la déconnexion.');
        });
    });

    function updateFavoritesCount() {
        fetch("{{ route('favorites.count') }}")
            .then(response => response.json())
            .then(data => {
                document.getElementById('favoritesCount').textContent = data.count;
            })
            .catch(error => console.error('Erreur lors de la récupération du nombre de favoris:', error));
    }

    document.addEventListener('DOMContentLoaded', function() {
        updateFavoritesCount();
    });
</script>
