@extends('layouts.public')

@section('title', 'Beranda - EventHub')

@section('content')
<!-- Hero Section -->
<section class="content-header text-center py-5 bg-primary text-white">
    <div class="container">
        <h1 class="display-4 fw-bold mb-3">
            Selamat Datang di <span class="text-warning">EventHub</span>
        </h1>
        <p class="lead mb-4">
            Platform e-ticketing yang memudahkan Anda menemukan dan mengikuti berbagai event menarik.
        </p>

        @guest
            <a href="{{ route('login') }}" class="btn btn-light btn-lg me-2 shadow-sm">
                <i class="fas fa-sign-in-alt me-1"></i> Login
            </a>
            <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg shadow-sm">
                <i class="fas fa-user-plus me-1"></i> Register
            </a>
        @else
            <a href="{{ route('dashboard') }}" class="btn btn-warning btn-lg shadow-sm">
                <i class="fas fa-tachometer-alt me-1"></i> Dashboard
            </a>
        @endguest
    </div>
</section>

<!-- About / Description Section -->
<section class="content mt-5">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-md-8 offset-md-2">
                <h2 class="fw-bold mb-3">Tentang EventHub</h2>
                <p class="text-muted">
                    EventHub menyediakan sistem manajemen event yang mudah digunakan untuk penyelenggara dan pengguna.
                    Dapatkan kemudahan dalam pembuatan, pengelolaan, dan pembelian tiket secara online.
                </p>
            </div>
        </div>

        <!-- Card Section -->
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <i class="fas fa-calendar-check fa-3x text-primary mb-3"></i>
                        <h5 class="fw-bold">Buat Event</h5>
                        <p class="text-muted small">Penyelenggara dapat membuat dan mengatur event dengan mudah.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <i class="fas fa-ticket-alt fa-3x text-success mb-3"></i>
                        <h5 class="fw-bold">Beli Tiket</h5>
                        <p class="text-muted small">Pengguna dapat membeli tiket secara online dengan aman dan cepat.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <i class="fas fa-users fa-3x text-warning mb-3"></i>
                        <h5 class="fw-bold">Nikmati Event</h5>
                        <p class="text-muted small">Ikuti berbagai acara menarik dan dapatkan pengalaman tak terlupakan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Optional Event List -->
@if(isset($events) && count($events) > 0)
<section class="content mt-5 mb-5">
    <div class="container">
        <h3 class="fw-bold text-center mb-4">Event Terbaru</h3>
        <div class="row g-4">
            @foreach($events as $event)
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100">
                        <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top" alt="{{ $event->title }}">
                        <div class="card-body">
                            <h5 class="fw-bold">{{ $event->title }}</h5>
                            <p class="text-muted small mb-1">
                                <i class="fas fa-map-marker-alt me-1"></i> {{ $event->location }}
                            </p>
                            <p class="text-muted small">
                                <i class="fas fa-calendar-day me-1"></i> {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}
                            </p>
                            <a href="{{ route('events.show', $event->id) }}" class="btn btn-sm btn-outline-primary mt-2">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Footer -->
<footer class="text-center py-4 bg-dark text-white mt-5">
    <p class="mb-0">© {{ date('Y') }} EventHub. All Rights Reserved.</p>
</footer>
@endsection
