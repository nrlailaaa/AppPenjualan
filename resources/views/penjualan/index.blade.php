@extends('layouts.app')

@section('title', 'Data Penjualan')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h4 class="fw-bold">Data Penjualan</h4>
        <div>
            <a href="{{ route('penjualan.create') }}" class="btn btn-success">+ Tambah Penjualan</a>
            <a href="{{ route('penjualan.cetakpdf') }}" target="_blank" class="btn btn-danger ms-2">Download PDF</a>
        </div>
    </div>

    <form method="GET" class="row g-3 mb-3">
    <div class="col-md-3">
        <label for="tgl_awal" class="form-label fw-semibold">Tanggal Awal</label>
        <input type="date" id="tgl_awal" name="tgl_awal" class="form-control" value="{{ request('tgl_awal') }}">
    </div>
    <div class="col-md-3">
        <label for="tgl_akhir" class="form-label fw-semibold">Tanggal Akhir</label>
        <input type="date" id="tgl_akhir" name="tgl_akhir" class="form-control" value="{{ request('tgl_akhir') }}">
    </div>
    <div class="col-md-3">
        <label for="pembeli" class="form-label fw-semibold">Pembeli</label>
        <input type="text" id="pembeli" name="pembeli" class="form-control" placeholder="Cari pembeli..." value="{{ request('pembeli') }}">
    </div>
    <div class="col-md-3 d-flex align-items-end">
        <button type="submit" class="btn btn-outline-primary me-2">Cari</button>
        <a href="{{ route('penjualan.index') }}" class="btn btn-outline-secondary">Reset</a>
    </div>
    </form>

    @if (session('success'))
    <script>
        toastr.success("{{ session('success') }}");
    </script>
    @endif

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Pembeli</th>
                        <th>Kasir</th>
                        <th>Tanggal Pesanan</th>
                        <th>Total Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($penjualans as $no => $penjualan)
                        <tr>
                            <td>{{ $penjualans->firstItem() + $no }}</td>
                            <td>{{ $penjualan->pembeli->nama }}</td>
                            <td>{{ $penjualan->kasir->name }}</td>
                            <td>{{ $penjualan->tanggal_pesan }}</td>
                            <td>
                                Rp {{ number_format($penjualan->details->sum(function($detail) {
                                    return $detail->jumlah * $detail->barang->harga;
                                }), 0, ',', '.') }}
                            </td>
                            <td>
                                <a href="{{ route('penjualan.show', $penjualan->id) }}" class="btn btn-sm btn-info">Detail</a>
                                <a href="{{ route('penjualan.cetakdetail', ['id' => $penjualan->id]) }}" class="btn btn-sm btn-success" target="_blank">Print</a>
                                <form action="{{ route('penjualan.destroy', $penjualan->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Yakin hapus?')" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Tidak ada data penjualan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $penjualans->onEachSide(1)->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection
