@extends('template.master')
@section('title', "Delete Circuit {$circuit->name}")

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
        <h1 class="display-4 fw-bold mb-3">
            <span class="fw-bold text-danger">DELETE: </span>{{ $circuit->name }}
        </h1>
        <form
            action="{{ route('admin.circuits.destroy', $circuit->id) }}"
            method="POST"
            enctype="multipart/form-data"
            class="container grid-stripped h4">
            @csrf
            @method('DELETE')
            <div class="row p-2">
                <div class="col fw-bold">Name</div>
                <div class="col">{{ $circuit->name }}</div>
            </div>
            <div class="row p-2">
                <div class="col fw-bold">Country</div>
                <div class="col">{{ $circuit->country?->name ?? $circuit->country_id }}</div>
            </div>
            <div class="row p-2">
                <div class="col fw-bold">Location</div>
                <div class="col">{{ $circuit->location ?? '-' }}</div>
            </div>
            <div class="row p-2">
                <div class="col fw-bold">Length</div>
                <div class="col">{{ number_format($circuit->length, 3) }} km</div>
            </div>
            <div class="row p-2">
                <div class="col fw-bold">Turns</div>
                <div class="col">{{ $circuit->turns ?? '-' }}</div>
            </div>
            <div class="row p-2">
                <div class="col fw-bold">Capacity</div>
                <div class="col">{{ $circuit->capacity ?? '-' }}</div>
            </div>
            <div class="col p-4">
                <button type="submit" class="col-12 mt-4 btn btn-danger btn-lg">
                    <i class="bi bi-trash3-fill"></i>
                </button>
            </div>
        </form>
    </section>
    <a class="btn btn-secondary btn-lg m-4" href="{{ route('admin.circuits.index') }}">Back</a>
</main>
@endsection
