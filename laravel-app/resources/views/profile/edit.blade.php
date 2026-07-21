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
                action="{{ route('user-profile-information.update') }}"
                class="col-12 col-lg-7">
                @csrf
                @method('PUT')

                <div class="row form-group mb-2">
                    <label class="col-3 col-form-label fw-bold" for="inputDisplayName">Display Name</label>
                    <input 
                        class="col up form-control rounded" 
                        name="display_name" 
                        id="inputDisplayName" 
                        type="text" 
                        value="{{ old('display_name', $user->display_name) }}" 
                        required 
                        autofocus/>
                </div>

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

                <div class="row form-group mb-2">
                    <label class="col-3 col-form-label fw-bold" for="inputBirthDate">Birth Date</label>
                    <input 
                        class="col up form-control rounded" 
                        name="birth_date" 
                        id="inputBirthDate" 
                        type="date" 
                        value="{{ old('birth_date', $user->birth_date_for_input) }}" 
                        required/>
                </div>

                <div class="row form-group mb-2">
                    <label class="col-3 col-form-label fw-bold" for="inputPhone">Phone</label>
                    <input 
                        class="col up form-control rounded" 
                        name="phone" 
                        id="inputPhone" 
                        type="text" 
                        value="{{ old('phone', $user->phone) }}"/>
                </div>

                <div class="row form-group mb-2">
                    <label class="col-3 col-form-label fw-bold" for="inputAddress">Address</label>
                    <input 
                        class="col up form-control rounded" 
                        name="address" 
                        id="inputAddress" 
                        type="text" 
                        value="{{ old('address', $user->address) }}"/>
                </div>

                <div class="row form-group mb-2">
                    <label class="col-3 col-form-label fw-bold" for="inputCity">City</label>
                    <input 
                        class="col up form-control rounded" 
                        name="city" 
                        id="inputCity" 
                        type="text" 
                        value="{{ old('city', $user->city) }}"/>
                </div>

                <div class="row form-group mb-2">
                    <label class="col-3 col-form-label fw-bold" for="selectCountryId">Country</label>
                    <select 
                        class="col up form-control rounded" 
                        name="country_id" 
                        id="selectCountryId">
                        <option value="">-- none --</option>
                        @foreach ($countries as $country)
                            <option
                            value="{{ $country->id }}"
                            @if ($user->countryId === $country->id)
                                selected
                            @endif>{{ $country->name }}</option>
                        @endforeach
                    </select>
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
            
        <div class="col-12 col-lg-7 mt-5 form-group text-center row">
            <a href="{{ route('auth.two-factor-profile') }}" class="btn btn-primary">
                Update Two-StepFactor
            </a>
            @if (!auth()->user()->hasVerifiedEmail())
                <form method="POST" action="{{ route('verification.send') }}" class="row p-0 mx-0 mt-3">
                    @csrf
                    <button type="submit" class="btn btn-success">Reenviar email de verificación</button>
                </form>
            @endif
        </div>
        <div class="col-12 col-lg-7 mt-5 form-group text-center">
        </div>
    </section>
    <a class="btn btn-secondary btn-lg m-4" href="{{ route('profile.show') }}">Back</a>
</main>
@endsection
