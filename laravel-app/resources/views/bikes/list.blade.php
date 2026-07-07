@extends('template.master')
@section('title', 'Bikes List')

@section('breadcrumbs-items')
<li class="breadcrumb-item">
    Bikes List
</li>
@endsection

@section('content')
<style>
    .grid-stripped .row:nth-child(even) {
        background-color: lightgray;
    }
</style>
<main class="container">
    <section class="p-4 rounded shadow-sm bg-light text-muted">
        @section('searchbar')
        <x-searchbar />
        @show
        <h1 class="display-4 fw-bold mb-3 d-flex justify-content-between align-items-center">
            <span>Bikes List</span><a href="{{ route('bikes.create') }}" class="btn btn-success">+</a>
        </h1>
        <div class="container grid-stripped">
            <div class="row h4 fw-bold p-2">
                <div class="col">
                    Brand
                </div>
                <div class="col">
                    Model
                </div>
                <div class="col">
                    Kms
                </div>
                <div class="col">
                    Price
                </div>
                <div class="col">
                    Registered
                </div>
                <div class="col">
                    Actions
                </div>
            </div>
            @if($bikes->count() > 0)
                @foreach($bikes as $bike)
                <div class="row p-2">
                    <div class="col">
                        <a class="d/block text-muted text-decoration-none" href="{{ route('bikes.show', $bike->id) }}">
                            {{ $bike->brand }}
                        </a>
                    </div>
                    <div class="col">
                        <a class="d/block text-muted text-decoration-none" href="{{ route('bikes.show', $bike->id) }}">
                            {{ $bike->model }}
                        </a>
                    </div>
                    <div class="col">
                        <a class="d/block text-muted text-decoration-none" href="{{ route('bikes.show', $bike->id) }}">
                            {{ $bike->kms }}
                        </a>
                    </div>
                    <div class="col">
                        <a class="d/block text-muted text-decoration-none" href="{{ route('bikes.show', $bike->id) }}">
                            {{ $bike->price }}
                        </a>
                    </div>
                    <div class="col">
                        <a class="d/block text-muted text-decoration-none" href="{{ route('bikes.show', $bike->id) }}">
                            {{$bike->registered ? 'Yes' : 'No' }}
                        </a>
                    </div>
                    <div class="col">
                        <a class="text-danger text-decoration-none" href="{{ route('bikes.delete', $bike->id) }}">
                            <i class="bi bi-trash3-fill"></i>
                        </a>
                        <a class="text-primary text-decoration-none ms-3" href="{{ route('bikes.edit', $bike->id) }}">
                            <i class="bi bi-pen-fill"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            @else
            <div class="row text-center">No Bikes found</div>
            @endif
        </div>
        <div class="row justify-content-between mt-3">
            <span>Total amount of bikes: {{ $totalBikes }}</span>
            <div>{{ $bikes->links() }}</div>
        </div>
    </section>
</main>
@endsection
