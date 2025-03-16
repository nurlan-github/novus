@extends('layouts.app')

@section('model')
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}" class="fw-bold text-decoration-none">
            <i class="bi bi-speedometer2 me-2"></i>
            <x-key-translate key="dashboard" />
        </a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('categories.index') }}" class="fw-bold text-decoration-none">
            <i class="bi bi-folder me-2"></i>
            <x-key-translate key="categories" />
        </a>
    </li>
@endsection

@section('pageTitle')
    <x-key-translate key="create_new_category" />
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
                        <form action="{{ route('categories.store') }}" method="POST">
                            @csrf

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="mb-3">
                                <label for="parent_id" class="form-label"><x-key-translate key="parent_category" /></label>
                                <select name="parent_id" id="parent_id" class="form-control @error('parent_id') is-invalid @enderror">
                                    <option value=""><x-key-translate key="no_parent" /></option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->getTranslation(app()->getLocale())->name ?? '' }}</option>
                                    @endforeach
                                </select>
                                @error('parent_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="is_active" class="form-label"><x-key-translate key="is_active" /></label>
                                <select name="is_active" id="is_active" class="form-control @error('is_active') is-invalid @enderror">
                                    <option value="1"><x-key-translate key="active" /></option>
                                    <option value="0"><x-key-translate key="inactive" /></option>
                                </select>
                                @error('is_active')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            @php
                                $locale = App::getLocale();
                            @endphp

                            @foreach ($languages as $language)
                                @if ($language->code == $locale)
                                    <div class="mb-3">
                                        <label>{{ $language->name }} ({{ strtoupper($language->code) }})</label>
                                        <input type="text" name="translations[{{ $language->id }}][name]" class="form-control @error('translations.{{ $language->id }}.name') is-invalid @enderror" placeholder='<x-key-translate key="name" />' id="name_{{ $language->id }}">
                                        @error('translations.{{ $language->id }}.name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <input type="text" name="translations[{{ $language->id }}][slug]" class="form-control mt-2 @error('translations.{{ $language->id }}.slug') is-invalid @enderror" placeholder='<x-key-translate key="slug" />' id="slug_{{ $language->id }}">
                                        @error('translations.{{ $language->id }}.slug')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <textarea name="translations[{{ $language->id }}][description]" class="form-control mt-2 @error('translations.{{ $language->id }}.description') is-invalid @enderror" placeholder='<x-key-translate key="description" />'></textarea>
                                        @error('translations.{{ $language->id }}.description')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                @else
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="toggle_{{ $language->id }}">
                                            <label class="form-check-label" for="toggle_{{ $language->id }}">{{ $language->name }} ({{ strtoupper($language->code) }})</label>
                                        </div>
                                        <div id="translation_{{ $language->id }}" style="display: none;">
                                            <input type="text" name="translations[{{ $language->id }}][name]" class="form-control mt-2" placeholder='<x-key-translate key="name" />' id="name_{{ $language->id }}">
                                            <input type="text" name="translations[{{ $language->id }}][slug]" class="form-control mt-2" placeholder='<x-key-translate key="slug" />' id="slug_{{ $language->id }}">
                                            <textarea name="translations[{{ $language->id }}][description]" class="form-control mt-2" placeholder='<x-key-translate key="description" />'></textarea>
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                            <button type="submit" class="btn btn-success w-100">
                                <i class="bi bi-floppy me-2"></i>
                                <x-key-translate key="save" />
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @foreach ($languages as $language)
                document.getElementById('name_{{ $language->id }}').addEventListener('input', function () {
                    document.getElementById('slug_{{ $language->id }}').value = this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
                });

                @if ($language->code != $locale)
                    document.getElementById('toggle_{{ $language->id }}').addEventListener('change', function () {
                        var translationDiv = document.getElementById('translation_{{ $language->id }}');
                        if (this.checked) {
                            translationDiv.style.display = 'block';
                        } else {
                            translationDiv.style.display = 'none';
                        }
                    });
                @endif
            @endforeach
        });
    </script>
@endsection