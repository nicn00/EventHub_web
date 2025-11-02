@extends('layouts.admin')

@section('title', 'Manajemen Event')

@section('content')
    <a href="{{ route('admin.events.create') }}" class="btn btn-primary mb-3">Tambah Event Baru</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Gambar</th> <th>Nama Event</th>
                <th>Tanggal</th>
                <th>Lokasi</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
            <tr>
                <td>
                    @if($event->image)
                        <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}" style="width: 100px; height: auto;">
                    @else
                        <small>No Image</small>
                    @endif
                </td>
                <td>{{ $event->name }}</td>
                <td>{{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}</td>
                <td>{{ $event->location }}</td>
                <td>Rp {{ number_format($event->price) }}</td>
                <td>
                    <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection