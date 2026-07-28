@extends('template.master')
@section('title', 'Circuits List')

@section('breadcrumbs-items')
<li class="breadcrumb-item">
    Circuits List
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
        <h1 class="display-4 fw-bold mb-3 d-flex justify-content-between align-items-center">
            <span>Circuits List</span>
            @can('create', App\Models\Circuit::class)
            <a href="{{ route('admin.circuits.create') }}" class="btn btn-success">+</a>
            @endCan
        </h1>

        <div class="container grid-stripped">
            <div class="row h4 fw-bold p-2">
                <div class="col">Name</div>
                <div class="col">Country</div>
                <div class="col">Location</div>
                <div class="col">Length (km)</div>
                <div class="col">Actions</div>
            </div>
            @if($circuits->count() > 0)
                @foreach($circuits as $circuit)
                <div class="row p-2">
                    <div class="col">
                        <a class="text-muted text-decoration-none" href="{{ route('admin.circuits.show', $circuit->id) }}">
                            {{ $circuit->name }}
                        </a>
                    </div>
                    <div class="col">{{ $circuit->country?->name ?? $circuit->country_id }}</div>
                    <div class="col">{{ $circuit->location }}</div>
                    <div class="col">{{ number_format($circuit->length, 3) }}</div>
                    <div class="col">
                        <div class="row">
                            <a class="col btn btn-sm" href="{{ route('admin.circuits.edit', $circuit->id) }}">
                                <i class="bi bi-pen-fill"></i>
                            </a>
                            <a class="col btn btn-sm text-danger" href="{{ route('admin.circuits.delete', $circuit->id) }}">
                                <i class="bi bi-trash3-fill"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
            <div class="row text-center">No Circuits found</div>
            @endif
        </div>
        <div class="row justify-content-between mt-3">
            <span>Total circuits: {{ $circuits->total() }}</span>
            <div>{{ $circuits->links() }}</div>
        </div>
    </section>
</main>
@endsection
