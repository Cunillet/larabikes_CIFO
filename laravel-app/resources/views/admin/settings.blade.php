@extends('template.master')
@section('title', 'Admin Settings')

@section('breadcrumbs-items')
<li class="breadcrumb-item">
    <a href="{{ route('admin.dashboard') }}">
        Admin
    </a>
</li>
<li class="breadcrumb-item">
    Settings
</li>
@endsection

@section('content')
<main class="container content-with-fixed-footer">
    <section class="p-4 rounded shadow-sm bg-light text-muted">
        <h1 class="display-4 fw-bold mb-4">
            <span class="fw-bold text-black">Admin Settings</span>
        </h1>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-info-circle me-2"></i>Application Information</h5>
                <div class="list-group list-group-flush">
                    <div class="list-group-item d-flex justify-content-between">
                        <strong>Application</strong>
                        <span>{{ config('app.name') }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between">
                        <strong>Environment</strong>
                        <span><code>{{ app()->environment() }}</code></span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between">
                        <strong>Laravel Version</strong>
                        <span><code>{{ app()->version() }}</code></span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between">
                        <strong>Bikes per page</strong>
                        <span>{{ config('pagination.bikes', 12) }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between">
                        <strong>Circuits per page</strong>
                        <span>{{ config('pagination.circuits', 12) }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between">
                        <strong>Users per page</strong>
                        <span>{{ config('pagination.users', 12) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="alert alert-info" role="alert">
            <i class="bi bi-tools me-2"></i>
            More settings options will be available in future updates.
        </div>
    </section>
    <a class="btn btn-secondary btn-lg m-4" href="{{ route('admin.dashboard') }}">Back to Dashboard</a>
</main>
@endsection
