@extends('layout')

@section('content')
<div class="card">
    <div class="card-header bg-white">
        <h4>Riwayat Peminjaman Saya</h4>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Barang</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($loans as $loan)
                <tr>
                    <td>{{ $loan->item->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($loan->loan_date)->format('d M Y') }}</td>
                    <td>
                        @if($loan->return_date)
                            {{ \Carbon\Carbon::parse($loan->return_date)->format('d M Y') }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if($loan->status == 'borrowed')
                            <span class="badge bg-warning text-dark">Sedang Dipinjam</span>
                        @else
                            <span class="badge bg-success">Sudah Dikembalikan</span>
                        @endif
                    </td>
                    <td>
                        @if($loan->status == 'borrowed')
                            <form action="{{ route('loan.return', $loan->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    Kembalikan
                                </button>
                            </form>
                        @else
                            <span class="text-muted small">Selesai</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada data peminjaman.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection