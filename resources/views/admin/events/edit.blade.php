@extends('layouts.admin')
@section('title', 'Edit Event')

@section('content')
<form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label>Nama Event</label>
        <input type="text" name="name" class="form-control" value="{{ $event->name }}" required>
    </div>

    <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="description" class="form-control" rows="4" required>{{ $event->description }}</textarea>
    </div>

    <div class="form-group">
        <label>Tanggal</label>
        <input type="date" name="date" class="form-control" value="{{ $event->date }}" required>
    </div>

    <div class="form-group">
        <label>Lokasi</label>
        <input type="text" name="location" class="form-control" value="{{ $event->location }}" required>
    </div>

    <div class="form-group">
        <label>Harga Tiket</label>
        <input type="number" name="price" class="form-control" value="{{ $event->price }}" required>
    </div>

    <div class="form-group">
        <label>Poster Event</label><br>
        @if($event->image)
            <img src="{{ asset('storage/'.$event->image) }}" alt="Poster" width="150" class="mb-2 rounded">
        @endif
        <input type="file" name="image" class="form-control-file">
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
