@extends('layouts.app')

@section('title', 'Data Pembelian')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">Data Pembelian</h3>
        <div>
            <a href="{{ route('pembelian.create') }}" class="btn btn-success">+ Tambah Pembelian</a>
        </div>
    </div>

    {{-- Notifikasi --}}
    @if (session('success'))
    <script>
        toastr.success("{{ session('success') }}");
    </script>
    @endif

    {{-- Form Pencarian --}}
    <form method="GET" action="{{ route('pembelian.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari barang atau supplier..." value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit">Cari</button>
        </div>
    </form>

    {{-- Tabel --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 50px">No</th>
                        <th>Barang</th>
                        <th>Supplier</th>
                        <th>Jumlah</th>
                        <th>Tanggal</th>
                        <th style="width: 160px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pembelians as $pembelian)
                    <tr>
                        <td>{{ $loop->iteration + ($pembelians->currentPage() - 1) * $pembelians->perPage() }}</td>
                        <td>{{ $pembelian->barang->nama }}</td>
                        <td>{{ $pembelian->supplier->nama }}</td>
                        <td>{{ $pembelian->jumlah }}</td>
                        <td>{{ $pembelian->tanggal }}</td>
                        <td>
                            <a href="{{ route('pembelian.edit', $pembelian->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('pembelian.destroy', $pembelian->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin hapus?')" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Tidak ada data pembelian.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $pembelians->onEachSide(1)->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
