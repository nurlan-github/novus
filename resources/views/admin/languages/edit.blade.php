@extends('layouts.app')

@section('model')
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}" class="fw-bold text-decoration-none">
            <i class="bi bi-speedometer2 me-2"></i>
            <x-key-translate key="dashboard" />
        </a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('languages.index') }}" class="fw-bold text-decoration-none">
            <i class="bi bi-globe me-2"></i>
            <x-key-translate key="languages" />
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
                        <form action="{{ route('languages.update', $language->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="code" class="form-label"><x-key-translate key="code" /></label>
                                <input type="text" name="code" id="code" class="form-control"
                                    value="{{ $language->code }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label"><x-key-translate key="name" /></label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ $language->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="is_default" class="form-label"><x-key-translate key="default" /></label>
                                <select name="is_default" id="is_default" class="form-select">
                                    <option value="0" {{ !$language->is_default ? 'selected' : '' }}><x-key-translate key="no" /></option>
                                    <option value="1" {{ $language->is_default ? 'selected' : '' }}><x-key-translate key="yes" /></option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="flag" class="form-label"><x-key-translate key="flag" /></label>
                                <input type="text" name="flag" id="flag" class="form-control"
                                    value="{{ $language->flag }}">
                            </div>
                            <div class="mb-3">
                                <label for="is_active" class="form-label"><x-key-translate key="active" /></label>
                                <select name="is_active" id="is_active" class="form-select">
                                    <option value="1" {{ $language->is_active ? 'selected' : '' }}><x-key-translate key="yes" /></option>
                                    <option value="0" {{ !$language->is_active ? 'selected' : '' }}><x-key-translate key="no" /></option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="rtl" class="form-label"><x-key-translate key="rlt" /></label>
                                <select name="rtl" id="rtl" class="form-select">
                                    <option value="0" {{ !$language->rtl ? 'selected' : '' }}><x-key-translate key="no" /></option>
                                    <option value="1" {{ $language->rtl ? 'selected' : '' }}><x-key-translate key="yes" /></option>
                                </select>
                            </div>
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
