@extends('template.master')
@section('title', 'Profile')

@section('breadcrumbs-items')
<li class="breadcrumb-item active">
    Profile
</li>
@endsection

@section('content')
<main class="container">
    <section class="p-4 rounded shadow-sm bg-light text-muted">
        <div class="row g-4 align-items-center">
            <h1 class="display-4 fw-bold mb-3">
                <span class="fw-bold text-black">PROFILE: </span>
            </h1>
            
            <div class="col-12 col-lg-7">
                <div class="card">
                    <div class="card-body">

                        <div class="row mb-3">
                            <div class="col-4 fw-bold">Name:</div>
                            <div class="col-8">{{ $user->name }}</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-4 fw-bold">Email:</div>
                            <div class="col-8">{{ $user->email }}</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-4 fw-bold">Member since:</div>
                            <div class="col-8">{{ $user->created_at->format('d/m/Y H:i') }}</div>
                        </div>

                        <div class="text-center mt-4">
                            <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                                <i class="fas fa-edit me-2"></i>Edit Profile
                            </a>
                            <a href="{{ route('bikes.index') }}" class="btn btn-secondary">
                                <i class="fas fa-motorcycle me-2"></i>My Bikes
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-12 col-lg-5">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <i class="fas fa-user-circle" style="font-size: 8rem; color: #6c757d;"></i>
                        <h5 class="mt-3">{{ $user->name }}</h5>
                        <p class="text-muted">{{ $user->email }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <a class="btn btn-secondary btn-lg m-4" href="{{ route('welcome') }}">Back</a>
</main>
@endsection
