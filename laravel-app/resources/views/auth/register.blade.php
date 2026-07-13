@extends('template.master')
@section('title', "Register")

@section('breadcrumbs-items')
<li class="breadcrumb-item">
    <a href="{{ route('bikes.index') }}">
        Bikes List
    </a>
</li>
<li class="breadcrumb-item active">
    Register
</li>
@endsection

@section('content')
<main class="container">
    <section class="p-4 rounded shadow-sm bg-light text-muted">
        <div class="row g-4 align-items-center">
            <h1 class="display-4 fw-bold mb-3">
                <span class="fw-bold text-black">REGISTER: </span>
            </h1>

            <form 
                method="POST" 
                action="{{ route('register') }}"
                class="col-12 col-lg-7">
                @csrf

                <div class="row form-group mb-2">
                    <label class="col-3 col-form-label fw-bold" for="inputName">Name</label>
                    <input 
                        class="col up form-control rounded" 
                        name="name" 
                        id="inputName" 
                        type="text" 
                        value="{{ old('name') }}" 
                        placeholder="John Doe"
                        required 
                        autofocus/>
                </div>

                <div class="row form-group mb-2">
                    <label class="col-3 col-form-label fw-bold" for="inputEmail">Email</label>
                    <input 
                        class="col up form-control rounded" 
                        name="email" 
                        id="inputEmail" 
                        type="email" 
                        value="{{ old('email') }}" 
                        placeholder="your@email.com"
                        required/>
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
                    <button type="submit" class="btn btn-success mt-5 mr-2">Register</button>
                </div>

                <div class="text-center mt-3">
                    <p>
                        Already have an account? 
                        <a href="{{ route('login') }}" class="text-decoration-none">Login here</a>
                    </p>
                </div>
            </form>
        </div>
    </section>
    <a class="btn btn-secondary btn-lg m-4" href="{{ route('bikes.index') }}">Back</a>
</main>
@endsection