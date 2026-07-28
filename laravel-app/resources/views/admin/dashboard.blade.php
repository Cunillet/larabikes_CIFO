@extends('template.master')
@section('title', 'Admin Dashboard')

@section('breadcrumbs-items')
<li class="breadcrumb-item">
    Admin Dashboard
</li>
@endsection

@section('content')
<main class="container content-with-fixed-footer">
    <section class="p-4 rounded shadow-sm bg-light text-muted">
        <h1 class="display-4 fw-bold mb-4">
            <span class="fw-bold text-black">Admin Dashboard</span>
        </h1>

        <div class="row g-4 mb-5">
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card border-primary h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-people-fill text-primary" style="font-size: 2.5rem;"></i>
                        <h2 class="display-6 fw-bold mt-2">{{ $totalUsers }}</h2>
                        <p class="card-text text-muted">Total Users</p>
                        <a href="{{ route('admin.users') }}" class="btn btn-outline-primary btn-sm">Manage</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card border-success h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-bicycle text-success" style="font-size: 2.5rem;"></i>
                        <h2 class="display-6 fw-bold mt-2">{{ $totalBikes }}</h2>
                        <p class="card-text text-muted">Total Bikes</p>
                        <a href="{{ route('bikes.index') }}" class="btn btn-outline-success btn-sm">View</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card border-warning h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-map-fill text-warning" style="font-size: 2.5rem;"></i>
                        <h2 class="display-6 fw-bold mt-2">{{ $totalCircuits }}</h2>
                        <p class="card-text text-muted">Total Circuits</p>
                        <a href="{{ route('admin.circuits.index') }}" class="btn btn-outline-warning btn-sm">Manage</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card border-danger h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-trash-fill text-danger" style="font-size: 2.5rem;"></i>
                        <h2 class="display-6 fw-bold mt-2">{{ $deletedBikes }}</h2>
                        <p class="card-text text-muted">Deleted Bikes</p>
                        <a href="{{ route('admin.deleted.bikes') }}" class="btn btn-outline-danger btn-sm">View</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                        <span><i class="bi bi-people me-2"></i>Recent Users</span>
                        <a href="{{ route('admin.users') }}" class="btn btn-sm btn-outline-light">View All</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            @forelse($recentUsers as $user)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $user->display_name ?? $user->name }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $user->email }}</small>
                                </div>
                                <a href="{{ route('admin.user.details', $user->id) }}" class="btn btn-sm btn-outline-secondary">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </div>
                            @empty
                            <div class="list-group-item text-center text-muted">No users found</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <span><i class="bi bi-shield-lock me-2"></i>Quick Links</span>
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            <a href="{{ route('admin.circuits.index') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                                <i class="bi bi-map-fill text-warning me-3"></i>
                                Manage Circuits
                            </a>
                            <a href="{{ route('admin.users') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                                <i class="bi bi-people-fill text-primary me-3"></i>
                                Manage Users
                            </a>
                            <a href="{{ route('admin.deleted.bikes') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                                <i class="bi bi-trash-fill text-danger me-3"></i>
                                Deleted Bikes
                            </a>
                            <a href="{{ route('admin.settings') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                                <i class="bi bi-gear-fill text-secondary me-3"></i>
                                Settings
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
