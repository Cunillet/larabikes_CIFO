<div class="col-12 col-sm-6 col-md-4 col-lg-3">
    <div class="card h-100 shadow-sm hover-shadow">
        <a href="{{ route('bikes.show', $id) }}">
            <img src="{{ asset('storage/'.$image) }}" 
                    class="card-img-top" 
                    alt="Product 1"
                    style="height: 200px; object-fit: cover;">
        </a>
        <div class="card-body d-flex flex-column">
            <h5 class="card-title text-center">{{ $brand }} {{ $model }}</h5>
            <p class="card-text text-muted text-center small">{{ $price }} €</p>
            
            <div class="mt-auto"></div>
            
            <div class="d-flex gap-2 mt-3 justify-content-between px-4">
                <a class="text-danger text-decoration-none" href="{{ route('bikes.delete', $id) }}">
                    <i class="bi bi-trash3-fill"></i>
                </a>
                <a class="text-primary text-decoration-none ms-3" href="{{ route('bikes.edit', $id) }}">
                    <i class="bi bi-pen-fill"></i>
                </a>
            </div>
        </div>
    </div>
</div>
