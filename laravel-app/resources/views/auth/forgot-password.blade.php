@extends('template.master')
@section('title', "Forgot Password")

@section('breadcrumbs-items')
<li class="breadcrumb-item">
    <a href="{{ route('bikes.index') }}">
        Bikes List
    </a>
</li>
<li class="breadcrumb-item active">
    Forgot Password
</li>
@endsection

@section('content')
<main class="container">
    <section class="p-4 rounded shadow-sm bg-light text-muted">
        <div class="row g-4 align-items-center">
            <h1 class="display-4 fw-bold mb-3">
                <span class="fw-bold text-black">FORGOT PASSWORD: </span>
            </h1>

            <form 
                method="POST" 
                action="{{ route('password.email') }}"
                class="col-12 col-lg-7">
                @csrf

                <div class="row form-group mb-2">
                    <label class="col-3 col-form-label fw-bold" for="inputEmail">Email</label>
                    <input 
                        class="col up form-control rounded" 
                        name="email" 
                        id="inputEmail" 
                        type="email" 
                        value="{{ $email ?? old('email') }}" 
                        placeholder="your@email.com"
                        required 
                        autofocus/>
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary mt-5 mr-2">
                        <i class="fas fa-envelope me-2"></i>Send Reset Link
                    </button>
                </div>

                <div class="text-center mt-3">
                    <p>
                        Remember your password? 
                        <a href="{{ route('login') }}" class="text-decoration-none">Login here</a>
                    </p>
                </div>
            </form>
        </div>
    </section>
    <a class="btn btn-secondary btn-lg m-4" href="{{ route('bikes.index') }}">Back</a>
</main>
@endsection
