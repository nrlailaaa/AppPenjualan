@extends('layouts.app')

@section('title', 'Edit Supplier')

@section('content')
<div class="container mt-4">
    <h3 class="fw-bold mb-4">Edit Supplier</h3>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('supplier.update', $supplier->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Supplier</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama', $supplier->nama) }}" required>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" required>{{ old('alamat', $supplier->alamat) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="kodepos" class="form-label">Kode Pos</label>
                    <input type="text" name="kodepos" class="form-control" value="{{ old('kodepos', $supplier->kodepos) }}" maxlength="5" required>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('supplier.index') }}" class="btn btn-secondary ms-2">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection




