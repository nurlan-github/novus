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
    <x-key-translate key="form_edit_category" />
@endsection

@section('content')
    <div class="container">
        <!-- Flash Message -->
        <x-flash-message />
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-sm-12">
                <h1 class="text-center">@yield('pageTitle')</h1>
                <div class="card shadow bg-white p-3">
                    <div class="card-body">
                        <form action="{{ route('categories.update', $category->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                           <x-error-alert />

                            @php
                                $locale = request()->query('locale', null);
                            @endphp

                            @if ($locale)
                                <input type="hidden" name="parent_id" value="{{ $category->parent_id }}">
                                <input type="hidden" name="is_active" value="{{ $category->is_active }}">
                            @else
                                <div class="mb-3">
                                    <label for="parent_id" class="form-label"><x-key-translate key="parent_category" /></label>
                                    <select name="parent_id" id="parent_id" class="form-control @error('parent_id') is-invalid @enderror">
                                        <option value=""><x-key-translate key="no_parent" /></option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" {{ $cat->id == $category->parent_id ? 'selected' : '' }}>{{ $cat->getTranslation(app()->getLocale())->name ?? '' }}</option>
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
                                        <option value="1" {{ $category->is_active ? 'selected' : '' }}><x-key-translate key="active" /></option>
                                        <option value="0" {{ !$category->is_active ? 'selected' : '' }}><x-key-translate key="inactive" /></option>
                                    </select>
                                    @error('is_active')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            @endif

                            @if ($locale)
                                @php
                                    $language = $languages->firstWhere('code', $locale);
                                    $translation = $category->translations->where('language_id', $language->id)->first();
                                    $inputClass = $translation ? 'border-success' : 'border-danger';
                                @endphp
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label>{{ $language->name }} ({{ strtoupper($language->code) }})
                                            @if ($translation)
                                                <i class="bi bi-translate text-success ms-2"></i>
                                            @else
                                                <i class="bi bi-translate text-danger ms-2"></i>
                                            @endif
                                        </label>
                                        <input type="text" name="translations[{{ $language->id }}][name]" class="form-control {{ $inputClass }} @error('translations.{{ $language->id }}.name') is-invalid @enderror" placeholder='<x-key-translate key="name" />' value="{{ old('translations.' . $language->id . '.name', $translation->name ?? '') }}" id="name_{{ $language->id }}">
                                        @error('translations.{{ $language->id }}.name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <input type="text" name="translations[{{ $language->id }}][slug]" class="form-control mt-2 {{ $inputClass }} @error('translations.{{ $language->id }}.slug') is-invalid @enderror" placeholder="@lang('Slug')" value="{{ old('translations.' . $language->id . '.slug', $translation->slug ?? '') }}" id="slug_{{ $language->id }}" readonly>
                                        @error('translations.{{ $language->id }}.slug')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <textarea name="translations[{{ $language->id }}][description]" class="form-control mt-2 {{ $inputClass }} @error('translations.{{ $language->id }}.description') is-invalid @enderror" placeholder='<x-key-translate key="description" />'>{{ old('translations.' . $language->id . '.description', $translation->description ?? '') }}</textarea>
                                        @error('translations.{{ $language->id }}.description')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="alert alert-info mt-4">
                                    <h5><x-key-translate key="category_translates" /></h5>
                                    <ul>
                                        @foreach ($languages as $lang)
                                            @if ($lang->code != $locale)
                                                @php
                                                    $translation = $category->translations->where('language_id', $lang->id)->first();
                                                @endphp
                                                <li class="fw-bold {{ $translation ? 'text-success' : 'text-danger' }}">{{ strtoupper($lang->code) }} - @if($translation) {{ $translation->name }} @else <x-key-translate key="no_translation_available" /> @endif</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            @else
                                @foreach ($languages as $language)
                                    @php
                                        $translation = $category->translations->where('language_id', $language->id)->first();
                                        $inputClass = $translation ? 'border-success' : 'border-danger';
                                    @endphp
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label>{{ $language->name }} ({{ strtoupper($language->code) }})
                                                @if ($translation)
                                                    <i class="bi bi-translate text-success ms-2"></i>
                                                @else
                                                    <i class="bi bi-translate text-danger ms-2"></i>
                                                @endif
                                            </label>
                                            <input type="text" name="translations[{{ $language->id }}][name]" class="form-control {{ $inputClass }} @error('translations.{{ $language->id }}.name') is-invalid @enderror" placeholder="@lang('Name')" value="{{ old('translations.' . $language->id . '.name', $translation->name ?? '') }}" id="name_{{ $language->id }}">
                                            @error('translations.{{ $language->id }}.name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <input type="text" name="translations[{{ $language->id }}][slug]" class="form-control mt-2 {{ $inputClass }} @error('translations.{{ $language->id }}.slug') is-invalid @enderror" placeholder="@lang('Slug')" value="{{ old('translations.' . $language->id . '.slug', $translation->slug ?? '') }}" id="slug_{{ $language->id }}" readonly>
                                            @error('translations.{{ $language->id }}.slug')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <textarea name="translations[{{ $language->id }}][description]" class="form-control mt-2 {{ $inputClass }} @error('translations.{{ $language->id }}.description') is-invalid @enderror" placeholder="@lang('Description')">{{ old('translations.' . $language->id . '.description', $translation->description ?? '') }}</textarea>
                                            @error('translations.{{ $language->id }}.description')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach
                            @endif

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
            @if ($locale)
                document.getElementById('name_{{ $language->id }}').addEventListener('input', function () {
                    document.getElementById('slug_{{ $language->id }}').value = this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
                });
            @else
                @foreach ($languages as $language)
                    document.getElementById('name_{{ $language->id }}').addEventListener('input', function () {
                        document.getElementById('slug_{{ $language->id }}').value = this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
                    });
                @endforeach
            @endif
        });
    </script>
@endsection