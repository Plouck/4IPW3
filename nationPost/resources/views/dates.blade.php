{{-- resources/views/dates.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Liste des Dates</title>
    {{-- Lien vers Bootstrap si tu veux le style --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  </head>
  <body>
    <h1 class="text-center my-4">Liste des Dates</h1>

    <div class="container">
      <div class="row justify-content-center">
        @foreach($dates as $d)
          <div class="col-md-3 mb-4">
            <div class="card shadow text-center p-3">
            <a href="{{ route('articlesByDate', ['date_art' => $d->date_art]) }}">
              {{ \Carbon\Carbon::parse($d->date_art)->format('d/m/Y') }}
            </a>
            </div>
          </div>
        @endforeach
      </div>
    </div>

    {{-- Scripts Bootstrap, si nécessaire --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
