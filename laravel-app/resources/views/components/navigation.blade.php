<!-- Navbar con burger menu -->
<nav class="navbar navbar-expand-lg bg-dark navbar-dark border-bottom border-secondary">
    <div class="container">
        <!-- Logo/Brand -->
        <a class="navbar-brand fw-bold" href="{{ route('welcome') }}">
            {{ config('app.name') }}
        </a>
        
        <!-- Botón hamburguesa (visible en todos los tamaños) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" 
                aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- Menú colapsable -->
        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                
                <!-- Admin Dropdown -->
                @if (Auth::user() && Auth::user()->hasRole('admin'))
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" 
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-shield-lock me-1"></i>Admin
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-speedometer2 me-2"></i>Dashboard
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.circuits.index') }}">
                                <i class="bi bi-map me-2"></i>Circuits
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.deleted.bikes') }}">
                                <i class="bi bi-trash me-2"></i>Deleted Bikes
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.users') }}">
                                <i class="bi bi-people me-2"></i>Manage Users
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.settings') }}">
                                <i class="bi bi-gear me-2"></i>Settings
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                <!-- Parking -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('bikes.index') }}">
                        <i class="bi bi-parking me-1"></i>Parking
                    </a>
                </li>
                
                <!-- New bike -->
                @can('create', App\Models\Bike::class)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('bikes.create') }}">
                        <i class="bi bi-plus-circle me-1"></i>New bike
                    </a>
                </li>
                @endcan
                
                <!-- Contact -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact') }}">
                        <i class="bi bi-envelope me-1"></i>Contact
                    </a>
                </li>
                
                <!-- User / Auth -->
                @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" 
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-fill me-1"></i>
                        {{ auth()->user()->display_name ? auth()->user()->display_name : auth()->user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.show') }}">
                                <i class="bi bi-person me-2"></i>My Profile
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <i class="bi bi-pencil me-2"></i>Edit Profile
                            </a>
                        </li>
                        @if(Auth::user()->hasRole('admin'))
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-shield-lock me-2"></i>Admin Panel
                            </a>
                        </li>
                        @endif
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">
                        <i class="bi bi-person me-1"></i>Login
                    </a>
                </li>
                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">
                        <i class="bi bi-person-add me-1"></i>Register
                    </a>
                </li>
                @endif
                @endguest
            </ul>
        </div>
    </div>
</nav>