<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mi Aplicación')</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>
<body class="flex flex-col min-h-screen"">
    <header>
        @include('partials.navbar') 
    </header>

    <main class="flex-1 wrapper">
        @yield('content') 
    </main>

    @include('partials.footer')
    <script src="{{ asset("/build/js/bundle.min.js") }}"></script>
</body>
</html>

