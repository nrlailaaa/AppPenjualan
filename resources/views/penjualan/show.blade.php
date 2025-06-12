@extends('layouts.app')

@section('title', 'Detail Penjualan')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h5>Detail Penjualan</h5>
            <small>Informasi lengkap transaksi dan daftar barang</small>
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-md-6">
                    <p><strong>Pembeli:</strong> {{ $penjualan->pembeli->nama }}</p>
                    <p><strong>Kasir:</strong> {{ $penjualan->kasir->name }}</p>
                    <p><strong>Tanggal Pesanan:</strong> {{ $penjualan->tanggal_pesan }}</p>
                </div>
                <div class="col-md-6 text-end">
                    <h5>Total Harga: Rp {{ number_format($penjualan->details->sum('total_harga')) }}</h5>
                </div>
            </div>

            <h6>Daftar Barang</h6>
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Harga Satuan</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penjualan->details as $i => $detail)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $detail->barang->nama }}</td>
                        <td>Rp {{ number_format($detail->barang->harga) }}</td>
                        <td>{{ $detail->jumlah }}</td>
                        <td>Rp {{ number_format($detail->total_harga) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <a href="{{ route('penjualan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
        </div>
    </div>
</div>
@endsection
