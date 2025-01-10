{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>@yield('title', 'Titre par défaut')</title>

    {{-- Exemple de liens CSS/JS, adaptables selon ton projet --}}
    {{-- Par exemple, si tu utilises Bootstrap : --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> {{-- Ton CSS personnalisé si besoin --}}
  </head>
  <body>
    {{-- Inclusion d’une barre de navigation (si tu as NavBar.blade.php dans resources/views/components/) --}}
    <header>
      @include('components.NavBar')
    </header>

    <main class="py-4">
      {{-- Contenu spécifique de chaque page --}}
      @yield('content')
    </main>

    {{-- Footer éventuel (idem, si tu as Footer.blade.php dans resources/views/components/) --}}
    <footer class="mt-5">
      @include('components.Footer')
    </footer>

    {{-- Scripts éventuels --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
  </body>
</html>
