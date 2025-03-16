@extends('layouts.app')
@section('model')
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}" class="fw-bold text-decoration-none">
            <i class="bi bi-speedometer2 me-2"></i>
            <x-key-translate key="dashboard" />
        </a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('permissions.index') }}" class="fw-bold text-decoration-none">
            <i class="bi bi-ui-checks me-2"></i>
            <x-key-translate key="permissions" />
        </a>
    </li>
@endsection

@section('pageTitle')
    <x-key-translate key="form_edit" />
@endsection

@section('content')
    <div class="container">
        <!-- Flash Message -->
        <x-flash-message />
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-10 col-sm-12">
                <h1 class="text-center">@yield('pageTitle')</h1>
                <div class="card shadow bg-white">
                    <div class="card-body">
                        <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label"><x-key-translate key="name" /></label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ $permission->name }}" required>
                            </div>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-floppy"></i>
                                <x-key-translate key="update" />
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
