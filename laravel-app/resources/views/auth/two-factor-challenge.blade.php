@extends('template.master')
@section('title', 'Two-Factor Authentication')

@section('breadcrumbs-items')
<li class="breadcrumb-item">
    <a href="{{ route('bikes.index') }}">
        Bikes List
    </a>
</li>
<li class="breadcrumb-item active">
    Two-Factor Challenge
</li>
@endsection

@section('content')
<main class="container">
    <section class="p-4 rounded shadow-sm bg-light text-muted">
        <div class="row g-4 justify-content-center">
            <div class="col-12 col-lg-6">
                <h1 class="display-4 fw-bold mb-3">
                    <span class="fw-bold text-black">Two-Factor Authentication</span>
                </h1>
                <p class="lead">Enter the authentication code from your authenticator app, or use one of your recovery codes.</p>

                {{-- Tabla de opciones: Code / Recovery Code --}}
                <ul class="nav nav-tabs mb-3" id="twoFactorTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="code-tab" data-bs-toggle="tab" data-bs-target="#code" type="button" role="tab" aria-controls="code" aria-selected="true">Authentication Code</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="recovery-tab" data-bs-toggle="tab" data-bs-target="#recovery" type="button" role="tab" aria-controls="recovery" aria-selected="false">Recovery Code</button>
                    </li>
                </ul>

                <div class="tab-content" id="twoFactorTabContent">
                    {{-- Pestaña: Código normal --}}
                    <div class="tab-pane fade show active" id="code" role="tabpanel" aria-labelledby="code-tab">
                        <form method="POST" action="{{ route('two-factor.login') }}">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label fw-bold" for="code">Authentication Code</label>
                                <input 
                                    class="form-control rounded @error('code') is-invalid @enderror" 
                                    name="code" 
                                    id="code" 
                                    type="text" 
                                    inputmode="numeric"
                                    pattern="[0-9]*"
                                    maxlength="6"
                                    placeholder="000000"
                                    autofocus
                                    autocomplete="one-time-code"/>
                                @error('code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary mt-3">Verify</button>
                            </div>
                        </form>
                    </div>

                    {{-- Pestaña: Recovery Code --}}
                    <div class="tab-pane fade" id="recovery" role="tabpanel" aria-labelledby="recovery-tab">
                        <form method="POST" action="{{ route('two-factor.login') }}">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label fw-bold" for="recovery_code">Recovery Code</label>
                                <input 
                                    class="form-control rounded @error('recovery_code') is-invalid @enderror" 
                                    name="recovery_code" 
                                    id="recovery_code" 
                                    type="text" 
                                    placeholder="XXXX-XXXX-XXXX-XXXX"
                                    autocomplete="off"/>
                                @error('recovery_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-warning mt-3">Verify Recovery Code</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <a class="btn btn-secondary btn-lg m-4" href="{{ route('bikes.index') }}">Back</a>
</main>
@endsection
