@extends('layouts.app')

@section('title', 'Daftar Supplier')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">Daftar Supplier</h3>
        <div>
            <a href="{{ route('supplier.create') }}" class="btn btn-success">+ Tambah Supplier</a>
        </div>
    </div>

    @if (session('success'))
    <script>
        toastr.success("{{ session('success') }}");
    </script>
    @endif

    {{-- Form Search --}}
    <form method="GET" action="{{ route('supplier.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari nama/alamat/kodepos..." value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit">Cari</button>
        </div>
    </form>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 50px">No</th>
                        <th>Nama Supplier</th>
                        <th>Alamat</th>
                        <th>KodePos</th>
                        <th style="width: 160px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($suppliers as $supplier)
                    <tr>
                        <td>{{ $loop->iteration + ($suppliers->currentPage() - 1) * $suppliers->perPage() }}</td>
                        <td>{{ $supplier->nama }}</td>
                        <td>{{ $supplier->alamat }}</td>
                        <td>{{ $supplier->kodepos }}</td>
                        <td>
                            <a href="{{ route('supplier.edit', $supplier->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('supplier.destroy', $supplier->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin hapus?')" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Tidak ada supplier.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $suppliers->onEachSide(1)->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
