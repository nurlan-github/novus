@extends('layouts.app')

@section('model')
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}" class="fw-bold text-decoration-none">
            <i class="bi bi-speedometer2 me-2"></i>
            <x-key-translate key="dashboard" />
        </a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('keys.index') }}" class="fw-bold text-decoration-none">
            <i class="bi bi-file-text me-2"></i>
            <x-key-translate key="keys_translate" />
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
            <div class="col-lg-6 col-md-10 col-sm-12">
                <h1 class="text-center">@yield('pageTitle')</h1>
                <div class="card shadow bg-white">
                    <div class="card-body">
                        <form action="{{ route('keys.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="key" class="form-label"><x-key-translate key="keys" /></label>
                                <input type="text" name="key" class="form-control" required>
                            </div>

                            @foreach ($languages as $language)
                                <div class="mb-3">
                                    <label>{{ $language->name }} ({{ strtoupper($language->code) }})</label>
                                    <input type="text" name="values[{{ $language->id }}]" class="form-control">
                                </div>
                            @endforeach

                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-floppy me-2"></i>
                                <x-key-translate key="save" />
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
