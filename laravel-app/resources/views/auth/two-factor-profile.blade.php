@extends('template.master')
@section('title', 'Profile & 2FA Settings')

@section('breadcrumbs-items')
<li class="breadcrumb-item">
    <a href="{{ route('profile.show') }}">
        My Profile
    </a>
</li>
<li class="breadcrumb-item active">
    Two Step Factor
</li>
@endsection

@section('content')
<main class="container">
    <section class="p-4 rounded shadow-sm bg-light text-muted">
        <div class="row g-4">
            <div class="col-12">
                <h1 class="display-4 fw-bold mb-4">
                    <span class="fw-bold text-black">Profile Settings</span>
                </h1>
                <p class="lead">
                    Welcome, <strong>{{ auth()->user()->name }}</strong> ({{ auth()->user()->email }})
                </p>
            </div>

            <div class="col-12 col-lg-8">
                <div class="card border-primary">
                    <div class="card-header bg-primary text-white">
                        <i class="bi bi-shield-lock me-2"></i>Two-Factor Authentication (2FA)
                    </div>
                    <div class="card-body">

                        @if (!auth()->user()->two_factor_secret)
                            {{-- 2FA INACTIVE --}}
                            <p class="card-text">
                                Add an extra layer of security to your account using two-factor authentication.
                                You'll need an authenticator app like Google Authenticator or Authy.
                            </p>
                            <form method="POST" action="{{ url('user/two-factor-authentication') }}">
                                @csrf
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-shield-plus me-1"></i>Enable 2FA
                                </button>
                            </form>

                        @elseif (session('status') == 'two-factor-authentication-enabled' && ! auth()->user()->two_factor_confirmed_at)
                            {{-- 2FA ACTIVE but NOT CONFIRMED --}}
                            <p class="card-text text-warning fw-bold">
                                <i class="bi bi-exclamation-triangle me-1"></i>
                                Scan this QR code with your authenticator app, then enter the code to confirm.
                            </p>

                            <div class="text-center my-4">
                                {!! auth()->user()->twoFactorQrCodeSvg() !!}
                            </div>

                            <p class="small text-muted">
                                Or manually enter the secret key in your app.
                            </p>

                            <form
                                method="POST"
                                action="{{ url('user/confirmed-two-factor-authentication') }}">
                                @csrf

                                <div class="row g-2 align-items-end">
                                    <div class="col-auto">
                                        <label class="form-label fw-bold" for="code">
                                            Confirm Code
                                        </label>
                                        <input 
                                            class="form-control @error('code') is-invalid @enderror"
                                            name="code"
                                            id="code"
                                            type="text"
                                            inputmode="numeric"
                                            pattern="[0-9]*"
                                            maxlength="6"
                                            placeholder="000000"
                                            required/>
                                        @error('code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-success">Confirm</button>
                                    </div>
                                </div>
                            </form>

                        @else
                            {{-- 2FA ACTIVE and CONFIRMED --}}
                            <p class="card-text text-success fw-bold">
                                <i class="bi bi-check-circle-fill me-1"></i>
                                Two-factor authentication is <strong>Active</strong>.
                            </p>

                            {{-- Recovery Codes --}}
                            <div class="mb-3">
                                <button
                                    class="btn btn-outline-secondary btn-sm"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#recoveryCodes"
                                    aria-expanded="false">
                                    <i class="bi bi-key me-1"></i>Show Recovery Codes
                                </button>
                                <div class="collapse mt-2" id="recoveryCodes">
                                    <div class="card card-body bg-dark text-light">
                                        <p class="small">
                                            Store these recovery codes in a secure location. Each code can only be used once.
                                        </p>
                                        <pre class="mb-0">
                                            @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes)) as $code)
                                                {{ $code }}
                                            @endforeach
                                        </pre>
                                    </div>
                                    <form
                                        method="POST"
                                        action="{{ url('user/two-factor-recovery-codes') }}"
                                        class="mt-2">
                                        @csrf
                                        <button type="submit" class="btn btn-warning btn-sm">
                                            <i class="bi bi-arrow-clockwise me-1"></i>Regenerate Codes
                                        </button>
                                    </form>
                                </div>
                            </div>

                            {{-- DISABLE 2FA --}}
                            <form
                                method="POST"
                                action="{{ url('user/two-factor-authentication') }}">
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to disable 2FA?');">
                                    <i class="bi bi-shield-slash me-1"></i>Disable 2FA
                                </button>
                            </form>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>
    <a class="btn btn-secondary btn-lg m-4" href="{{ route('profile.show') }}">Back</a>
</main>
@endsection
