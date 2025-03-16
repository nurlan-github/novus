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
    <x-key-translate key="languages" />
@endsection

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-lg-6 col-sm-12 d-flex align-items-center">
                <h3 class="fw-bold">@yield('pageTitle')</h3>
            </div>
            <div class="col-lg-6 col-sm-12 d-flex justify-content-end">
                @can('create_languages')
                    <a href="{{ route('languages.create') }}" class="btn btn-success">
                        <i class="bi bi-plus-circle me-2"></i>
                        <x-key-translate key="create" />
                    </a>
                @endcan
            </div>
        </div>
        <!-- Flash Message -->
        <x-flash-message />

        <div class="table-responsive mt-3">
            <table class="table table-bordered table-striped">
                <thead class="thead-light">
                    <tr class="text-center">
                        <th>ID</th>
                        <th><x-key-translate key="code" /></th>
                        <th><x-key-translate key="name" /></th>
                        <th><x-key-translate key="default" /> </th>
                        <th><x-key-translate key="flag" /></th>
                        <th><x-key-translate key="active" /></th>
                        <th>RTL</th>
                        @can('edit_languages')
                            <th><x-key-translate key="actions" /></th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($languages as $language)
                        <tr>
                            <td>{{ $language->id }}</td>
                            <td>{{ $language->code }}</td>
                            <td>{{ $language->name }}</td>
                            <td>
                                @if ($language->is_default)
                                    <x-key-translate key="yes" />
                                @else
                                    <x-key-translate key="no" />
                                @endif
                            </td>
                            <td>{{ $language->flag }}</td>
                            <td>
                                @if ($language->is_active)
                                    <x-key-translate key="yes" />
                                @else
                                    <x-key-translate key="no" />
                                @endif
                            </td>
                            <td>
                                @if ($language->rlt)
                                    <x-key-translate key="yes" />
                                @else
                                    <x-key-translate key="no" />
                                @endif
                            </td>
                            @can('edit_languages')
                                <td>
                                    @can('edit_languages')
                                        <a href="{{ route('languages.edit', $language->id) }}" class="btn btn-sm btn-warning mb-1">
                                            <i class="bi bi-pencil-square"></i> <x-key-translate key="edit" />
                                        </a>
                                    @endcan
                                    @can('delete_languages')
                                        <form action="{{ route('languages.destroy', $language->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure?')">
                                                <i class="bi bi-trash"></i> <x-key-translate key="delete" />
                                            </button>
                                        </form>
                                    @endcan
                                </td>
                            @endcan
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $languages->links('pagination::bootstrap-5') }}
    </div>
@endsection
