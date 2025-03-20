<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>À propos du projet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
    <style>
        body {
            padding-top: 200px;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    @include('partials.navbar')

    <div class="container" style="margin-top: 100px;">
        <h1>À propos</h1>
        <p>Bienvenue sur la page “À propos”. Ici, vous pouvez consulter l’historique des modifications apportées au projet.</p>
        <h2> Features : </h2>
        <li>présentation d’une liste d’articles de presse : </li>
        <ul>
        <li> triés par ordre chronologique inverse</li>
        <li>nombre limité à 10 articles </li>
        <li> en fonction de ce que l’utilisateur a spécifié en option </li>
        </ul>
        <li>intégration avec une base de données </li>
        <li>recherche d’articles </li>
        <li>présentation d’un article particulier</li>
        <li>gestion des articles favoris (via SESSION) </li>
        <li>login-logout (via SESSION) </li>
        <li>menu de navigation</li>
        <li>pages statiques “à propos” </li>
        <li>options de présentation </li>
        <li>options de recherche</li>
        <li>API </li>
        <li>Ajout d'une bannière publicitaire.</li>
        <li>Gestion asynchrone des favoris : </li>
        <ul>
            <li> L’utilisateur peut ajouter un article à ses favoris. </li>
            <li> L’utilisateur peut retirer un article de ses favoris. </li>
            <li> L’utilisateur peut effacer tous ses favoris. </li>
            <li> La page affiche dynamiquement la liste des favoris. </li>
            <li> La page affiche dynamiquement le nombre d’articles favoris. </li>
        </ul>
        <li>Outil de recherche d’articles en SPA</li>
        <li>Affichage des détails d’un article SPA</li>
        <ul>
            <li>  user : date de création, durée de lecture, catégorie </li>
            <li> admin : en plus, le titre, l’auteur, l’id, l’id de l’image </li>

        </ul>

        <h2>Historique des modifications :  </h2>
        <ul>
            
            <h5> 18 Mars 2025 : </h5>
            <li>Merge branch 'Mohammed2' into Hakan</li>
            <li>Add of limit in the result of a search via the search tool in search controller, limit at 10 articles by ascendant order</li>
            <ul> --------------------------</ul>
            <h5> 14 Mars 2025 : </h5>
            <li>new features search + index page </li>
            <li>add new tool search + correction index page</li>
            <ul> --------------------------</ul>
            <h5> 12 Mars 2025 : </h5>
            <li>Séparation de la navbar et du footer dans des partials</li>
            <li>Mise en place du mode SPA pour la recherche</li>
            <li>Ajout d’un slider pour la date dans la recherche</li>
            <ul> --------------------------</ul>
            <h5> 10 Mars 2025 : </h5>
            <li>update favoris + mouse over</li>
            <li>updade Like</li>
            <li>new update</li>
            <li>update favoris</li>
            <ul> --------------------------</ul>
            <h5> 16 Février 2025 : </h5>
            <li> merge</li>
            <li> Merge branch 'Mohammed2' into Hakan </li>
            <ul> --------------------------</ul>
            <h5> 10 Février 2025 : </h5>
            <li>add search blade</li>
            <ul> --------------------------</ul>
            <h5> 07 Février 2025 : </h5>
            <li>Ajout et modif</li>
            <ul> --------------------------</ul>
            <h5> 03 Février 2025 : </h5>
            <li>Add readtime and keyword in search tool + link btwn pictures and articles in de db</li>
            <li>correction bug</li>
            
            <li>Merge branch 'Mohammed' into Hakan </li>
            
            <li> Add new feature list dates + articles </li>
            <li> maj login + menu (Plouck)</li>
            <ul> --------------------------</ul>
            <h5> 05 Janvier 2025 : </h5>
            <li> add dates list linked with db</li>
            <li>Add list category in search page + Searchcontroller + route + navbar + create article and category models</li>
            <ul> --------------------------</ul>
            <h5> 27 Décembre 2024 : </h5>
            <li> Push new branch</li>
            <li> add .env</li>
            <li> Delete env.example</li>
            <li> migration </li>
            <li>laravel</li>
        </ul>
    </div>

    <!-- Footer -->
    @include('partials.footer')

    <!-- Scripts Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
