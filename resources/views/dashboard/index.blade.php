@extends('layouts.app')

@section('pageTitle')
    <x-key-translate key="dashboard" />
@endsection

@section('content')
    <div class="container">
        @can('show_dashboard')
            @if(!session('welcome_alert_dismissed'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <h4 class="alert-heading">Xush kelibsiz!</h4>
                    <p>Ushbu panel orqali siz tizimga kirishingiz mumkin.</p>
                    <hr>
                    <p class="mb-0">Sizda quyidagi ruxsatlar mavjud:</p>
                    <ul>
                        @can('show_roles')
                            <li>Rollar ro'yxati</li>
                        @endcan
                        @can('show_permissions')
                            <li>Ruxsatnomalar ro'yxati</li>
                        @endcan
                        @can('show_languages')
                            <li>Tillar ro'yxati</li>
                        @endcan
                        @can('show_keys')
                            <li>Kalit so'zlarni tarjima qilish</li>
                        @endcan
                        @can('show_categories')
                            <li>Bo'limlar ro'yxati</li>
                        @endcan
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="dismissWelcomeAlert()"></button>
                </div>
            @endif
        @endcan

        @can('admin_access')
        {{-- <h3>Asosiy qism</h3> --}}
        <div class="row">
            @can('show_roles')
                <!-- Rollar -->
                <div class="col-md-3 my-2">
                    <a href="{{ route('roles.index') }}" class="text-decoration-none text-dark">
                        <div class="card text-center shadow-sm border-0">
                            <div class="card-body">
                                <i class="bi bi-person-rolodex fs-1 text-primary"></i>
                                <h5 class="card-title mt-2"><x-key-translate key="roles" /></h5>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan

            @can('show_permissions')
                <!-- Ruxsatnomalar -->
                <div class="col-md-3 my-2">
                    <a href="{{ route('permissions.index') }}" class="text-decoration-none text-dark">
                        <div class="card text-center shadow-sm border-0">
                            <div class="card-body">
                                <i class="bi bi-ui-checks fs-1 text-success"></i>
                                <h5 class="card-title mt-2"><x-key-translate key="permissions" /></h5>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan

            @can('show_users')
                <!-- Foydalanuvchilar -->
                <div class="col-md-3 my-2">
                    <a href="{{ route('users.index') }}" class="text-decoration-none text-dark">
                        <div class="card text-center shadow-sm border-0">
                            <div class="card-body">
                                <i class="bi bi-people fs-1 text-primary"></i>
                                <h5 class="card-title mt-2"><x-key-translate key="users" /></h5>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan

            @can('show_settings')
                <!-- Sozlamalar -->
                <div class="col-md-3 my-2">
                    <a href="{{ route('settings.index') }}" class="text-decoration-none text-dark">
                        <div class="card text-center shadow-sm border-0">
                            <div class="card-body">
                                <i class="bi bi-gear fs-1 text-success"></i>
                                <h5 class="card-title mt-2"><x-key-translate key="settings" /></h5>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
        </div>
        @endcan

        <section class="mt-4">
            {{-- <h3>Tajimalar uchun</h3> --}}
            <div class="row">

                @can('show_languages')
                    <!-- Tillar -->
                    <div class="col-md-3 my-2">
                        <a href="{{ route('languages.index') }}" class="text-decoration-none text-dark">
                            <div class="card text-center shadow-sm border-0">
                                <div class="card-body">
                                    <i class="bi bi-translate fs-1 text-warning"></i>
                                    <h5 class="card-title mt-2"><x-key-translate key="languages" /></h5>
                                </div>
                            </div>
                        </a>
                    </div>
                @endcan

                @can('show_keys')
                    <!-- Kalit so'zlarni tarjima qilish -->
                    <div class="col-md-3 my-2">
                        <a href="{{ route('keys.index') }}" class="text-decoration-none text-dark">
                            <div class="card text-center shadow-sm border-0">
                                <div class="card-body">
                                    <i class="bi bi-file-text fs-1 text-danger"></i>
                                    <h5 class="card-title mt-2"><x-key-translate key="keys" /></h5>
                                </div>
                            </div>
                        </a>
                    </div>
                @endcan

                @can('show_categories')
                    <!-- Bo'limlar ro'yxati -->
                    <div class="col-md-3 my-2">
                        <a href="{{ route('categories.index') }}" class="text-decoration-none text-dark">
                            <div class="card text-center shadow-sm border-0">
                                <div class="card-body">
                                    <i class="bi bi-folder fs-1 text-info"></i>
                                    <h5 class="card-title mt-2"><x-key-translate key="categories" /></h5>
                                </div>
                            </div>
                        </a>
                    </div>
                @endcan


            </div>
        </section>
    </div>

    <script>
        function dismissWelcomeAlert() {
            fetch('{{ route('dashboard.dismiss-welcome-alert') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({})
            });
        }
    </script>
@endsection
