<section class="py-3 py-md-4 py-xl-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <nav style="--bs-breadcrumb-divider: url(&quot;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&quot;);"
                        aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/home" class="fw-bold text-decoration-none">
                                    <i class="bi bi-house-door me-2"></i> <x-key-translate key="home" />
                                    {{-- <i class="bi bi-house-door me-2"></i>{{ config('app.name') }} --}}
                                </a>
                            </li>
                            @hasSection('model')
                                @yield('model', 'Model Name')
                            @endif
                            <li class="breadcrumb-item active" aria-current="page">@yield('pageTitle')</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
