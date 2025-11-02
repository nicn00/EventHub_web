@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-lg-4 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalEvents }}</h3>
                    <p>Total Event Aktif</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $totalTicketsSold }}</h3>
                    <p>Total Tiket Terjual</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $totalUsers }}</h3>
                    <p>Total Pengguna (User)</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">10 Event Terlaris</h3>
        </div>
        <div class="card-body">
            <canvas id="salesChart"></canvas>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('salesChart');
    new Chart(ctx, {
        type: 'bar',
        data: {
            // Data 'labels' dari controller
            labels: {!! json_encode($chartLabels) !!},
            datasets: [{
                label: '# Tiket Terjual',
                // Data 'data' dari controller
                data: {!! json_encode($chartData) !!},
                backgroundColor: 'rgba(0, 123, 255, 0.7)',
            }]
        },
        options: {
            scales: { y: { beginAtZero: true } }
        }
    });
</script>
@endsection