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

    {{-- CIRCUIT TIMES --}}
    <section class="p-4 my-3 bg-light rounded text-muted">
        <h2 class="fw-bold mb-3 d-flex justify-content-between align-items-center">
            <span><i class="bi bi-stopwatch me-2"></i>Circuit Times</span>
            @can('update', $bike)
            <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#addCircuitForm" aria-expanded="false">
                <i class="bi bi-plus-circle"></i> Add
            </button>
            @endcan
        </h2>

        @can('update', $bike)
        <div class="collapse mb-3" id="addCircuitForm">
            <div class="card card-body bg-dark text-light border-0">
                <form action="{{ route('bikes.circuits.store', $bike) }}" method="POST" class="row g-2">
                    @csrf
                    <div class="col-12 col-md-4">
                        <select class="form-control form-control-sm" name="circuit_id" required>
                            <option value="">Select circuit...</option>
                            @foreach($allCircuits as $circuit)
                                @unless($bike->circuits->contains($circuit))
                                <option value="{{ $circuit->id }}">{{ $circuit->name }}</option>
                                @endunless
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6 col-md-3">
                        <input class="form-control form-control-sm" name="lap_time" type="text" placeholder="Lap time (HH:MM:SS)" required>
                    </div>
                    <div class="col-6 col-md-3">
                        <input class="form-control form-control-sm" name="record_date" type="date">
                    </div>
                    <div class="col-12 col-md-2">
                        <button type="submit" class="btn btn-success btn-sm w-100">Save</button>
                    </div>
                </form>
            </div>
        </div>
        @endcan

        @if($bike->circuits->count() > 0)
            <div class="container grid-stripped">
                <div class="row h5 fw-bold p-2 d-none d-md-flex">
                    <div class="col-4">Circuit</div>
                    <div class="col-3">Lap Time</div>
                    <div class="col-3">Date</div>
                    @can('update', $bike)
                    <div class="col-2">Actions</div>
                    @endcan
                </div>
                @foreach($bike->circuits as $circuit)
                <div class="row p-2 align-items-center border-bottom">
                    <div class="col-12 col-md-4">
                        <strong>{{ $circuit->name }}</strong>
                        <span class="text-muted small d-md-none">({{ $circuit->country?->name ?? $circuit->country_id }})</span>
                    </div>
                    <div class="col-12 col-md-3">
                        @can('update', $bike)
                        <form action="{{ route('bikes.circuits.update', [$bike, $circuit]) }}" method="POST" class="row g-1">
                            @csrf
                            @method('PUT')
                            <div class="col-6 col-md-8">
                                <input class="form-control form-control-sm" name="lap_time" type="text" value="{{ $circuit->pivot->lap_time }}" required>
                            </div>
                            <div class="col-6 col-md-4">
                                <button type="submit" class="btn btn-sm btn-outline-success w-100"><i class="bi bi-check-lg"></i></button>
                            </div>
                        </form>
                        @else
                        <span>{{ $circuit->pivot->lap_time }}</span>
                        @endcan
                    </div>
                    <div class="col-12 col-md-3">
                        @can('update', $bike)
                        <form action="{{ route('bikes.circuits.update', [$bike, $circuit]) }}" method="POST" class="row g-1">
                            @csrf
                            @method('PUT')
                            <div class="col-6 col-md-8">
                                <input class="form-control form-control-sm" name="record_date" type="date" value="{{ $circuit->pivot->record_date }}">
                            </div>
                            <div class="col-6 col-md-4">
                                <button type="submit" class="btn btn-sm btn-outline-success w-100"><i class="bi bi-check-lg"></i></button>
                            </div>
                        </form>
                        @else
                        <span>{{ $circuit->pivot->record_date }}</span>
                        @endcan
                    </div>
                    @can('update', $bike)
                    <div class="col-12 col-md-2">
                        <form action="{{ route('bikes.circuits.destroy', [$bike, $circuit]) }}" method="POST"
                              onsubmit="return confirm('Remove circuit time for {{ $circuit->name }}?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger w-100"><i class="bi bi-trash3"></i></button>
                        </form>
                    </div>
                    @endcan
                </div>
                @endforeach
            </div>
        @else
            <p class="text-muted mb-0 text-center">No circuit times recorded yet.</p>
        @endif
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
