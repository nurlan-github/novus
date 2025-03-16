<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'eicsv') }} @hasSection('pageTitle') - @yield('pageTitle') @else @yield('title') @endif</title>
        <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    {{-- <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/fonts/bootstrap-icons-1.11.3/font/bootstrap-icons.css') }}">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="bg-light">
    <div id="app">
        <!-- Header -->
        <header id="header">
            <nav class="navbar navbar-expand-md bsb-navbar-3 navbar-light bg-white shadow-sm">
                <div class="container">
                    <ul class="navbar-nav">
                        <li class="nav-item me-3">
                            <a class="nav-link" href="{{ url('/') }}" data-bs-toggle="offcanvas"
                                data-bs-target="#bsbSidebar1" aria-controls="bsbSidebar1">
                                <i class="bi bi-grid fs-3 lh-1"></i>
                            </a>
                        </li>
                    </ul>
                    <a class="navbar-brand fw-bold  text-uppercase" href="{{ url('/') }}">
                        <x-logo />
                    </a>
                    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                        data-bs-target="#bsbNavbar" aria-controls="bsbNavbar" aria-label="Toggle Navigation">
                        <i class="bi bi-three-dots"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="bsbNavbar">
                        <x-dash-lang />
                    </div>
                </div>
            </nav>
        </header>
        <x-dash-sidebar />

        <!-- Main Content -->
        <main>
            <!-- Breadcrumb -->
            <x-dash-bread />
            <section class="pb-2 pb-md-3 pb-xl-4 bg-light">
                @yield('content')
            </section>
        </main>


        <!-- Footer -->
        <footer style="background-color: #f8f9fa; padding: 40px 20px; text-align: center;">
            <p class="text-uppercase fw-bold">© {{ config('app.name') }}</p>
            
        </footer>
    </div>
</body>

</html>
