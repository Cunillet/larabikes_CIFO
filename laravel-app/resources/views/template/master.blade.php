<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <title>{{ config('app.name')}} - @yield('title')</title>
    <style>
        .grid-stripped .row:nth-child(even) {
            background-color: lightgray;
        }
        main {
            margin-top: 3rem;
            margin-bottom: 10rem;
        }
        /* Estilo para el navbar en modo oscuro */
        .navbar-dark .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.8);
        }
        .navbar-dark .navbar-nav .nav-link:hover {
            color: #fff;
        }
        .navbar-dark .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.5);
        }
        .navbar-dark .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 0.8)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }
    </style>
</head>
<body class="bg-dark text-light">
    {{-- @includeWhen(Session::has('success'), 'layouts.success')
    @includeWhen($errors->any, 'layouts.error') --}}
    @env(['local', 'dev'])
        <x-envWarning mode="{{ env('APP_ENV') }}"/>
    @endenv
    @if (auth()->user()?->hasRole('blocked'))
        <x-alert type="danger" msg="Warning: ">
            User blocked, your actions are restricted.
        </x-alert>
    @endif
    @if (Session::has('success') || session('status') || !empty($message))
        <x-alert type="success" msg="Success: ">
            {{ Session::get('success') }}
            {{ session('status') }}
        </x-alert>
    @endif
    @if ($errors->any())
        <x-alert type="danger" msg="Errors: ">
            <ul class="mt-2 mb-0 text-start">
                @foreach ($errors->all() as $error)
                <li>
                    {{ $error }}
                </li>
                @endforeach
            </ul>
        </x-alert>
    @endif

    <x-navigation></x-navigation>

    @section('breadcrumbs')
    <x-breadcrumbs>
        @yield('breadcrumbs-items')
    </x-breadcrumbs>
    @show
    
    @yield('content')
    
    @section('footer')
        <x-footer/>
    @show
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>