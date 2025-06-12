@extends('layouts.app')

@section('title', 'Tambah Penjualan')

@section('content')
<div class="container">
    <h3 class="fw-bold mb-4">Tambah Penjualan</h3>

    {{-- Tampilkan error jika ada --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan!</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('penjualan.store') }}" method="POST">
        @csrf

        {{-- Pembeli --}}
        <div class="mb-3">
            <label for="pembeli_id" class="form-label">Pembeli</label>
            <select name="pembeli_id" class="form-select @error('pembeli_id') is-invalid @enderror" required>
                <option value="">-- Pilih Pembeli --</option>
                @foreach ($pembelis as $pembeli)
                    <option value="{{ $pembeli->id }}" {{ old('pembeli_id') == $pembeli->id ? 'selected' : '' }}>
                        {{ $pembeli->nama }}
                    </option>
                @endforeach
            </select>
            @error('pembeli_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- Kasir --}}
        <div class="mb-3">
            <label for="kasir_id" class="form-label">Kasir</label>
            <select name="kasir_id" class="form-select @error('kasir_id') is-invalid @enderror" required>
                <option value="">-- Pilih Kasir --</option>
                @foreach ($kasirs as $kasir)
                    <option value="{{ $kasir->id }}" {{ old('kasir_id') == $kasir->id ? 'selected' : '' }}>
                        {{ $kasir->name }}
                    </option>
                @endforeach
            </select>
            @error('kasir_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- Tanggal --}}
        <div class="mb-3">
            <label class="form-label">Tanggal Pesan</label>
            <input type="date" name="tanggal_pesan" class="form-control @error('tanggal_pesan') is-invalid @enderror" 
                   value="{{ old('tanggal_pesan') }}" required>
            @error('tanggal_pesan')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- Pilih Barang --}}
        <div class="mb-3">
            <label class="form-label">Barang</label>
            <div class="row mb-2">
                <div class="col-md-6">
                    <select id="barang_id" class="form-select">
                        <option value="">-- Pilih Barang --</option>
                        @foreach ($barangs as $barang)
                            <option value="{{ $barang->id }}" data-harga="{{ $barang->harga }}">
                                {{ $barang->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="number" id="jumlah" class="form-control" placeholder="Jumlah">
                </div>
                <div class="col-md-3">
                    <button type="button" class="btn btn-secondary w-100" id="tambahBarang">Tambah</button>
                </div>
            </div>
        </div>

        {{-- Tabel Barang --}}
        <table class="table table-bordered" id="tabelBarang">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

        <input type="hidden" name="detail_penjualan" id="detail_penjualan">

        {{-- Total Harga --}}
        <div class="mb-3">
            <label class="form-label">Total Harga</label>
            <h4 id="totalHarga">Rp. 0</h4>
        </div>

        {{-- Bayar --}}
        <div class="mb-3">
            <label for="bayar" class="form-label">Bayar</label>
            <input type="number" id="bayar" class="form-control">
        </div>

        {{-- Kembalian --}}
        <div class="mb-3">
            <label class="form-label">Kembalian</label>
            <h4 id="kembalian">Rp. 0</h4>
        </div>

        {{-- Tombol --}}
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('penjualan.index') }}" class="btn btn-secondary ms-2">Kembali</a>
    </form>
</div>
@endsection

@push('scripts')
<script>
    let detail = [];
    let total = 0;

    function updateTable() {
        let tbody = $('#tabelBarang tbody');
        tbody.empty();
        total = 0;

        detail.forEach((item, index) => {
            let subtotal = item.jumlah * item.harga;
            total += subtotal;

            tbody.append(`
                <tr>
                    <td>${item.nama}</td>
                    <td>${item.jumlah}</td>
                    <td>Rp. ${item.harga.toLocaleString()}</td>
                    <td>Rp. ${(subtotal).toLocaleString()}</td>
                    <td><button type="button" class="btn btn-danger btn-sm" onclick="hapusBarang(${index})">Hapus</button></td>
                </tr>
            `);
        });

        $('#totalHarga').text('Rp. ' + total.toLocaleString());
        $('#detail_penjualan').val(JSON.stringify(detail));
        hitungKembalian();
    }

    function hitungKembalian() {
        let bayar = parseInt($('#bayar').val()) || 0;
        let kembali = bayar - total;
        $('#kembalian').text('Rp. ' + (kembali > 0 ? kembali.toLocaleString() : 0));
    }

    $('#tambahBarang').on('click', function() {
        let id = $('#barang_id').val();
        let nama = $('#barang_id option:selected').text();
        let harga = parseInt($('#barang_id option:selected').data('harga'));
        let jumlah = parseInt($('#jumlah').val());

        if (!id || !jumlah || jumlah < 1 || isNaN(harga)) {
            alert('Pilih barang dan jumlah yang valid');
            return;
        }

        detail.push({ id, nama, harga, jumlah });
        updateTable();

        $('#barang_id').val('');
        $('#jumlah').val('');
    });

    $('#bayar').on('input', hitungKembalian);

    function hapusBarang(index) {
        detail.splice(index, 1);
        updateTable();
    }
</script>
@endpush
