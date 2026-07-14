@extends('template.master')
@section('title', 'Edit Profile')

@section('breadcrumbs-items')
<li class="breadcrumb-item">
    <a href="{{ route('profile.show') }}">
        My Profile
    </a>
</li>
<li class="breadcrumb-item active">
    Edit Profile
</li>
@endsection

@section('content')
<main class="container">
    <section class="p-4 rounded shadow-sm bg-light text-muted">
        <div class="row g-4 align-items-center">
            <h1 class="display-4 fw-bold mb-3">
                <span class="fw-bold text-black">EDIT PROFILE: </span>
            </h1>

            <form 
                method="POST" 
                action="{{ route('profile.update') }}"
                class="col-12 col-lg-7">
                @csrf
                @method('PUT')

                <div class="row form-group mb-2">
                    <label class="col-3 col-form-label fw-bold" for="inputName">Name</label>
                    <input 
                        class="col up form-control rounded" 
                        name="name" 
                        id="inputName" 
                        type="text" 
                        value="{{ old('name', $user->name) }}" 
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
                        value="{{ old('email', $user->email) }}" 
                        required/>
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-success mt-5 mr-2">
                        <i class="fas fa-save me-2"></i>Update
                    </button>
                    <a href="{{ route('profile.show') }}" class="btn btn-secondary mt-5">
                        <i class="fas fa-times me-2"></i>Cancel
                    </a>
                </div>
            </form>
        </div>
            
        <div class="col-12 col-lg-7 mt-5 form-group text-center">
            <a href="{{ route('auth.two-factor-profile') }}" class="btn btn-primary">
                Update Two-StepFactor
            </a>
        </div>
    </section>
    <a class="btn btn-secondary btn-lg m-4" href="{{ route('profile.show') }}">Back</a>
</main>
@endsection
