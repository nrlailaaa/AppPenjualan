@extends('layouts.app')

@section('title', 'Kategori')

@section('content')
<style>
    .kategori-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        border-radius: 1rem;
    }
    .kategori-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }
    .kategori-card .card-title {
        color: #20c997; 
        font-weight: 600;
    }
    .btn-outline-warning {
        color: #20c997;
        border-color: #20c997;
    }
    .btn-outline-warning:hover {
        background-color: #20c997;
        color: #fff;
        border-color: #20c997;
    }
</style>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Daftar Kategori</h3>
        <div>
            <a href="{{ route('kategori.create') }}" class="btn btn-success">+ Tambah Kategori</a>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary ms-2">Dashboard</a>
        </div>
    </div>

    @if (session('success'))
    <script>
        toastr.success("{{ session('success') }}");
    </script>
    @endif

    <div class="row justify-content-center">
        @forelse ($kategoris as $kategori)
        <div class="col-12 col-md-6 col-lg-4 mb-4">
            <div class="card kategori-card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <h4 class="card-title mb-3">{{ $kategori->nama }}</h4>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-outline-warning">Edit</a>
                        <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin hapus?')" class="btn btn-outline-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-secondary text-center">Tidak ada kategori.</div>
        </div>
        @endforelse
    </div>
</div>
@endsection
