@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Settings</div>

                <div class="card-body">
                    <!-- Xabarlar -->
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Sozlamalar Formasi -->
                    <form action="{{ route('settings.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Til Tanlash -->
                        <div class="mb-3">
                            <label for="language" class="form-label">Language</label>
                            <select name="language" id="language" class="form-select">
                                <option value="uz" {{ optional($user->settings()->where('key', 'language')->first())->value === 'uz' ? 'selected' : '' }}>O'zbekcha</option>
                                <option value="ru" {{ optional($user->settings()->where('key', 'language')->first())->value === 'ru' ? 'selected' : '' }}>Русский</option>
                                <option value="en" {{ optional($user->settings()->where('key', 'language')->first())->value === 'en' ? 'selected' : '' }}>English</option>
                            </select>
                        </div>

                        <!-- Bildirishnomalar Yoqish/Yopish -->
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="notifications_enabled" id="notifications_enabled" class="form-check-input"
                                {{ optional($user->settings()->where('key', 'notifications_enabled')->first())->value === 'true' ? 'checked' : '' }}>
                            <label for="notifications_enabled" class="form-check-label">Enable Notifications</label>
                        </div>

                        <!-- Interfeys Rejimi (Light/Dark) -->
                        <div class="mb-3">
                            <label for="theme_mode" class="form-label">Theme Mode</label>
                            <select name="theme_mode" id="theme_mode" class="form-select">
                                <option value="light" {{ optional($user->settings()->where('key', 'theme_mode')->first())->value === 'light' ? 'selected' : '' }}>Light</option>
                                <option value="dark" {{ optional($user->settings()->where('key', 'theme_mode')->first())->value === 'dark' ? 'selected' : '' }}>Dark</option>
                            </select>
                        </div>

                        <!-- Saqlash Tugmasi -->
                        <button type="submit" class="btn btn-primary">Save Settings</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
