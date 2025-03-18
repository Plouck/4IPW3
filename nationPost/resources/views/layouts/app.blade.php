<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Mon site Laravel')</title>
    <!-- Liens CSS/JS communs, ex. Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="{{ session('theme', 'default') }} {{ session('font_size', 'default') }} {{ session('font_family', 'default') }}">

    <!-- Insertion de la navbar -->
    @include('partials.navbar')

    <!-- Contenu principal -->
    <div class="content-wrapper" style="margin-top: 100px;">
        @yield('content')
    </div>

    <!-- Insertion du footer -->
    @include('partials.footer')

    <!-- Scripts JS communs -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')
</body>
</html>
