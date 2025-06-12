<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Penjualan;
use App\Models\DetailPenjualan;
use App\Models\Pembelian;

class DashboardController extends Controller
{
    public function index()
    {
        $today = date("Y-m-d");

        $rupiahhariini = DetailPenjualan::whereDate('created_at', $today)->sum('total_harga');
        $baranghariini = DetailPenjualan::whereDate('created_at', $today)->sum('jumlah');
        $barangmasuk = Pembelian::whereDate('tanggal', $today)->sum('jumlah');
        $jumlahtransaksi = Penjualan::whereDate('tanggal_pesan', $today)->count();
        $barang = Barang::where('stok', '<=', 5)->get();

        return view('dashboard', compact('rupiahhariini', 'baranghariini', 'barangmasuk', 'jumlahtransaksi', 'barang'));
    }
}
