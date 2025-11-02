@extends('layouts.public')

@section('content')
    <h1 class="mb-4">Daftar Event Mendatang</h1>
    
    <form action="{{ route('home') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari nama event..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Cari</button>
        </div>
    </form>

    <div class="row">
        @forelse($events as $event)
            <div class="col-md-4 mb-4">
    <div class="card h-100">
        @if($event->image)
            <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top" alt="{{ $event->name }}">
        @else
            <img src="https://via.placeholder.com/300x200.png?text=No+Image" class="card-img-top" alt="No Image">
        @endif
        <div class="card-body">
            <h5 class="card-title">{{ $event->name }}</h5>
                        <p class="card-text"><small class="text-muted">{{ $event->location }}</small></p>
                        <p class="card-text">{{ \Carbon\Carbon::parse($event->date)->format('d F Y') }}</p>
                        <h6 class="card-subtitle mb-2 text-danger">Rp {{ number_format($event->price) }}</h6>
                        <a href="{{ route('events.show', $event->id) }}" class="btn btn-outline-primary">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @empty
            <p>Tidak ada event yang ditemukan.</p>
        @endforelse
    </div>

    {{ $events->links() }}
@endsection