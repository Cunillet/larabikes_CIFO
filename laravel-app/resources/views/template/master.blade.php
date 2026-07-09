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
    @if (Session::has('success') ||!empty($message))
        <x-alert type="success" msg="Success: ">
            {{ Session::get('success') }}
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

    <!-- Navbar con burger menu -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark border-bottom border-secondary">
        <div class="container">
            <!-- Logo/Brand -->
            <a class="navbar-brand fw-bold" href="{{ route('welcome') }}">
                {{ config('app.name') }}
            </a>
            
            <!-- Botón hamburguesa (aparece en móvil) -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Menú colapsable -->
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('bikes.index') }}">
                            <i class="bi bi-parking me-1"></i>Parking
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('bikes.create') }}">
                            <i class="bi bi-plus-circle me-1"></i>New bike
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">
                            <i class="bi bi-envelope me-1"></i>Contact
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

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