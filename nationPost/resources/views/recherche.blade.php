<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Recherche d’articles</title>

    <!-- Lien Bootstrap CSS, jQuery, etc. si besoin -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            padding-top: 200px; 
        }
        .content-wrapper {
            margin-top: 0; 
        }
        .container-spa {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin: 20px;
        }
        .spa-box {
            border: 1px solid #ccc;
            padding: 15px;
            min-height: 300px;
        }
        .article-link {
            text-decoration: none;
            color: blue;
            cursor: pointer;
        }
        .article-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body class="{{ session('theme', 'default') }} {{ session('font_size', 'default') }} {{ session('font_family', 'default') }}">

    <!-- Insertion de la navbar -->
    @include('partials.navbar')

    <div class="content-wrapper">
        <div class="container-spa">
            <!-- Colonne de gauche : Formulaire -->
            <div class="spa-box">
                <h2>Critères</h2>
                <form id="search-form">
                    <div class="mb-3">
                        <label>Titre :
                            <input type="text" name="title" class="form-control">
                        </label>
                    </div>

                    <div class="mb-3">
                        <label>Catégorie :
                            <select name="category" class="form-select">
                                <option value="">Toutes</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id_cat }}">{{ $cat->name_cat }}</option>
                                @endforeach
                            </select>
                        </label>
                    </div>

                    <!-- Zone pour le filtre de date -->
                    <div class="mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="date_filter_enabled">
                            <label class="form-check-label" for="date_filter_enabled">
                                Utiliser le filtre de date
                            </label>
                        </div>
                        
                        <label for="specific_date_slider" class="form-label">
                            Date (jour) : <span id="sliderValue">01/12/2023</span>
                        </label>
                        <!-- Le slider est désactivé par défaut -->
                        <input type="range" class="form-range" id="specific_date_slider" min="1" max="31" value="1" disabled>
                    </div>

                    <div class="mb-3">
                        <label>Mot-clé :
                            <input type="text" name="keyword" class="form-control">
                        </label>
                    </div>
                    <div class="mb-3">
                        <label>Durée de lecture :
                            <input type="number" name="readtime" class="form-control">
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary mt-2">Chercher</button>
                </form>
            </div>

            <!-- Colonne de droite : Résultats -->
            <div class="spa-box">
                <h2>Résultats</h2>
                <div id="search-results">
                    
                </div>
            </div>
        </div>

        <!-- Zone en bas pour l'article sélectionné -->
        <div class="mx-3 spa-box" id="article-content">
            <h2>Article sélectionné</h2>
            <p>Le contenu de l'article s'affichera ici.</p>
        </div>
    </div>

    <!-- Insertion du footer -->
    @include('partials.footer')

    <!-- Scripts JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    $(document).ready(function() {

        // Fonction utilitaire pour formater le jour en DD/12/2023
        function formatDate(day) {
            // Ajoute un 0 si day < 10
            let dayStr = day < 10 ? '0' + day : day;
            return dayStr + '/12/2023';
        }

        // Mettre à jour l'affichage initial du slider (si tu veux le jour 1 par défaut)
        $('#sliderValue').text(formatDate($('#specific_date_slider').val()));

        // Mettre à jour la valeur affichée du slider au déplacement
        $('#specific_date_slider').on('input', function() {
            let day = $(this).val();
            $('#sliderValue').text(formatDate(day));
        });

        // Activer/désactiver le slider selon la case à cocher
        $('#date_filter_enabled').on('change', function() {
            if($(this).is(':checked')) {
                // Active le slider et ajoute le name pour qu'il soit envoyé
                $('#specific_date_slider').prop('disabled', false).attr('name', 'specific_date');
            } else {
                // Désactive le slider et retire son name pour qu'il ne soit pas envoyé
                $('#specific_date_slider').prop('disabled', true).removeAttr('name');
            }
        });

        // Intercepter la soumission du formulaire
        $('#search-form').on('submit', function(e) {
            e.preventDefault();
            let formData = $(this).serialize();

            $.ajax({
                url: '{{ route("search.ajax") }}',
                method: 'GET',
                data: formData,
                dataType: 'json',
                success: function(articles) {
                    let resultsDiv = $('#search-results');
                    resultsDiv.empty();

                    if (articles.length === 0) {
                        resultsDiv.append('<p>Aucun résultat trouvé.</p>');
                    } else {
                        articles.forEach(function(article) {
                            let link = $('<a href="#" class="article-link"></a>')
                                .text(article.title_art)
                                .data('id', article.id_art)
                                .on('click', function(e) {
                                    e.preventDefault();
                                    loadArticle($(this).data('id'));
                                });
                            resultsDiv.append(link).append('<br>');
                        });
                    }
                },
                error: function(err) {
                    console.error('Erreur AJAX', err);
                }
            });
        });

        // Fonction pour charger l'article sélectionné
        // Fonction pour charger l'article sélectionné
    function loadArticle(articleId) {
        $.ajax({
            url: '/article-info/' + articleId,
            method: 'GET',
            dataType: 'json',
            success: function(article) {
                let contentDiv = $('#article-content');
                contentDiv.empty();

                // on construit le HTML qu'on veut afficher 
                let html = '';

                // Afficher l'image si elle est définie
                if (article.image_art) {
                    html += '<img src="/media/' + article.image_art + '" '
                        + 'alt="Image de l\'article" '
                        + 'class="img-fluid mb-3" style="max-width:500px;">';
                }

                // Titre de l'article
                html += '<h2>' + article.title_art + '</h2>';

                // Date
                if (article.date_art) {
                    html += '<p><strong>Date :</strong> ' + article.date_art + '</p>';
                }

                // Temps de lecture (readtime_art)
                if (article.readtime_art) {
                    html += '<p><strong>Temps de lecture :</strong> '
                        + article.readtime_art + ' min</p>';
                }

                // Contenu de l'article
                html += '<p>' + article.content_art + '</p>';

                // Injecter le HTML dans la div
                contentDiv.append(html);
            },
            error: function(err) {
                console.error('Erreur lors du chargement de l\'article', err);
            }
        });
    }

    });
    </script>
</body>
</html>
