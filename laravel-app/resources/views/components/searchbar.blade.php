@section('searchbar')
<form action="{{ route('bikes.search') }}" method="GET" class="mb-4">
    <div class="row g-3 align-items-end">
        <div class="col-md-5">
            <label for="brand" class="form-label">
                Brand
            </label>
            <input type="text" class="form-control" id="brand" name="brand" value="{{ request('brand') }}" placeholder="Brand (Yamaha, Suzuki, Honda...)">
        </div>
        <div class="col-md-5">
            <label for="model" class="form-label">
                Model
            </label>
            <input type="text" class="form-control" id="model" name="model" value="{{ request('model') }}" placeholder="Model (CBR, Afrika Twin...)">
        </div>
        <div class="col-md-2 d-flex gap-2">
            <button type="submit" class="btn btn-primary">Search</button>
            <a href="{{ route('bikes.index') }}" class="btn btn-secondary">Clear Filter</a>
        </div>
    </div>
</form>
@endsection
