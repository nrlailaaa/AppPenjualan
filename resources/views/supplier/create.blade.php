@extends('layouts.app')

@section('title', 'Tambah Supplier')

@section('content')
<div class="container mt-4">
    <h3 class="fw-bold mb-4">Tambah Supplier</h3>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('supplier.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Supplier</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" required>{{ old('alamat') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="kodepos" class="form-label">Kode Pos</label>
                    <input type="text" name="kodepos" class="form-control" value="{{ old('kodepos') }}" maxlength="5" required>
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('supplier.index') }}" class="btn btn-secondary ms-2">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection

