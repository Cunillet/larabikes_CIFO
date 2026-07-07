<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>{{ config('app.name')}}</title>
</head>
<body class="bg-dark text-light">
    <nav class="navbar navbar-expand lg bg-light navbar -light">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('welcome') }}"> {{ config('app.name') }}</a>
        </div>
    </nav>
    <main class="container my-5">
        <section class="text-center py-5">
            <h1 class="display-4 fw-bold mb-3">
                Welcome to Larabikes
            </h1>
            <p class="lead mb-4">
                CRUD laravel sample
            </p>
            <a class="btn btn-primary btn-lg" href="{{ route('bikes.index') }}">View Bikes List</a>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>