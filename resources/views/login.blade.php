@extends('layout')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">Login LabLoan</div>
            <div class="card-body text-center">
                <p>Selamat datang di Sistem Peminjaman Lab.</p>
                <p>Silakan login untuk melanjutkan.</p>
                
                <a href="/debug-login" class="btn btn-lg btn-success">
                    Masuk sebagai User Test
                </a>
                
                <p class="text-muted mt-3 small">
                    (Ini adalah tombol login simulasi untuk testing)
                </p>
            </div>
        </div>
    </div>
</div>
@endsection