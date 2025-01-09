{{-- resources/views/layouts/minimal.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>@yield('title', 'Liste des Dates')</title>
    {{-- Lien CSS, si nécessaire --}}
  </head>
  <body>
    {{-- Un layout dépouillé sans header ni footer --}}
    @yield('content')
  </body>
</html>
