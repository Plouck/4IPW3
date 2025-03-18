<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>National Post</title>
  <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png" sizes="32x32">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Ajout de jQuery -->
</head>

<body>
  <!--NavBar-->
  @include('components.NavBar')

  <section class="container">
    <div class="d-flex justify-content-between align-items-center my-4">
      <h2 id="favoritesTitle">
        <span id="favoritesLabel">Articles Favoris </span>
        <span id="favoritesCount">0</span>
      </h2>
      <button id="clearFavorites" class="btn btn-danger" style="display: none;">Retirer tous les favoris</button>
    </div>

    <div class="row" id="favoritesList">
      <p class="text-center">Chargement des favoris...</p>
    </div>

    <!-- Pagination -->
    <div id="pagination" class="d-flex justify-content-center my-4" style="display:none;">
      <button id="prevPage" class="btn btn-primary mx-2">Précédent</button>
      <button id="nextPage" class="btn btn-primary mx-2">Suivant</button>
    </div>
  </section>

  <!--Footer-->
  @include('components.Footer')

  <!-- Modale de confirmation -->
  <div class="modal fade" id="confirmClearModal" tabindex="-1" aria-labelledby="confirmClearModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmClearModalLabel">Confirmer la suppression</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Êtes-vous sûr de vouloir supprimer tous les favoris ? Cette action est irréversible.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="button" class="btn btn-danger" id="confirmClearFavorites">Confirmer</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

  <script>
    let currentPage = 1;
    const pageSize = 5;

    // Fonction pour charger les favoris et le nombre total de favoris
    function loadFavorites() {
        $.get("{{ route('favorites.list') }}", { page: currentPage, size: pageSize }, function(data) {
            let list = $("#favoritesList");
            let count = $("#favoritesCount");
            let title = $("#favoritesTitle");
            let pagination = $("#pagination");

            list.empty();
            count.text(data.total);  // Met à jour le nombre total de favoris
            console.log("Nombre total de favoris :", data.total); // Vérifier le nombre de favoris dans la console

            if (data.favorites.length === 0) {
                title.text("Pas d'articles favoris");
                list.html('<p class="text-center">Aucun favori ajouté.</p>');
                $("#clearFavorites").hide();
                pagination.hide();
            } else {
                title.html('<span id="favoritesLabel">Articles Favoris </span><span id="favoritesCount">' + data.total + '</span>');
                $("#clearFavorites").show();
                data.favorites.forEach(article => {
                    let articleCard = `
                        <div class="col-md-12 mb-3">
                            <div class="card shadow-sm bg-dark text-white">
                                <div class="card-body">
                                    <h5 class="card-title">${article.title_art}</h5>
                                    <a href="/articles/${article.id_art}" class="btn btn-primary">Voir l'article</a>
                                </div>
                            </div>
                        </div>`;
                    list.append(articleCard);
                });

                // Affichage des boutons de pagination
                pagination.show();
                $("#prevPage").prop("disabled", currentPage === 1);
                $("#nextPage").prop("disabled", data.favorites.length < pageSize);
            }
        }).fail(function() {
            console.error("Erreur lors du chargement des favoris.");
        });
    }

    // Fonction pour changer la page
    function changePage(increment) {
        currentPage += increment;
        loadFavorites();
    }

    // Fonction pour supprimer tous les favoris
    $("#clearFavorites").click(function() {
        // Afficher la modale
        $('#confirmClearModal').modal('show');
    });

    // Confirmer la suppression des favoris
    $("#confirmClearFavorites").click(function() {
        $.post("{{ route('favorites.clear') }}", {
            _token: "{{ csrf_token() }}"
        })
        .done(function(data) {
            if (data.success) {
                $(".favorite-item").fadeOut(300, function() { $(this).remove(); }); // Disparition en douceur
                $("#favoritesCount").text("0"); // Remettre à zéro le nombre de favoris
                $("#favoritesList").html('<p class="text-center">Aucun favori ajouté.</p>');
                $("#clearFavorites").hide();
                $('#confirmClearModal').modal('hide'); // Fermer la modale
                loadFavorites(); // Recharger la liste des favoris
            }
        })
        .fail(function() {
            console.error("Erreur lors de la suppression des favoris.");
        });
    });

    // Initialisation
    $(document).ready(function() {
        loadFavorites(); // Charger les favoris au démarrage

        // Pagination
        $("#prevPage").click(function() {
            changePage(-1);
        });
        $("#nextPage").click(function() {
            changePage(1);
        });
    });
  </script>

</body>
</html>
