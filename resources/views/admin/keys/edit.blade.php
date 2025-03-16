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
    <x-key-translate key="edit" />
@endsection

@section('content')
    <div class="container">
        <!-- Flash Message -->
        <x-flash-message />
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-10 col-sm-12">
                <h1 class="text-center">@yield('pageTitle'): {{ $key->key }}</h1>
                <div class="card shadow bg-white">
                    <div class="card-body">

                        <form action="{{ route('keys.update', $key->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            @foreach ($languages as $language)
                                <div class="mb-3">
                                    <label class="my-2">{{ $language->name }} <span
                                            class="badge text-bg-success">{{ strtoupper($language->code) }}</span></label>
                                    <input type="text" name="values[{{ $language->id }}]" class="form-control"
                                        value="{{ $translations[$language->id]->value ?? '' }}">
                                </div>
                            @endforeach

                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-floppy me-2"></i>
                                <x-key-translate key="update" />
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
