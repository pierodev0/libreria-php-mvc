<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mi Aplicación')</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>
<body>
    <header>
        <h1 class="text-3xl bg-blue-500 text-white">Mi Aplicación</h1>
        {{-- @include('partials.navbar') <!-- Ejemplo de incluir un partial --> --}}
    </header>

    <main>
        @yield('content') 
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Mi Aplicación</p>
    </footer>
    <script src="{{ asset("/build/js/bundle.min.js") }}"></script>
</body>
</html>

