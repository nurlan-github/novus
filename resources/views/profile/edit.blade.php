@extends('layouts.app')

@section('pageTitle')
    <x-key-translate key="profile" />
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><x-key-translate key="edit_profile" /></div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Ism -->
                        <div class="mb-3">
                            <label for="name" class="form-label"><x-key-translate key="full_name" /></label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', auth()->user()->name) }}" required>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label"><x-key-translate key="email" /></label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" required>
                        </div>

                        <!-- Joriy Parol -->
                        <div class="mb-3">
                            <label for="current_password" class="form-label"><x-key-translate key="current_password" /></label>
                            <input type="password" name="current_password" id="current_password" class="form-control" autocomplete="current-password">
                            @error('current_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Yangi Parol -->
                        <div class="mb-3">
                            <label for="password" class="form-label"><x-key-translate key="new_password" /></label>
                            <input type="password" name="password" id="password" class="form-control" autocomplete="new-password">
                        </div>

                        <!-- Yangi Parolni Tasdiqlash -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label"><x-key-translate key="confirm_new_password" /></label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" autocomplete="new-password">
                        </div>

                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-floppy me-2"></i>
                            <x-key-translate key="update_profile" />
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
