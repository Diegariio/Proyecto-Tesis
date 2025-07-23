<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ (isset($title) ? "$title - " : '') . config('app.name', 'HGGB') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">
    @include('layouts.topbar')
    <div id="layout-sidenav">
        <div id="layout-sidenav-nav">
            @include('layouts.sidebar')
        </div>
        <div id="layout-sidenav-content">
            <div>
                @hasSection('header')
                    <header class="container-fluid bg-white p-4">
                        @yield('header')
                    </header>
                @endif
                <main class="container-fluid p-4">
                    @yield('content')
                </main>
            </div>
            <footer class="flex-shrink-0 py-4 bg-white">
                <div class="container text-center">
                    <small>&copy; {{ now()->year }} HGGB</small>
                </div>
            </footer>
        </div>
    </div>

<!-- Bootstrap JS (al final del body) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>