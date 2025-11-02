@extends('layouts.public')

@section('content')
    <div class="row">
        <div class="col-md-8">
            @if($event->image)
                <img src="{{ asset('storage/' . $event->image) }}" class="img-fluid rounded mb-3" alt="{{ $event->name }}">
            @endif

            <h2>{{ $event->name }}</h2>
            <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($event->date)->format('d F Y') }}</TANGGAL></p>
            <p><strong>Lokasi:</strong> {{ $event->location }}</p>
            <hr>
            <h4>Deskripsi</h4>
            <p>{!! nl2br(e($event->description)) !!}</p> </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Beli Tiket</h5>
                    <p class="card-text">Harga:</p>
                    <h3 class="text-danger">Rp {{ number_format($event->price) }}</h3>
                    
                    <form action="{{ route('tickets.buy', $event->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary w-100">Beli Tiket Sekarang</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
@endsection