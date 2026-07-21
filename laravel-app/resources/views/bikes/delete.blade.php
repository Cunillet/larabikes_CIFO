@extends('template.master')
@section('title', "Delete Bike {$bike->brand} {$bike->model}")

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
        <h1 class="display-4 fw-bold mb-3">
            <span class="fw-bold text-red">DELETE: </span>{{ $bike->brand }} - {{ $bike->model }}
        </h1>
        <form
            action="{{ route('bikes.destroy', $bike->id)}}"
            method="POST"
            enctype="multipart/form-data"
            class="container grid-stripped h4">
            @csrf
            @method('DELETE')
            <div class="row p-2">
                <div class="col fw-bold">Brand</div>
                <div class="col">{{ $bike->brand }}</div>
            </div>
            <div class="row p-2">
                <div class="col fw-bold">Model</div>
                <div class="col">{{ $bike->model }}</div>
            </div>
            <div class="row p-2">
                <div class="col fw-bold">Kms</div>
                <div class="col">{{ $bike->kms }}</div>
            </div>
            <div class="row p-2">
                <div class="col fw-bold">Price</div>
                <div class="col">{{ $bike->price }}</div>
            </div>
            <div class="row p-2">
                <div class="col fw-bold">Registered</div>
                <div class="col">{{ $bike->registered ? 'Yes' : 'No' }}</div>
            </div>
            <div class="col p-4">
                <button type="submit" class="col-12 mt-4 btn btn-danger btn-lg">
                    <i class="bi bi-trash3-fill"></i>
                </button>
            </div>
        </form>
    </section>
    <a class="btn btn-secondary btn-lg m-4" href="{{ route('bikes.index') }}">Back</a>
</main>
@endsection
