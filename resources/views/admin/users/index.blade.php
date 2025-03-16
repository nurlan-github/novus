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
    <x-key-translate key="users" />
@endsection

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-lg-6 col-sm-12 d-flex align-items-center">
                <h3 class="fw-bold">@yield('pageTitle')</h3>
            </div>
            <div class="col-lg-6 col-sm-12 d-flex justify-content-end">
                @can('create_users')
                    <a href="{{ route('users.create') }}" class="btn btn-success">
                        <i class="bi bi-plus-circle me-2"></i>
                        <x-key-translate key="create" />
                    </a>
                @endcan
            </div>
        </div>
        <!-- Flash Message -->
        <x-flash-message />

        @if ($users->isEmpty())
            <p>No users available.</p>
        @else
            <div class="row">
                @foreach ($users as $user)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-person-circle me-3" style="font-size: 2rem;"></i>
                                        <h5 class="card-title mb-0">{{ $user->name }}</h5>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        {{-- @can('show_users')
                                            <a href="{{ route('users.show', $user->id) }}" class="text-info me-2">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        @endcan --}}
                                        @can('edit_users')
                                            <a href="{{ route('users.edit', $user->id) }}" class="text-warning me-2">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                        @endcan
                                        @can('delete_users')
                                            <a class="text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-bs-user-id="{{ $user->id }}">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        @endcan
                                    </div>
                                </div>
                                <p class="card-text">
                                    <strong><x-key-translate key="email" />:</strong> {{ $user->email }}<br>
                                    <strong><x-key-translate key="roles" />:</strong> <span class="badge bg-success">{{ $user->roles->pluck('name')->join(', ') }}</span>
                                </p>
                                
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
                const userId = button.getAttribute('data-bs-user-id'); // Extract info from data-bs-* attributes
                const deleteForm = document.getElementById('deleteForm');
                deleteForm.action = `{{ route('users.destroy', ':id') }}`.replace(':id', userId);
            });
        });
    </script>
@endsection