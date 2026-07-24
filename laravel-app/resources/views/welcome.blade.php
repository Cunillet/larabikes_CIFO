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
        <h2 class="fw-bold mb-3 d-flex justify-content-between align-items-center">
            @if ($userBikes)
                Last User Bikes
            @else
                Last Platform Bikes
            @endif
        </h2>
            <div class="row g-4">
            @foreach($bikes as $bike)
                <x-biketile
                    :bike="$bike"
                    :editable="false"
                    :restorable="false"
                    />
            @endforeach
            </div>
        @endif
    </section>
    @if($deletedBikes->count() > 0)
        <section class="p-4 rounded shadow-sm bg-light text-muted mb-5">
            <h2 class="fw-bold mb-3 d-flex justify-content-between align-items-center">
                Deleted bikes
            </h2>
            <div class="row g-4">
            @foreach($deletedBikes as $bike)
                <x-biketile
                    :bike="$bike"
                    :editable="false"
                    :restorable="true"
                    />
            @endforeach
            </div>
        </section>
    @endif
</main>
@endsection
