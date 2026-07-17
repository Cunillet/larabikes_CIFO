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
            <span>Bikes List</span>
            @can('create', App\Models\Bike::class)
            <a href="{{ route('bikes.create') }}" class="btn btn-success">+</a>
            @endCan
        </h1>
        
        @if($bikes->count() > 0)
            <div class="row g-4">
            @foreach($bikes as $bike)
                <x-biketile
                    :bike="$bike"
                    />
            @endforeach
            </div>
        @else
        <div class="row text-center">No Bikes found</div>
        @endif
        <div class="row justify-content-between mt-3">
            <span>Total amount of bikes: {{ $totalBikes }}</span>
            <div>{{ $bikes->links() }}</div>
        </div>
    </section>
</main>
@endsection
