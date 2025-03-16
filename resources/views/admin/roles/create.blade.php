@extends('layouts.app')

@section('model')
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}" class="fw-bold text-decoration-none">
            <i class="bi bi-speedometer2 me-2"></i>
            <x-key-translate key="dashboard" />
        </a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('roles.index') }}" class="fw-bold text-decoration-none">
            <i class="bi bi-person-rolodex me-2"></i>
            <x-key-translate key="roles" />
        </a>
    </li>
@endsection

@section('pageTitle')
    <x-key-translate key="form_create_new" />
@endsection

@section('content')
    <div class="container">
        <!-- Flash Message -->
        <x-flash-message />
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-10 col-sm-12">
                <h1 class="text-center">@yield('pageTitle')</h1>
                <div class="card shadow bg-white p-3">
                    <div class="card-body">
                        <form action="{{ route('roles.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label"><x-key-translate key="name" /></label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="mb-3  gap-3">
                                <label class="form-label"><x-key-translate key="permissions" /></label>
                                <div class="row">
                                    @php
                                        // Group permissions by the base name (e.g., 'name' from 'show_name')
                                        $groupedPermissions = [];
                                        foreach ($permissions as $perm) {
                                            // Extract the base name by removing the action prefix (e.g., 'show_', 'create_')
                                            $parts = explode('_', $perm->name, 2);
                                            $action = $parts[0];
                                            $name = $parts[1] ?? '';
                                            $groupedPermissions[$name][$action] = $perm;
                                        }
                                    @endphp

                                    @foreach ($groupedPermissions as $name => $actions)
                                        <div class="col-lg-3 col-md-4 col-sm-12">

                                            <div class="card bg-white my-2" style="border: none;">
                                                <div class="card-header bg-success text-white fw-bold rounded">
                                                    {{ ucfirst($name) }}
                                                </div>
                                                <ul class="list-group list-group-flush">
                                                    @foreach (['show', 'create', 'edit', 'delete'] as $action)
                                                        @if (isset($actions[$action]))
                                                            <label class="fw-bold" for="{{ $action }}_{{ $name }}">
                                                                <li class="list-group-item rounded bg-white mt-1">
                                                                    <div class="form-check">
                                                                        <input type="checkbox" name="permissions[]"
                                                                            value="{{ $actions[$action]->id }}"
                                                                            class="form-check-input"
                                                                            id="{{ $action }}_{{ $name }}">
                                                                        {{ $action }} {{ $name }}
                                                                    </div>
                                                                </li>
                                                            </label>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            {{-- <div class="mb-3">
                                <label class="form-label"><x-key-translate key="permissions" /></label>
                                <div class="d-flex flex-wrap">
                                    @foreach ($permissions as $perm)
                                        <div class="form-check border rounded m-1">
                                            <label class="form-check-label mx-1">
                                                <input type="checkbox" name="permissions[]" value="{{ $perm->id }}"
                                                    class="form-check-input">
                                                {{ $perm->name }}</label>
                                        </div>
                                    @endforeach
                                </div>

                            </div> --}}
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-floppy"></i>
                                <x-key-translate key="save" />
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
