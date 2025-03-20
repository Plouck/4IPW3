<!-- Footer -->
<footer class="mt-5">
    <div class="container py-3">
        <div class="row">
            <!-- Column 1 -->
            <div class="col-md-4">
                <h5>Liens rapides</h5>
                <ul class="list-unstyled">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('favorites.show') }}">Favorites <span id="favoritesCount"></span></a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('search') }}">Search</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('apropos') }}">À propos</a></li>
                    <!-- Lien vers le Dashboard uniquement pour les admins -->
                    @auth
                        @if (Auth::user()->role === 'admin')
                            <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
                        @endif
                    @endauth
                </ul>
            </div>
            <!-- Column 2 -->
            <div class="col-md-4">
                <h5>Adresse</h5>
                <address>
                    Rue Joseph Buedts 14<br>1040 Etterbeek<br>Belgique
                </address>
            </div>
            <!-- Column 3 -->
            <div class="col-md-4">
                <h5>Suivez-nous</h5>
                <a href="#" class="text-white me-3" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                <a href="#" class="text-white me-3" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-white me-3" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-white" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>

        <!-- Banniere publicitaire -->
        <div id="ad-banner" class="mt-4">
            <!-- La bannière sera injectée ici -->
        </div>

        <div class="row mt-3">
            <div class="col-md-12 text-center">
                <p>&copy; 2024 Site</p>
            </div>
        </div>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
    $.ajax({
        url: '/banner', // URL de la route définie pour récupérer la bannière
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            console.log("Données reçues :", data);  // Vérifie dans la console

            // Vérifie si la bannière existe
            if (data.banner_4IPDW) {
                var banner = data.banner_4IPDW;
                var bannerHtml = `
                    <a href="${banner.link}" target="_blank">
                        <img src="${banner.image}" alt="Publicité" class="img-fluid" style="max-width: 100%;">
                        <p style="color: ${banner.color};">${banner.text}</p>
                    </a>
                `;
                $('#ad-banner').html(bannerHtml);
            }
        },
        error: function (xhr, status, error) {
            console.error("Erreur AJAX :", status, error);
        }
    });
});

</script>
