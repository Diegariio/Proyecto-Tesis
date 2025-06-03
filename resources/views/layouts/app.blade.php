<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ (isset($title) ? "$title - " : '') . config('app.name', 'HGGB') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-light">

    <div id="layout-sidenav">
        <div id="layout-sidenav-nav">
            @include('layouts.sidebar')
        </div>

        <div id="layout-sidenav-content">
            <div>


                <main class="container-fluid p-4">
                    @yield('content')
                </main>
            </div>

        </div>
    </div>
</body>

</html>
