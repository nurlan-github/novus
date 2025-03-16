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
    <x-key-translate key="roles" />
@endsection

@section('content')
    <div class="container">
        <!-- Flash Message -->
        <x-flash-message />

        <div class="row mb-3">
            <div class="col-lg-6 col-sm-12 d-flex align-items-center">
                <h3 class="fw-bold">@yield('pageTitle')</h3>
            </div>
            <div class="col-lg-6 col-sm-12 d-flex justify-content-end">
                @can('create_roles')
                    <a href="{{ route('roles.create') }}" class="btn btn-success">
                        <i class="bi bi-plus-circle me-2"></i>
                        <x-key-translate key="create" />
                    </a>
                @endcan
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body text-center">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th>ID</th>
                                <th><x-key-translate key="name" /></th>
                                <th><x-key-translate key="permissions" /></th>
                                @can('edit_roles')
                                    <!-- Ensure you have the appropriate permission check -->
                                    <th style="width: 220px"><x-key-translate key="actions" /></th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @foreach ($role->permissions as $perm)
                                            <span class="badge bg-secondary">{{ $perm->name }}</span>
                                        @endforeach
                                    </td>
                                    @can('edit_roles')
                                        <!-- Ensure you have the appropriate permission check -->
                                        <td>
                                            <div class="d-flex align-items-center justify-content-center">
                                                @can('edit_roles')
                                                    <a href="{{ route('roles.edit', $role->id) }}"
                                                        style="width: 90px; margin-top: 3px; margin-right: 3px;"
                                                        class="btn btn-sm btn-warning mb-1">
                                                        <i class="bi bi-pencil-square"></i> <x-key-translate key="edit" />
                                                    </a>
                                                @endcan
                                                @can('delete_roles')
                                                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" style="width: 90px" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Are you sure?')">
                                                            <i class="bi bi-trash"></i> <x-key-translate key="delete" />
                                                        </button>
                                                    </form>
                                                @endcan

                                            </div>
                                        </td>
                                    @endcan
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center">
                    {{ $roles->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection
