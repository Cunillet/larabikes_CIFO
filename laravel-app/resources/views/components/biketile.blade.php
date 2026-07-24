<div class="col-12 col-sm-6 col-md-4 col-lg-3">
    <div class="card h-100 shadow-sm hover-shadow">
        <a href="{{ route('bikes.show', $bike->id) }}">
            <img src="{{ asset('storage/'.$bike->image) }}" 
                    class="card-img-top" 
                    alt="Product 1"
                    style="height: 200px; object-fit: cover;">
        </a>
        <div class="card-body d-flex flex-column">
            <h5 class="card-title text-center">{{ $bike->brand }} {{ $bike->model }}</h5>
            <p class="card-text text-muted text-center small">{{ $bike->price }} €</p>
            
            <div class="mt-auto"></div>
            @if ($editable)
                <div class="d-flex gap-2 mt-3 justify-content-between px-4">
                    @can ('delete', $bike)
                    <a class="text-danger text-decoration-none" href="{{ route('bikes.delete', $bike->id) }}">
                        <i class="bi bi-trash3-fill"></i>
                    </a>
                    @endcan
                    @can ('update', $bike)
                    <a class="text-primary text-decoration-none ms-3" href="{{ route('bikes.edit', $bike->id) }}">
                        <i class="bi bi-pen-fill"></i>
                    </a>
                    @endcan
                </div>
            @elseif ($restorable)
                <div class="d-flex gap-2 mt-3 justify-content-between px-4">
                    <form action="{{ route('bikes.purge') }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <input type="hidden" name="id" value="{{ $bike->id }}">
                        <button
                            onclick="return confirm('Confirm delete bike {{ $bike->brand }} {{ $bike->model }}?')"
                            type="submit"
                            class="text-danger text-decoration-none">
                            <i class="bi bi-trash3-fill"></i>
                        </button>
                    </form>
                    <form action="{{ route('bikes.restore') }}" method="POST">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="id" value="{{ $bike->id }}">
                        <button
                            onclick="return confirm('Confirm restore bike {{ $bike->brand }} {{ $bike->model }}?')"
                            type="submit"
                            class="text-primary text-decoration-none ms-3">
                            <i class="bi bi-pen-fill"></i>
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
