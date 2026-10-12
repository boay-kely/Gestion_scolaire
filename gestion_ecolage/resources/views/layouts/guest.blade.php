<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Gestion d\'Écolage')</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script defer src="{{ asset('js/main.js') }}"></script>
</head>
<body class="guest-body">
    <main class="guest-main">
        <div class="guest-container">
            @yield('content')
        </div>
    </main>
</body>
</html>
