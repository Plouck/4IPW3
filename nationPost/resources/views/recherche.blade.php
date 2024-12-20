<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>National Post</title>
  <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png" sizes="32x32">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

</head>

<body>

  <!--NavBar-->
  @include('components.NavBar')


    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="search-form">
            <h1 class="mb-4 text-center">Page de Recherche</h1>
            <form>
              <div class="form-row">
                <!-- Champ de texte -->
                <div class="form-group">
                  <label for="inputText1">Nom de l'article</label>
                  <input
                    type="text"
                    class="form-control"
                    id="inputText1"
                    placeholder="Entrez le Nom de l'article"
                  />
                </div>
              </div>
              <div class="form-row">
                <!-- Liste déroulante -->
                <div class="form-group">
                  <label for="inputSelect1">Catégorie</label>
                  <select id="inputSelect1" class="form-control">
                    <option selected>Choisir...</option>
                    <option>Magie</option>
                    <option>Actualité</option>
                    <option>Sort Interdit</option>
                  </select>
                </div>
                <!-- Liste déroulante 2 -->
                <div class="form-group">
                  <label for="inputSelect2">Date de parution</label>
                  <select id="inputSelect2" class="form-control">
                    <option selected>Choisir...</option>
                    <option>Avant 2020</option>
                    <option>Entre 2020 et 2023</option>
                    <option>Après 2023</option>
                  </select>
                </div>
              </div>
              <div class="form-row">
                <!-- Champ de texte 3 -->
                <div class="form-group">
                  <label for="inputText3">Mot-Clé</label>
                  <input
                    type="text"
                    class="form-control"
                    id="inputText3"
                    placeholder="Mot-clé"
                  />
                </div>
              </div>

              <!-- Bouton de soumission -->
              <div class="text-center">
                <button type="submit" class="btn btn-primary">
                  Rechercher
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>


  <!--Footer-->
  @include('components.Footer')



  <!--Script-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <script>
    // JavaScript pour charger le contenu de navbar.html dans l'élément avec l'ID navbar
    document.addEventListener("DOMContentLoaded", function () {
      fetch('NavBar.html')
        .then(response => response.text())
        .then(data => {
          document.getElementById('NavBar').innerHTML = data;
        })
        .catch(error => console.error('Error loading navbar:', error));

      // JavaScript pour charger le contenu de footer.html dans l'élément avec l'ID footer
      fetch('Footer.html')
        .then(response => response.text())
        .then(data => {
          document.getElementById('Footer').innerHTML = data;
        })
        .catch(error => console.error('Error loading footer:', error));
    });
  </script>
</body>

</html>