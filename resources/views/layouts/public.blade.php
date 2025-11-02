@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'EventHub')</title>

    <!-- AdminLTE & Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
        }

        /* Navbar styling */
        .navbar-custom {
            background-color: #001f3f;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.3rem;
        }

        .navbar-custom .nav-link {
            color: #fff !important;
            font-weight: 500;
        }

        .navbar-custom .nav-link:hover {
            color: #ffc107 !important;
        }

        /* Footer */
        footer {
            background-color: #001f3f;
            color: #fff;
            font-size: 0.9rem;
            letter-spacing: 0.3px;
        }

        footer a {
            color: #ffc107;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        /* Card hover effect */
        .card:hover {
            transform: translateY(-3px);
            transition: all 0.2s ease-in-out;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        }
    </style>

    @stack('styles')
</head>
<body class="hold-transition layout-top-nav">

<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-custom shadow-sm">
        <div class="container">
            <a href="{{ url('/') }}" class="navbar-brand text-white">
                <i class="fas fa-ticket-alt text-warning me-1"></i> EventHub
            </a>

            <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <i class="fas fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <!-- Left navbar links -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link {{ Request::is('/') ? 'text-warning' : '' }}">
                            <i class="fas fa-home me-1"></i> Beranda
                        </a>
                    </li>
                    
                    @guest
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link">
                                <i class="fas fa-sign-in-alt me-1"></i> Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="nav-link">
                                <i class="fas fa-user-plus me-1"></i> Register
                            </a>
                        </li>
                    @else
                        @if(Auth::user()->role == 'admin')
                            <li class="nav-item">
                                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Request::is('admin*') ? 'text-warning' : '' }}">
                                    <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('calendar.index') }}" class="nav-link {{ Request::is('my-calendar*') ? 'text-warning' : '' }}">
                                    <i class="fas fa-calendar-alt me-1"></i> Kalender Saya
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('tickets.index') }}" class="nav-link {{ Request::is('my-tickets*') ? 'text-warning' : '' }}">
                                    <i class="fas fa-ticket-alt me-1"></i> Tiket Saya
                                </a>
                            </li>
                        @endif

                        <li class="nav-item">
                            <a href="{{ route('profile.edit') }}" class="nav-link {{ Request::is('profile*') ? 'text-warning' : '' }}">
                                <i class="fas fa-user-circle me-1"></i> Profil
                            </a>
                        </li>

                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="nav-link bg-transparent border-0 text-white" style="padding-top: 8px; padding-bottom: 8px; cursor: pointer;">
                                    <i class="fas fa-sign-out-alt me-1"></i> Logout
                                </button>
                            </form>
                        </li>
    
                        @endguest
                </ul>
            </div>
        </div>
    </nav>
    <!-- /.navbar -->

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <div class="content">
            @yield('content')
        </div>
    </div>
    <!-- /.content-wrapper -->

    <!-- Footer -->
    <footer class="text-center py-3 mt-5">
        <div class="container">
            <p class="mb-1">
                © {{ date('Y') }} <strong>EventHub</strong>. All Rights Reserved.
            </p>
            <p class="mb-0">
                <a href="https://adminlte.io" target="_blank">Powered by AdminLTE</a>
            </p>
        </div>
    </footer>
</div>

<!-- AdminLTE & Bootstrap JS -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>

@stack('scripts')
</body>
</html>
