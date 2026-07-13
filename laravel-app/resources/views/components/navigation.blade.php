<!-- Navbar con burger menu -->
<nav class="navbar navbar-expand-lg bg-dark navbar-dark border-bottom border-secondary">
    <div class="container">
        <!-- Logo/Brand -->
        <a class="navbar-brand fw-bold" href="{{ route('welcome') }}">
            {{ config('app.name') }}
        </a>
        
        <!-- Botón hamburguesa (aparece en móvil) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- Menú colapsable -->
        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('bikes.index') }}">
                        <i class="bi bi-parking me-1"></i>Parking
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('bikes.create') }}">
                        <i class="bi bi-plus-circle me-1"></i>New bike
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact') }}">
                        <i class="bi bi-envelope me-1"></i>Contact
                    </a>
                </li>
                <li class="nav-item">
                    @auth
                    <a class="nav-link" href="{{ route('welcome') }}">
                        <i class="bi bi-person-fill me-1"></i>Welcome {{ auth()->user()->name }}
                    </a>
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" class="nav-link">
                        <button class="nav-link p-0"><i class="bi bi-person me-1"></i>Logout</button>
                    </form>
                    @else
                    <a class="nav-link" href="{{ route('login') }}">
                        <i class="bi bi-person me-1"></i>Login
                    </a>
                </li>
                <li>
                        @if (Route::has('register'))
                        <a class="nav-link" href="{{ route('register') }}">
                            <i class="bi bi-person-add me-1"></i>Register
                        </a>
                        @endif
                    @endguest
                </li>
            </ul>
        </div>
    </div>
</nav>
