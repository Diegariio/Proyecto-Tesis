<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ (isset($title) ? "$title - " : '') . config('app.name', 'HGGB') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-light sb-nav-fixed">
    @include('layouts.topbar')

    <div id="layout-sidenav">
        <div id="layout-sidenav-nav">
            @include('layouts.sidebar')
        </div>

        <div id="layout-sidenav-content">
            <div>
                @isset($header)
                    <header class="container-fluid bg-white p-4">
                        {{ $header }}
                    </header>
                @endisset

                <main class="container-fluid p-4">
                    @yield('content')
                </main>
            </div>

            <footer class="flex-shrink-0 py-4 bg-white">
                <div class="container text-center">
                    <small>Copyright &copy; {{ now()->year }} HGGB</small>
                </div>
            </footer>
        </div>
    </div>
</body>

</html>