@extends('template.master')
@section('title', "Create Bike")

@section('breadcrumbs-items')
<li class="breadcrumb-item">
    <a href="{{ route('bikes.index') }}">
        Bikes List
    </a>
</li>
<li class="breadcrumb-item">
    New Bike
</li>
@endsection
@section('content')
<main class="container my-5">
    <section class="p-4 rounded shadow-sm bg-light text-muted">
        <h1 class="display-4 fw-bold mb-3">
            <span class="fw-bold text-black">Error: 404</span>
        </h1>
        <div class="container grid-stripped h4">
            @if($errors->any())
                <ul>
                @foreach($errors->all() as $error)
                    <li>$error</li>
                @endforeach
                </ul>
            @endif
        </div>
    </section>
</main>
@endsection
