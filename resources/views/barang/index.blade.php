@extends('layouts.app')

@section('title', 'Data Barang')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">Daftar Barang</h3>
        <div>
            <a href="{{ route('barang.create') }}" class="btn btn-success">+ Tambah Barang</a>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary ms-2">Dashboard</a>
        </div>
    </div>

    @if (session('success'))
    <script>
        toastr.success("{{ session('success') }}");
    </script>
    @endif

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @forelse ($barangs as $barang)
        <div class="col">
            <div class="card h-100 shadow-sm">
                <div class="position-relative" style="height: 200px; overflow: hidden;">
                    <img src="{{ asset('storage/' . $barang->gambar) }}" alt="{{ $barang->nama }}" class="card-img-top w-100 h-100 object-fit-cover">
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $barang->nama }}</h5>
                    <p class="card-text">
                        <strong>Kategori:</strong> {{ $barang->kategori->nama }}<br>
                        <strong>Stok:</strong> {{ $barang->stok }}<br>
                        <strong>Harga:</strong> {{ $barang->harga }}<br>
                    </p>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin hapus?')" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-warning text-center">Tidak ada barang.</div>
        </div>
        @endforelse
    </div>
</div>
@endsection


