@extends('template.master')
@section('title', "Reset Password")

@section('breadcrumbs-items')
<li class="breadcrumb-item">
    <a href="{{ route('bikes.index') }}">
        Bikes List
    </a>
</li>
<li class="breadcrumb-item active">
    Reset Password
</li>
@endsection

@section('content')
<main class="container">
    <section class="p-4 rounded shadow-sm bg-light text-muted">
        <div class="row g-4 align-items-center">
            <h1 class="display-4 fw-bold mb-3">
                <span class="fw-bold text-black">RESET PASSWORD: </span>
            </h1>

            <form 
                method="POST" 
                action="{{ route('password.update') }}"
                class="col-12 col-lg-7">
                @csrf
                @method('POST')

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="row form-group mb-2">
                    <label class="col-3 col-form-label fw-bold" for="inputEmail">Email</label>
                    <input 
                        class="col up form-control rounded" 
                        name="email" 
                        id="inputEmail" 
                        type="email" 
                        value="{{ request()->email ?? old('email') }}" 
                        placeholder="your@email.com"
                        required
                        readonly/>
                </div>

                <div class="row form-group mb-2">
                    <label class="col-3 col-form-label fw-bold" for="inputPassword">New Password</label>
                    <input 
                        class="col up form-control rounded" 
                        name="password" 
                        id="inputPassword" 
                        type="password" 
                        placeholder="••••••••"
                        required/>
                </div>

                <div class="row form-group mb-2">
                    <label class="col-3 col-form-label fw-bold" for="inputPasswordConfirmation">Confirm Password</label>
                    <input 
                        class="col up form-control rounded" 
                        name="password_confirmation" 
                        id="inputPasswordConfirmation" 
                        type="password" 
                        placeholder="••••••••"
                        required/>
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-success mt-5 mr-2">
                        <i class="fas fa-sync me-2"></i>Reset Password
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
