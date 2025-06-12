<!DOCTYPE html>
<html>
<head>
    <title>Detail Penjualan</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
        }
        th {
            background-color: #eee;
        }
        h3, h4 {
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h3>Detail Penjualan</h3>

    <table>
        <tr>
            <td><strong>ID Transaksi</strong></td>
            <td>{{ $penjualan->id }}</td>
        </tr>
        <tr>
            <td><strong>Kasir</strong></td>
            <td>{{ $penjualan->kasir->name ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>Pembeli</strong></td>
            <td>{{ $penjualan->pembeli->nama ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>Tanggal</strong></td>
            <td>{{ $penjualan->tanggal_pesan }}</td>
        </tr>
    </table>

    <h4>Daftar Barang</h4>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach($penjualan->details as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->barang->nama ?? '-' }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>Rp {{ number_format($item->barang->harga ?? 0, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                    @php $total += $item->total_harga; @endphp
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" align="right"><strong>Total:</strong></td>
                <td><strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
