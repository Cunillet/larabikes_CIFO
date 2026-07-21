@extends('template.master')
@section('title', 'Bikes List')

@section('content')
<main class="container content-with-fixed-footer">
    <section class="text-center py-5">
        <h1 class="display-4 fw-bold mb-3">
            Welcome to Larabikes
        </h1>
        <p class="lead mb-4">
            CRUD laravel sample
        </p>
        <a class="btn btn-primary btn-lg" href="{{ route('bikes.index') }}">View Bikes List</a>
    </section>
    <section class="p-4 rounded shadow-sm bg-light text-muted mb-5">
        @if($bikes->count() > 0)
            <div class="row g-4">
            @foreach($bikes as $bike)
                <x-biketile
                    :bike="$bike"
                    :editable="false"
                    />
            @endforeach
            </div>
        @endif
    </section>
</main>
@endsection
