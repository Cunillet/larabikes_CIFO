@extends('template.master')
@section('title', "Login")

@section('breadcrumbs-items')
<li class="breadcrumb-item">
    <a href="{{ route('bikes.index') }}">
        Bikes List
    </a>
</li>
<li class="breadcrumb-item active">
    Login
</li>
@endsection

@section('content')
<main class="container">
    <section class="p-4 rounded shadow-sm bg-light text-muted">
        <div class="row g-4 align-items-center">
            <h1 class="display-4 fw-bold mb-3">
                <span class="fw-bold text-black">LOGIN: </span>
            </h1>

            <form 
                method="POST" 
                action="{{ route('login') }}"
                class="col-12 col-lg-7">
                @csrf

                <div class="row form-group mb-2">
                    <label class="col-3 col-form-label fw-bold" for="inputEmail">Email</label>
                    <input 
                        class="col up form-control rounded" 
                        name="email" 
                        id="inputEmail" 
                        type="email" 
                        value="{{ old('email') }}" 
                        placeholder="your@email.com"
                        required 
                        autofocus/>
                </div>

                <div class="row form-group mb-2">
                    <label class="col-3 col-form-label fw-bold" for="inputPassword">Password</label>
                    <input 
                        class="col up form-control rounded" 
                        name="password" 
                        id="inputPassword" 
                        type="password" 
                        placeholder="••••••••"
                        required/>
                </div>

                <div class="row form-group mb-2">
                    <label class="col-3 col-form-label fw-bold" for="inputRemember">Remember</label>
                    <input 
                        class="form-check-input mt-2 mx-4"
                        name="remember"
                        id="inputRemember"
                        type="checkbox"
                        value="1"
                        {{ old('remember') ? 'checked' : '' }}/>
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary mt-5 mr-2">Login</button>
                </div>

                <div class="text-center mt-3">
                    <p>
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="text-decoration-none">Register here</a>
                    </p>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-decoration-none small">
                            Forgot your password?
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </section>
    <a class="btn btn-secondary btn-lg m-4" href="{{ route('bikes.index') }}">Back</a>
</main>
@endsection