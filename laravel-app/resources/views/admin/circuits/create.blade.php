@extends('template.master')
@section('title', 'Create Circuit')

@section('breadcrumbs-items')
<li class="breadcrumb-item">
    <a href="{{ route('admin.circuits.index') }}">
        Circuits List
    </a>
</li>
<li class="breadcrumb-item">
    New Circuit
</li>
@endsection
@section('content')
<main class="container content-with-fixed-footer">
    <section class="p-4 rounded shadow-sm bg-light text-muted">
        <div class="row g-4 align-items-center">
            <h1 class="display-4 fw-bold mb-3">
                <span class="fw-bold text-black">CREATE NEW CIRCUIT: </span>
            </h1>
            <form
                action="{{ route('admin.circuits.store') }}"
                method="POST"
                enctype="multipart/form-data"
                class="col-12 col-lg-7">
                @csrf
                @method('POST')
                <div class="row form-group mb-2">
                    <label class="col-3 col-form-label fw-bold" for="inputName">Name</label>
                    <input class="col up form-control rounded" name="name" id="inputName" type="text" value="{{ old('name') }}" placeholder="Circuit Name"/>
                </div>
                <div class="row form-group mb-2">
                    <label class="col-3 col-form-label fw-bold" for="inputCountry">Country</label>
                    <select class="col up form-control rounded" name="country_id" id="inputCountry">
                        <option value="">Select a country</option>
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>
                                {{ $country->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="row form-group mb-2">
                    <label class="col-3 col-form-label fw-bold" for="inputLocation">Location</label>
                    <input class="col up form-control rounded" name="location" id="inputLocation" type="text" value="{{ old('location') }}" placeholder="Location"/>
                </div>
                <div class="row form-group mb-2">
                    <label class="col-3 col-form-label fw-bold" for="inputLength">Length (km)</label>
                    <input class="col up form-control rounded" name="length" id="inputLength" type="number" value="{{ old('length') }}" min="0" step="0.001" placeholder="0.000"/>
                </div>
                <div class="row form-group mb-2">
                    <label class="col-3 col-form-label fw-bold" for="inputTurns">Turns</label>
                    <input class="col up form-control rounded" name="turns" id="inputTurns" type="number" value="{{ old('turns') }}" min="0" step="1" placeholder="Number of turns"/>
                </div>
                <div class="row form-group mb-2">
                    <label class="col-3 col-form-label fw-bold" for="inputCapacity">Capacity</label>
                    <input class="col up form-control rounded" name="capacity" id="inputCapacity" type="number" value="{{ old('capacity') }}" min="0" step="1" placeholder="Spectator capacity"/>
                </div>
                <div class="row form-group mb-2">
                    <label class="col-3 col-form-label fw-bold" for="inputImage">Image</label>
                    <input
                        class="col up form-control rounded"
                        name="image"
                        id="fileWithPreview"
                        type="file"
                        accept=".jpg, .jpeg, .png, .gif, .webp"
                        data-extensions="jpg|jpeg|png|gif|webp">
                </div>
                <div class="row form-group mb-2">
                    <label class="col-3 col-form-label fw-bold" for="inputDescription">Description</label>
                    <textarea
                        class="col up form-control rounded"
                        name="description"
                        id="inputDescription"
                        placeholder="Circuit Description">{{ old('description') }}</textarea>
                </div>
                <div class="form-group text-center">
                    <button type="reset" class="btn btn-secondary mt-5">Reset</button>
                    <button type="submit" class="btn btn-success mt-5 mr-2">Save</button>
                </div>
            </form>
            <div class="col-12 col-lg-5">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex align-items-center">
                        <img id="previewImg" class="img-fluid rounded" src="{{ asset('storage/image/img-not-found.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <a class="btn btn-secondary btn-lg m-4" href="{{ route('admin.circuits.index') }}">Back</a>
</main>
<script src="{{ asset('js/Preview.js') }}"></script>
@endsection
