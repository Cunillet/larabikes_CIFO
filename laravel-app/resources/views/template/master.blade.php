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
    </style>
</head>
<body class="bg-dark text-light">
    {{-- @includeWhen(Session::has('success'), 'layouts.success')
    @includeWhen($errors->any, 'layouts.error') --}}
    @env(['local', 'dev'])
        <x-envWarning mode="{{ env('APP_ENV') }}"/>
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
    <nav class="navbar navbar-expand lg bg-light navbar -light">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('welcome') }}"> {{ config('app.name') }}</a>
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