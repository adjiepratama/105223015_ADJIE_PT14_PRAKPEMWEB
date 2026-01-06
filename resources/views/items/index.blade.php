@extends('layout')

@section('content')
<div class="card">
    <div class="card-header bg-white">
        <h4>Daftar Inventaris Lab</h4>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Nama Barang</th>
                    <th>Kategori</th> <th>Deskripsi</th>
                    <th>Sisa Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    
                    <td>
                        <span class="badge bg-info text-dark">
                            {{ $item->category->name ?? 'Tanpa Kategori' }}
                        </span>
                    </td>

                    <td>{{ $item->description }}</td>
                    <td>
                        <span class="badge {{ $item->stock > 0 ? 'text-bg-success' : 'text-bg-danger' }}">
                            {{ $item->stock }} Unit
                        </span>
                    </td>
                    <td>
                        @if($item->stock > 0)
                            <form action="{{ route('loan.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="item_id" value="{{ $item->id }}">
                                <button type="submit" class="btn btn-sm btn-primary">Pinjam</button>
                            </form>
                        @else
                            <button class="btn btn-sm btn-secondary" disabled>Habis</button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection