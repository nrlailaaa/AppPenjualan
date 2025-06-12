<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan</title>
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
        h3 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h3>Laporan Penjualan</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kasir</th>
                <th>Pembeli</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penjualans as $i => $p)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $p->kasir->name ?? '-' }}</td>
                    <td>{{ $p->pembeli->nama ?? '-' }}</td>
                    <td>{{ $p->tanggal_pesan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
