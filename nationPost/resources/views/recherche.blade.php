<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>National Post - Recherche</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
</head>

<body>
    @include('components.NavBar')

    <div class="container mt-5">
        <h1 class="mb-4 text-center">Page de Recherche</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('search') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Nom de l'article</label>
                <input type="text" class="form-control" name="title" placeholder="Entrez le nom de l'article">
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Catégorie</label>
                <select name="category" class="form-control">
                    <option value="">Toutes les catégories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id_cat }}">{{ $category->name_cat }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Date de parution</label>
                <input type="checkbox" id="disableDate" checked> Désactiver le filtre par date
                <input type="range" id="dateSlider" name="specific_date" class="form-range" min="1" max="31" disabled>
                <p id="selectedDate" class="text-center fw-bold">Date sélectionnée : Aucune</p>
            </div>

            <div class="mb-3">
                <label for="readtime" class="form-label">Durée de lecture (minutes)</label>
                <input type="number" min="1" class="form-control" name="readtime" placeholder="Ex: 1">
            </div>

            <div class="mb-3">
                <label for="keyword" class="form-label">Mot-clé</label>
                <input type="text" class="form-control" name="keyword" placeholder="Entrez un mot-clé">
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Rechercher</button>
            </div>
        </form>
    </div>

    @include('components.Footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script pour le slider -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var slider = document.getElementById("dateSlider");
            var output = document.getElementById("selectedDate");
            var disableDateCheckbox = document.getElementById("disableDate");

            function updateDate() {
                if (slider.disabled) {
                    output.innerHTML = "Date sélectionnée : Aucune";
                    slider.value = ""; // Ne pas envoyer de valeur si le filtre est désactivé
                } else {
                    let day = slider.value.padStart(2, '0');
                    output.innerHTML = "Date sélectionnée : " + day + "/12/2023";
                }
            }

            slider.addEventListener("input", updateDate);

            disableDateCheckbox.addEventListener("change", function() {
                slider.disabled = this.checked;
                updateDate();
            });

            updateDate();
        });
    </script>
</body>
</html>
