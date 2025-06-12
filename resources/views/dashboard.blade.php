@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="card shadow-lg border-0 rounded-4 p-4 mb-4" style="background: linear-gradient(135deg, #a0d6b4 0%, #e0f7f1 100%);">
    <div class="text-center mb-4">
        <img src="{{ asset('storage/images/Seventeen.png') }}" alt="Seventeen Carat" width="130" class="mb-3" style="border-radius: 25px; box-shadow: 0 0 12px rgba(0,0,0,0.1);">
        <h2 class="card-title fw-bold text-glow mb-2">Halo, {{ Auth::user()->name }}!</h2>
    </div>
    <div class="px-3">
        <p class="lead text-center welcome-text">
            Selamat datang di <strong class="text-gradient">MLXVII</strong> 🌟<br>
            Aplikasi cerdas untuk mengelola <span class="fw-semibold">kategori</span>, <span class="fw-semibold">barang</span>, dan <span class="fw-semibold">transaksi</span> Sepatu.
        </p>
        <p class="text-center fst-italic quote-text">
            <em>“Walk like a star, shine like Seventeen”</em> 💎
        </p>
    </div>
</div>

<div class="row mt-4">
    <!-- Transaksi hari ini -->
    <div class="col-md-3">
        <div class="card mb-3 fade-in-delay-1">
            <div class="row g-0">
                <div class="col-md-4 d-flex justify-content-center align-items-center">
                    <h1 class="display-3 text-success" style="opacity: 0.8;">
                        <i class="fa-solid fa-sack-dollar"></i>
                    </h1>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h4 class="card-title text-success fw-bold mb-1">
                            Rp. {{ number_format($rupiahhariini, 0, '.', '.') }}
                        </h4>
                        <p class="card-text text-secondary mb-0">
                            Transaksi hari ini
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Barang terjual -->
    <div class="col-md-3">
        <div class="card mb-3 fade-in-delay-2">
            <div class="row g-0">
                <div class="col-md-4 d-flex justify-content-center align-items-center">
                    <h1 class="display-3 text-primary" style="opacity: 0.8;">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </h1>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h4 class="card-title text-primary fw-bold mb-1">
                            {{ $baranghariini }}
                        </h4>
                        <p class="card-text text-secondary mb-0">
                            Barang terjual
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Barang masuk -->
    <div class="col-md-3">
        <div class="card mb-3 fade-in-delay-3">
            <div class="row g-0">
                <div class="col-md-4 d-flex justify-content-center align-items-center">
                    <h1 class="display-3" style="color: #9d4edd; opacity: 0.8;">
                        <i class="fa-solid fa-inbox"></i>
                    </h1>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h4 class="card-title fw-bold mb-1" style="color: #3c096c;">
                            {{ $barangmasuk }}
                        </h4>
                        <p class="card-text text-secondary mb-0">
                            Barang masuk
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jumlah transaksi -->
    <div class="col-md-3">
        <div class="card mb-3 fade-in-delay-4">
            <div class="row g-0">
                <div class="col-md-4 d-flex justify-content-center align-items-center">
                    <h1 class="display-3" style="color: #8b5e34; opacity: 0.8;">
                        <i class="fa-solid fa-dolly"></i>
                    </h1>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h4 class="card-title fw-bold mb-1" style="color: #603808;">
                            {{ $jumlahtransaksi }}
                        </h4>
                        <p class="card-text text-secondary mb-0">
                            Jumlah transaksi
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tabel stok minim -->
<div class="row">
    <div class="col-md-12">
        <div class="card mt-4 fade-in-delay-5">
            <div class="card-header bg-light">
                <h5 class="mb-0 text-dark">📦 Daftar Barang Stok Minim</h5>
            </div>
            <div class="card-body">
                <table class="table table-hover table-condensed">
                    <thead class="table-success text-center">
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Gambar</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse ($barang as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->kategori->nama }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>Rp. {{ number_format($item->harga, 0, '.', '.') }}</td>
                            <td>{{ $item->stok }}</td>
                            <td><img src="{{ asset('storage/' . $item->gambar) }}" width="90" alt="Gambar Barang" class="img-thumbnail rounded"></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Tidak ada data!</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Animasi Style -->
<style>
    .text-glow {
        font-size: 2rem;
        color: #2d9c84;
        text-shadow: 0 0 5px rgba(45, 156, 132, 0.5), 0 0 10px rgba(45, 156, 132, 0.3);
    }

    .text-gradient {
        background: linear-gradient(to right, #1abc9c, #16a085);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: bold;
    }

    .welcome-text {
        color: #3b7a68;
        font-size: 1.15rem;
        animation: fadeInUp 1s ease forwards;
        opacity: 0;
        transform: translateY(10px);
        animation-delay: 0.3s;
    }

    .quote-text {
        color: #4a7c74;
        font-size: 1.05rem;
        opacity: 0;
        transform: translateY(10px);
        animation: fadeInUp 1s ease forwards;
        animation-delay: 0.6s;
    }

    .fade-in-delay-1,
    .fade-in-delay-2,
    .fade-in-delay-3,
    .fade-in-delay-4,
    .fade-in-delay-5 {
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 0.8s forwards;
    }

    .fade-in-delay-1 { animation-delay: 0.2s; }
    .fade-in-delay-2 { animation-delay: 0.4s; }
    .fade-in-delay-3 { animation-delay: 0.6s; }
    .fade-in-delay-4 { animation-delay: 0.8s; }
    .fade-in-delay-5 { animation-delay: 1s; }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endsection
