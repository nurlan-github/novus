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
    <x-key-translate key="permissions" />
@endsection

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-lg-6 col-sm-12 d-flex align-items-center">
                <h3 class="fw-bold">@yield('pageTitle')</h3>
            </div>
            <div class="col-lg-6 col-sm-12 d-flex justify-content-end">
                @can('create_languages')
                    <a href="{{ route('permissions.create') }}" class="btn btn-success">
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
                        <th># / ID</th>
                        <th><x-key-translate key="name" /></th>
                        @can('edit_permissions')
                            <!-- Ensure you have the appropriate permission check -->
                            <th><x-key-translate key="actions" /></th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $key => $permission)
                        <tr>
                            <td>{{ ++$key . ' / ID - ' . $permission->id }}</td>
                            <td><span class="badge text-bg-success">{{ $permission->name }}</span></td>
                            @can('edit_permissions')
                                <!-- Ensure you have the appropriate permission check -->
                                <td>
                                    @can('edit_permissions')
                                        <a href="{{ route('permissions.edit', $permission->id) }}"
                                            class="btn btn-sm btn-warning mb-1">
                                            <i class="bi bi-pencil-square"></i> <x-key-translate key="edit" />
                                        </a>
                                    @endcan
                                    @can('delete_permissions')
                                        <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST"
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
        <div class="d-flex justify-content-center">
            {{ $permissions->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
