@extends('template.master')
@section('title', "Edit Bike {$bike->brand} {$bike->model}")

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
<main class="container">
    <section class="p-4 rounded shadow-sm bg-light text-muted">
        <div class="row g-4 align-items-center">
            <h1 class="display-4 fw-bold mb-3">
                <span class="fw-bold text-black">EDIT: </span>{{ $bike->brand }} - {{ $bike->model }}
            </h1>
            <form
                action="{{ route('bikes.update', $bike->id)}}"
                method="POST"
                enctype="multipart/form-data"
                class="col-12 col-lg-7">
                @csrf
                @method('PUT')
                <div class="row form-group mb-2">
                    <label class="col-2 col-form-label fw-bold" for="inputBrand">Brand</label>
                    <input class="col up form-control rounded" name="brand" id="inputBrand" type="text" value="{{ $bike->brand }}" placeholder="Brand"/>
                </div>
                <div class="row form-group mb-2">
                    <label class="col-2 col-form-label fw-bold" for="inputModel">Model</label>
                    <input class="col up form-control rounded" name="model" id="inputModel" type="text" value="{{ $bike->model }}" placeholder="Model"/>
                </div>
                <div class="row form-group mb-2">
                    <label class="col-2 col-form-label fw-bold" for="inputKms">Kms</label>
                    <input class="col up form-control rounded" name="kms" id="inputKms" type="number" value="{{ $bike->kms }}" min="0" step="1"  placeholder="Kms"/>
                </div>
                <div class="row form-group mb-2">
                    <label class="col-2 col-form-label fw-bold" for="inputPrice">Price</label>
                    <input class="col up form-control rounded" name="price" id="inputPrice" type="number" value="{{ $bike->price }}" min="0" step="0.01" placeholder="Price"/>
                </div>
                <div class="row form-group mb-2">
                    <label class="col-2 col-form-label bw-bold" for="inputImage">Image</label>
                    <input
                        class="col up form-control rounded"
                        name="image"
                        id="fileWithPreview"
                        type="file"
                        accept=".jpg, .jpeg, .png, .gif, .webp"
                        data-extensions="jpg|jpeg|png|gif|webp">
                </div>
                <div class="row form-group mb-2">
                    <label class="col-2 col-form-label fw-bold" for="inputRegistered">Registered</label>
                    <input
                        class="form-check-input mt-2 mx-4"
                        name="registered"
                        id="inputRegistered"
                        type="checkbox"
                        value="1"
                        placeholder="Registered"
                        {{ empty(old('registered') ?? $bike->registered) ? '':'checked' }}/>
                </div>
                <div class="form-group text-center">
                    <button type="reset" class="btn btn-secondary mt-5">Reset</button>
                    <button type="submit" class="btn btn-success mt-5 mr-2">Update</button>
                </div>
            </form>
            <div class="col-12 col-lg-5">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex align-items-center">
                        <img
                            id="previewImg"
                            class="img-fluid rounded"
                            @if (!empty($bike->image))
                            src="{{ asset('storage/'.$bike->image) }}"
                            @else
                            src="{{ asset('storage/image/img-not-found.jpg') }}"
                            @endif
                            alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <a class="btn btn-secondary btn-lg m-4" href="{{ route('bikes.index') }}">Back</a>
</main>
<script src="{{ asset('js/Preview.js') }}"></script>
@endsection
