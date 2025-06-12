@extends('layouts.app')

@section('title', 'Data Pembeli')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">Daftar Pembeli</h3>
        <div>
            <a href="{{ route('pembeli.create') }}" class="btn btn-success">+ Tambah Pembeli</a>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary ms-2">Dashboard</a>
        </div>
    </div>

    @if (session('success'))
    <script>
        toastr.success("{{ session('success') }}");
    </script>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 50px">No</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>No HP</th>
                        <th style="width: 160px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pembelis as $row)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $row->nama }}</td>
                        <td>{{ $row->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                        <td>{{ $row->alamat }}</td>
                        <td>{{ $row->nohp }}</td>
                        <td>
                            <a href="{{ route('pembeli.edit', $row->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('pembeli.destroy', $row->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin hapus?')" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Tidak ada pembeli.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
