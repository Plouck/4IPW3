<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>À propos du projet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 200px; /* Ajuste la valeur si nécessaire */
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    @include('partials.navbar')

    <div class="container" style="margin-top: 100px;">
        <h1>À propos</h1>
        <p>Bienvenue sur la page “À propos”. Ici, vous pouvez consulter l’historique des modifications apportées au projet.</p>

        <h2>Historique des modifications</h2>
        <ul>
            <li>2023-12-15 : Ajout d’un slider pour la date dans la recherche</li>
            <li>2023-12-16 : Mise en place du mode SPA pour la recherche</li>
            <li>2023-12-17 : Séparation de la navbar et du footer dans des partials</li>
            <!-- Ajoute autant d’entrées que nécessaire -->
        </ul>
    </div>

    <!-- Footer -->
    @include('partials.footer')

    <!-- Scripts Bootstrap (et éventuellement jQuery) -->
    <!-- Si tu ne les as pas déjà dans un layout global, il faut les inclure ici -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
