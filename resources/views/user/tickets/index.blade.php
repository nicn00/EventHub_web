@extends('layouts.public')

@section('title', 'Tiket Saya ')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Daftar Tiket Anda</h3>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">

                        @forelse($myTickets as $ticket)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="font-weight-bold mb-1">{{ $ticket->event->name }}</h5>
                                    <p class="mb-1 text-muted" style="font-size: 0.9rem;">
                                        {{ $ticket->event->location }} - 
                                        {{ \Carbon\Carbon::parse($ticket->event->date)->format('d F Y') }}
                                    </p>
                                    <p class="mb-0">
                                        Kode Tiket: <strong class="text-danger">{{ $ticket->ticket_code }}</strong>
                                    </p>
                                </div>
    
                                <div>
                                    <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin membatalkan tiket ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Batalkan</button>
                                    </form>
                                </div>
                            </li>
                        @empty
                            <li class="list-group-item text-center">
                                <p>Anda belum memiliki tiket.</p>
                                <a href="{{ route('home') }}" class="btn btn-primary btn-sm">Cari Event Sekarang</a>
                            </li>
                        @endforelse
                        
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection