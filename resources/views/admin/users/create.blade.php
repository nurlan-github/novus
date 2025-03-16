@extends('layouts.app')

@section('model')
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}" class="fw-bold text-decoration-none">
            <i class="bi bi-speedometer2 me-2"></i>
            <x-key-translate key="dashboard" />
        </a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('users.index') }}" class="fw-bold text-decoration-none">
            <i class="bi bi-people me-2"></i>
            <x-key-translate key="users" />
        </a>
    </li>
@endsection

@section('pageTitle')
    <x-key-translate key="create_new_user" />
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
                        <form action="{{ route('users.store') }}" method="POST">
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
                                <label for="name" class="form-label"><x-key-translate key="full_name" /></label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label"><x-key-translate key="email" /></label>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label"><x-key-translate key="password" /></label>
                                <div class="input-group">
                                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="bi bi-eye-slash"></i>
                                    </button>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label"><x-key-translate key="confirm_password" /></label>
                                <div class="input-group">
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                                    <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirmation">
                                        <i class="bi bi-eye-slash"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="roles" class="form-label"><x-key-translate key="roles" /></label>
                                <select name="roles" id="roles" class="form-control @error('roles') is-invalid @enderror">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('roles')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

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
            const togglePassword = document.getElementById('togglePassword');
            const password = document.getElementById('password');
            togglePassword.addEventListener('click', function (e) {
                // toggle the type attribute
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                // toggle the eye slash icon
                this.classList.toggle('bi-eye-slash');
                this.classList.toggle('bi-eye');
            });

            const togglePasswordConfirmation = document.getElementById('togglePasswordConfirmation');
            const passwordConfirmation = document.getElementById('password_confirmation');
            togglePasswordConfirmation.addEventListener('click', function (e) {
                // toggle the type attribute
                const type = passwordConfirmation.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordConfirmation.setAttribute('type', type);
                // toggle the eye slash icon
                this.classList.toggle('bi-eye-slash');
                this.classList.toggle('bi-eye');
            });
        });
    </script>
@endsection