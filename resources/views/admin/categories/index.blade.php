@extends('layouts.app')

@section('model')
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}" class="fw-bold text-decoration-none">
            <i class="bi bi-speedometer2 me-2"></i>
            <x-key-translate key="dashboard" />
        </a>
    </li>
@endsection

@section('pageTitle')
    <x-key-translate key="categories" />
@endsection

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-lg-6 col-sm-12 d-flex align-items-center">
                <h3 class="fw-bold">@yield('pageTitle')</h3>
            </div>
            <div class="col-lg-6 col-sm-12 d-flex justify-content-end">
                @can('create_categories')
                    <a href="{{ route('categories.create') }}" class="btn btn-success">
                        <i class="bi bi-plus-circle me-2"></i>
                        <x-key-translate key="create" />
                    </a>
                @endcan
            </div>
        </div>
        <!-- Flash Message -->
        <x-flash-message />

        @if ($categories->isEmpty())
            <div class="card mt-3">
                <div class="card-body text-center">
                    <h5 class="card-title"><x-key-translate key="no_categories" /></h5>
                    <p class="card-text"><x-key-translate key="create_first_category" /></p>
                    @can('create_categories')
                        <a href="{{ route('categories.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-2"></i>
                            <x-key-translate key="create" />
                        </a>
                    @endcan
                </div>
            </div>
        @else
            <div class="row">
                @foreach ($categories as $category)
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title d-flex align-items-center justify-content-between">
                                    <span class="text-uppercase"><strong>ID:</strong> {{ $category->id }} -
                                        {{ $category->getTranslation(app()->getLocale())->name ?? '' }}</span>
                                    <div class="m-1">
                                        @can('edit_categories')
                                            <a href="{{ route('categories.edit', $category->id) }}" style="font-size:20px;"
                                                class="text-success"><i class="bi bi-pencil-square"></i></a>
                                        @endcan
                                        @can('delete_categories')
                                            <a type="button" style="font-size:20px;" class="text-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal" data-bs-category-id="{{ $category->id }}">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        @endcan
                                    </div>
                                </h5>
                                <p class="card-text">
                                    <strong>Status:</strong> {{ $category->is_active ? __('Active') : __('Inactive') }},
                                    <br>
                                    <strong>Slug:</strong> {{ $category->getTranslation(app()->getLocale())->slug ?? '' }},

                                    @if ($category->parent)
                                        <strong>Parent:</strong>
                                        {{ $category->parent->getTranslation(app()->getLocale())->name ?? '' }}
                                    @endif
                                </p>


                                <div class="accordion mt-2" id="accordionExample{{ $category->id }}">
                                    @foreach ($languages as $lang)
                                        @php
                                            $translation = $category->translations
                                                ->where('language_id', $lang->id)
                                                ->first();
                                        @endphp
                                        <div class="accordion-item">
                                            <h2 class="accordion-header"
                                                id="heading{{ $category->id }}_{{ $lang->id }}">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapse{{ $category->id }}_{{ $lang->id }}"
                                                    aria-expanded="false"
                                                    aria-controls="collapse{{ $category->id }}_{{ $lang->id }}">
                                                    {{ $lang->name }} ({{ strtoupper($lang->code) }})
                                                    @if ($translation)
                                                        <i class="bi bi-translate text-success ms-2"></i>
                                                    @else
                                                        <i class="bi bi-translate text-danger ms-2"></i>
                                                    @endif
                                                </button>
                                            </h2>
                                            <div id="collapse{{ $category->id }}_{{ $lang->id }}"
                                                class="accordion-collapse collapse"
                                                aria-labelledby="heading{{ $category->id }}_{{ $lang->id }}"
                                                data-bs-parent="#accordionExample{{ $category->id }}">
                                                <div class="accordion-body">
                                                    @if ($translation)
                                                        <p><strong>{{ __('Name') }}:</strong> {{ $translation->name }}
                                                        </p>
                                                        <p><strong>{{ __('Slug') }}:</strong> {{ $translation->slug }}
                                                        </p>
                                                        <p><strong>{{ __('Description') }}:</strong>
                                                            {{ $translation->description }}</p>
                                                    @else
                                                        <a href="{{ route('categories.edit', ['category' => $category->id, 'locale' => $lang->code]) }}"
                                                            class="btn btn-sm btn-primary">
                                                            <i class="bi bi-plus-circle"></i>
                                                            <x-key-translate key="add_translation" />
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Delete Confirmation Modal -->
    <x-delete-confirm />

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteModal = document.getElementById('deleteModal');
            deleteModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget; // Button that triggered the modal
                const categoryId = button.getAttribute(
                'data-bs-category-id'); // Extract info from data-bs-* attributes
                const deleteForm = document.getElementById('deleteForm');
                deleteForm.action = `{{ route('categories.destroy', ':id') }}`.replace(':id', categoryId);
            });
        });
    </script>
@endsection
