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
<main class="container content-with-fixed-footer">
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
                    <label class="col-3 col-form-label fw-bold" for="inputBrand">Brand</label>
                    <input class="col up form-control rounded" name="brand" id="inputBrand" type="text" value="{{ $bike->brand }}" placeholder="Brand"/>
                </div>
                <div class="row form-group mb-2">
                    <label class="col-3 col-form-label fw-bold" for="inputModel">Model</label>
                    <input class="col up form-control rounded" name="model" id="inputModel" type="text" value="{{ $bike->model }}" placeholder="Model"/>
                </div>
                <div class="row form-group mb-2">
                    <label class="col-3 col-form-label fw-bold" for="inputHorsepower">Horsepower</label>
                    <input class="col up form-control rounded" name="horsepower" id="inputHorsepower" type="number" value="{{ $bike->horsepower }}" placeholder="Horsepower" min="1" step="1"/>
                </div>
                <div class="row form-group mb-2">
                    <label class="col-3 col-form-label fw-bold" for="inputColor">Color</label>
                    <input class="col up form-control rounded" name="color" id="inputColor" type="color" value="{{ $bike->color }}" placeholder="Color"/>
                </div>
                <div class="row form-group mb-2">
                    <label class="col-3 col-form-label fw-bold" for="inputKms">Kms</label>
                    <input class="col up form-control rounded" name="kms" id="inputKms" type="number" value="{{ $bike->kms }}" min="0" step="1"  placeholder="Kms"/>
                </div>
                <div class="row form-group mb-2">
                    <label class="col-3 col-form-label fw-bold" for="inputPrice">Price</label>
                    <input class="col up form-control rounded" name="price" id="inputPrice" type="number" value="{{ $bike->price }}" min="0" step="0.01" placeholder="Price"/>
                </div>
                <div class="row form-group mb-2">
                    <label class="col-3 col-form-label fw-bold" for="inputBuyDate">Buy Date</label>
                    <input class="col up form-control rounded" name="buy_date" id="inputBuyDate" type="date" value="{{ $bike->buy_date }}"/>
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
                    <label class="col-3 col-form-label fw-bold" for="inputRegistered">Registered</label>
                    <input
                        class="form-check-input mt-2 mx-4"
                        name="registered"
                        id="inputRegistered"
                        type="checkbox"
                        value="1"
                        placeholder="Registered"
                        {{ empty(old('registered') ?? $bike->registered) ? '':'checked' }}/>
                </div>
                <div class="row form-group mb-2">
                    <label class="col-3 col-form-label fw-bold" for="inputBikePlate">Bike Plate</label>
                    <input
                        class="col up form-control rounded"
                        name="bike_plate"
                        id="inputBikePlate"
                        type="text"
                        placeholder="Bike Plate"
                        value="{{ $bike->bike_plate }}"/>
                </div>
                <div class="row form-group mb-2">
                    <label class="col-3 col-form-label fw-bold" for="inputDescription">Description</label>
                    <textarea
                        class="col up form-control rounded"
                        name="description"
                        id="inputDescription"
                        placeholder="Bike Description"
                        >{{ $bike->description }}</textarea>
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
                    @if ($bike->image)
                    <div class="card-footer text-center">
                        <form
                            action="{{ route('bikes.destroyImage', $bike) }}"
                            method="POST"
                            onsubmit="return confirm('Confirm delete bike image?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                Delete Image
                            </button>
                        </form>
                    </div>
                    @endif
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
<script src="{{ asset('js/Preview.js') }}"></script>
@endsection
