@extends('template.master')
@section('title', "Bike {$bike->brand} {$bike->model}")

@section('breadcrumbs-items')
<li class="breadcrumb-item">
    <a href="{{ route('bikes.index') }}">
        Bikes List
    </a>
</li>
<li class="breadcrumb-item">
    {{$bike->brand}} {{$bike->model}}
</li>
@endsection
@section('content')
<main class="container content-with-fixed-footer">
    <section class="p-4 rounded shadow-sm bg-light text-muted">
        <div class="row g-4 align-items-center">
            <h1 class="display-4 fw-bold mb-3">
                {{ $bike->brand }} - {{ $bike->model }}
            </h1>
            <div class="col-12 col-lg-7">
                <h2 class="mb-3">
                    Bike Details {{ $bike->brand }} {{ $bike->model }}
                </h2>
                <div class="mb-4">
                    <span class="badge bg-secondary me-2">
                        #{{ $bike->id }}
                    </span>
                    <span class="badge {{ $bike->registered ? 'bg-success' : 'bg-danger' }}">
                        {{ $bike->registered ? 'Registered' : 'Not Registered' }}
                    </span>
                </div>
                <div class="list-group list-group-flush">
                    <div class="list-group-item d-flex justify-content-between px-0">
                        <strong>Brand</strong>
                        <span>{{ $bike->brand }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between px-0">
                        <strong>Model</strong>
                        <span>{{ $bike->model }}</span>
                    </div>
                    @if ($bike->user)
                    <div class="list-group-item d-flex justify-content-between px-0">
                        <strong>Owner</strong>
                        <span>{{ $bike->user->display_name ?? $bike->user->name }}</span>
                    </div>
                    @endif
                    <div class="list-group-item d-flex justify-content-between px-0">
                        <strong>Horsepower</strong>
                        <span>{{ $bike->horsepower }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between px-0">
                        <strong>Buy Date</strong>
                        <span>{{ $bike->buy_date }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between px-0">
                        <strong>Color</strong>
                        <span>{{ $bike->color }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between px-0">
                        <strong>Price</strong>
                        <span>{{ $bike->price }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between px-0">
                        <strong>Kilometers</strong>
                        <span>{{ $bike->kms }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between px-0">
                        <strong>Bike Plate</strong>
                        <span>{{ $bike->bike_plate }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between px-0">
                        <strong>Description</strong>
                        <span>{{ $bike->description }}</span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-5">
                <div class="ratio ratio-4x3 rounded overflow-hidden bg-light border">
                    <img
                        @if (!empty($bike->image))
                        src="{{ asset('storage/'.$bike->image) }}"
                        @else
                        src="{{ asset('storage/image/img-not-found.jpg') }}"
                        @endif
                        alt=" Bike {{ $bike->brand }} {{ $bike->model }}"
                        class="w-100 h-100 object-fit-cover">
                </div>
            </div>
        </div>
    </section>
    @can('manage', $bike)
    <section class="p-4 my-3 bg-light rounded btn-group text-muted">
        <div>
            More Operations:
        </div>
        @can('delete', $bike)
        <a href="{{ route('bikes.delete', $bike->id) }}" class="text-decoration-none mx-3 text-danger">
            <i class="bi bi-trash3-fill"></i>
        </a>
        @endcan

        @can('update', $bike)
        <a href="{{ route('bikes.edit', $bike->id) }}" class="text-decoration-none mx-3">
            <i class="bi bi-pen-fill"></i>
        </a>
        @endcan
    </section>
    @endcan
    <a class="btn btn-secondary btn-lg m-4" href="{{ route('bikes.index') }}">Back</a>
</main>
@endsection
