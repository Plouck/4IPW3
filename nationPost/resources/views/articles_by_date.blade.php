{{-- resources/views/articles_by_date.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Articles par Date</title>
    {{-- Lien vers Bootstrap (version 5.3) pour avoir .card, .row, etc. --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    {{-- Ton CSS si besoin --}}
  </head>

  <body>
    <div class="container my-4">
      <h2 class="text-center mb-5">
        Articles pour la date : 
        {{ \Carbon\Carbon::parse($date_art)->format('d/m/Y') }}
      </h2>

      <div class="row">
        @forelse($articles as $article)
          {{-- On affiche 3 cartes par ligne en MD, ajustable en changeant "col-md-4" --}}
          <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
              <div class="card-body">
                <h5 class="card-title">{{ $article->title_art }}</h5>
                <p class="card-text">
                  {{ $article->hook_art }}
                </p>
                
              </div>
            </div>
          </div>
        @empty
          <p>Aucun article trouvé pour cette date.</p>
        @endforelse
      </div>
    </div>

    {{-- JS Bootstrap si besoin --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
