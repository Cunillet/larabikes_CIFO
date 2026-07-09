@extends('template.master')
@section('title', 'Bikes List')

@section('content')
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
@endsection
