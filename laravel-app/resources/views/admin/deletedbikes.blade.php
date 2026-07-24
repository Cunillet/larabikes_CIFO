@extends('template.master')
@section('title', "Deleted Bikes")

@section('breadcrumbs-items')
<li class="breadcrumb-item">
    <a href="{{ route('bikes.index') }}">
        Bikes List
    </a>
</li>
<li class="breadcrumb-item">
    Deleted Bikes
</li>
@endsection
@section('content')
<style>
    .grid-stripped .row:nth-child(even) {
        background-color: lightgray;
    }
</style>
<main class="container content-with-fixed-footer">
    <section class="p-4 rounded shadow-sm bg-light text-muted">
        @section('searchbar')
        <x-searchbar />
        @show
        <h1 class="display-4 fw-bold mb-3 d-flex justify-content-between align-items-center">
            <span>Deleted Bikes List</span><a href="{{ route('bikes.create') }}" class="btn btn-success">+</a>
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
                        <div class="row">
                            <form class="col" action="{{ route('bikes.purge') }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <input type="hidden" name="id" value="{{ $bike->id }}">
                                <button
                                    onclick="return confirm('Confirm delete bike {{ $bike->brand }} {{ $bike->model }}?')"
                                    type="submit"
                                    class="btn btn-danger">
                                    Delete
                                </button>
                            </form>
                            <form class="col" action="{{ route('bikes.restore') }}" method="POST">
                                @method('PUT')
                                @csrf
                                <input type="hidden" name="id" value="{{ $bike->id }}">
                                <button

                                    onclick="return confirm('Confirm restore bike {{ $bike->brand }} {{ $bike->model }}?')"
                                    type="submit"
                                    class="btn btn-success">
                                    Restore
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
            <div class="row text-center">No Bikes found</div>
            @endif
        </div>
    </section>
</main>
@endsection
