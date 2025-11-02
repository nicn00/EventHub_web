@extends('layouts.public')

@section('title', 'Profil Saya')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            @if (session('status') === 'profile-updated')
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Profil berhasil diperbarui.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Informasi Profil</h3>
                </div>
                <div class="card-body">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="card card-primary card-outline mt-4">
                <div class="card-header">
                    <h3 class="card-title">Ubah Password</h3>
                </div>
                <div class="card-body">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="card card-danger card-outline mt-4">
                <div class="card-header">
                    <h3 class="card-title">Hapus Akun</h3>
                </div>
                <div class="card-body">
                    <p class="text-muted">Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Silakan unduh data apa pun yang ingin Anda simpan.</p>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</div>
@endsection