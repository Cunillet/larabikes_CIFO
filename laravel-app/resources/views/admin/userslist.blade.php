@extends('template.master')
@section('title', 'Users List')

@section('breadcrumbs-items')
<li class="breadcrumb-item">
    <a href="{{ route('admin.dashboard') }}">
        Admin
    </a>
</li>
<li class="breadcrumb-item">
    Users List
</li>
@endsection

@section('content')
<style>
    .grid-stripped .row:nth-child(even) {
        background-color: lightgray;
    }
</style>
<main class="container content-with-fixed-footer">
    <section class="p-4 rounded shadow-sm bg-light text-muted">
        @section('searchbar')
        <x-searchbar />
        @show
        <h1 class="display-4 fw-bold mb-3 d-flex justify-content-between align-items-center">
            <span>Users List</span><a href="{{ route('bikes.create') }}" class="btn btn-success">+</a>
        </h1>
        <div class="container grid-stripped">
            <div class="row h4 fw-bold p-2">
                <div class="col">
                    Display Name
                </div>
                <div class="col">
                    Name
                </div>
                <div class="col">
                    Email
                </div>
                <div class="col">
                    Roles
                </div>
                <div class="col">
                    Actions
                </div>
            </div>
            @if($users->count() > 0)
                @foreach($users as $user)
                <div class="row p-2">
                    <div class="col">
                        <a class="d/block text-muted text-decoration-none" href="{{ route('admin.user.details', $user->id) }}">
                            {{ $user->display_name }}
                        </a>
                    </div>
                    <div class="col">
                        <a class="d/block text-muted text-decoration-none" href="{{ route('admin.user.details', $user->id) }}">
                            {{ $user->name }}
                        </a>
                    </div>
                    <div class="col">
                        <a class="d/block text-muted text-decoration-none" href="{{ route('admin.user.details', $user->id) }}">
                            {{ $user->email }}
                        </a>
                    </div>
                    <div class="col">
                        <a class="d/block text-muted text-decoration-none" href="{{ route('admin.user.details', $user->id) }}">
                            <ul>
                                @forelse ($user->roles as $role)
                                    <li class="btn btn-secondary">
                                        {{ $role->role }}
                                    </li>
                                @empty
                                    <li class="btn btn-danger">NO ROLES</li>
                                @endforelse
                            </ul>
                        </a>
                    </div>
                    <div class="col">
                        {{-- <a class="text-danger text-decoration-none" href="{{ route('admin.delete', $bike->id) }}">
                            <i class="bi bi-trash3-fill"></i>
                        </a>
                        <a class="text-primary text-decoration-none ms-3" href="{{ route('bikes.edit', $bike->id) }}">
                            <i class="bi bi-pen-fill"></i>
                        </a> --}}
                    </div>
                </div>
                @endforeach
            @else
            <div class="row text-center">No Users found</div>
            @endif
        </div>
    </section>
</main>
@endsection
