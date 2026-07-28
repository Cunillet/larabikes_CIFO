@extends('template.master')
@section('title', "Circuit {$circuit->name}")

@section('breadcrumbs-items')
<li class="breadcrumb-item">
    <a href="{{ route('admin.circuits.index') }}">
        Circuits List
    </a>
</li>
<li class="breadcrumb-item">
    {{ $circuit->name }}
</li>
@endsection
@section('content')
<main class="container content-with-fixed-footer">
    <section class="p-4 rounded shadow-sm bg-light text-muted">
        <div class="row g-4 align-items-center">
            <h1 class="display-4 fw-bold mb-3">
                {{ $circuit->name }}
            </h1>
            <div class="col-12 col-lg-7">
                <h2 class="mb-3">
                    Circuit Details
                </h2>
                <div class="mb-4">
                    <span class="badge bg-secondary me-2">
                        #{{ $circuit->id }}
                    </span>
                </div>
                <div class="list-group list-group-flush">
                    <div class="list-group-item d-flex justify-content-between px-0">
                        <strong>Name</strong>
                        <span>{{ $circuit->name }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between px-0">
                        <strong>Country</strong>
                        <span>{{ $circuit->country?->name ?? $circuit->country_id }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between px-0">
                        <strong>Location</strong>
                        <span>{{ $circuit->location ?? '-' }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between px-0">
                        <strong>Length</strong>
                        <span>{{ number_format($circuit->length, 3) }} km</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between px-0">
                        <strong>Turns</strong>
                        <span>{{ $circuit->turns ?? '-' }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between px-0">
                        <strong>Capacity</strong>
                        <span>{{ $circuit->capacity ? number_format($circuit->capacity) : '-' }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between px-0">
                        <strong>Description</strong>
                        <span>{{ $circuit->description ?? '-' }}</span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-5">
                <div class="ratio ratio-4x3 rounded overflow-hidden bg-light border">
                    <img
                        @if (!empty($circuit->image))
                        src="{{ asset('storage/'.$circuit->image) }}"
                        @else
                        src="{{ asset('storage/image/img-not-found.jpg') }}"
                        @endif
                        alt="Circuit {{ $circuit->name }}"
                        class="w-100 h-100 object-fit-cover">
                </div>
            </div>
        </div>
    </section>
    @can('update', $circuit)
    <section class="p-4 my-3 bg-light rounded btn-group text-muted">
        <div>
            More Operations:
        </div>
        @can('delete', $circuit)
        <a href="{{ route('admin.circuits.delete', $circuit->id) }}" class="text-decoration-none mx-3 text-danger">
            <i class="bi bi-trash3-fill"></i>
        </a>
        @endcan

        @can('update', $circuit)
        <a href="{{ route('admin.circuits.edit', $circuit->id) }}" class="text-decoration-none mx-3">
            <i class="bi bi-pen-fill"></i>
        </a>
        @endcan
    </section>
    @endcan
    <a class="btn btn-secondary btn-lg m-4" href="{{ route('admin.circuits.index') }}">Back</a>
</main>
@endsection
