@extends('layouts.app')

@section('pageTitle', Auth::user()->name)

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg-white shadow">
                    <div class="card-header">
                        <!-- Salomlashuv matni -->
                        <h3>Salom, {{ $user->name }}!</h3>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <!-- Foydalanuvchi ma'lumotlari -->
                        <p><strong><x-key-translate key="email" />:</strong> {{ $user->email }}</p>

                        <!-- Rol haqida ma'lumot -->
                        @if ($user->roles)
                            <p><strong><x-key-translate key="roles" />:</strong>
                                @foreach ($user->roles as $role)
                                    <span class="badge bg-primary">{{ $role->name }}</span>
                                @endforeach
                            </p>
                        @endif

                    </div>
                </div>
                <!-- Naviqatsiya menyusi -->
                <div class="mt-3">
                    <h5><x-key-translate key="navigation" />:</h5>
                    <ul class="list-group">
                        <a class="text-decoration-none rounded shadow mb-2" href="{{ route('profile.edit') }}">
                            <li class="list-group-item  bg-white">
                                <i class="bi bi-person"></i>
                                <x-key-translate key="edit_profile" /></li>
                        </a>
                        <a class="text-decoration-none rounded shadow mb-2" href="{{ route('settings.index') }}">
                            <li class="list-group-item  bg-white">
                                <i class="bi bi-gear"></i>
                                <x-key-translate key="settings" /> </li>
                        </a>
                        <a class="text-decoration-none rounded shadow mb-2" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <li class="list-group-item  bg-white">
                                <i class="bi bi-box-arrow-right"></i>
                                <x-key-translate key="logout" />
                            </li>
                        </a>
                    </ul>
                </div>

                <!-- Logout Form -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
@endsection
