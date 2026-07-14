@extends('template.master')
@section('title', 'Confirm Password')

@section('breadcrumbs-items')
<li class="breadcrumb-item">
    <a href="{{ route('bikes.index') }}">
        Bikes List
    </a>
</li>
<li class="breadcrumb-item active">
    Confirm Password
</li>
@endsection

@section('content')
<main class="container">
    <section class="p-4 rounded shadow-sm bg-light text-muted">
        <div class="row g-4 justify-content-center">
            <div class="col-12 col-lg-6">
                <h1 class="display-4 fw-bold mb-3">
                    <span class="fw-bold text-black">Confirm Password</span>
                </h1>
                <p class="lead">For your security, please confirm your password to continue.</p>

                <form method="POST" action="{{ route('password.confirm.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-bold" for="password">Password</label>
                        <input 
                            class="form-control rounded @error('password') is-invalid @enderror" 
                            name="password" 
                            id="password" 
                            type="password" 
                            placeholder="••••••••"
                            required
                            autofocus/>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary mt-3">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <a class="btn btn-secondary btn-lg m-4" href="{{ route('profile.show') }}">Back</a>
</main>
@endsection
