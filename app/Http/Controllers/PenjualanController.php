<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Pembeli;
use App\Models\User;
use App\Models\Barang;
use App\Models\DetailPenjualan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PenjualanController extends Controller
{
    public function index(Request $request)
    {
        $tglAwal = $request->tgl_awal;
        $tglAkhir = $request->tgl_akhir;
        $pembeli = $request->pembeli;

        $query = Penjualan::with(['pembeli', 'kasir']);

        if ($tglAwal && $tglAkhir) {
            $query->whereBetween('tanggal_pesan', [$tglAwal, $tglAkhir]);
        }

        if ($pembeli) {
            $query->whereHas('pembeli', function ($q) use ($pembeli) {
                $q->where('nama', 'like', '%' . $pembeli . '%');
            });
        }

        $penjualans = $query->orderByDesc('tanggal_pesan')->paginate(10)->withQueryString();

        return view('penjualan.index', compact('penjualans', 'tglAwal', 'tglAkhir', 'pembeli'));
    }

    public function create()
    {
        $pembelis = Pembeli::all();
        $kasirs = User::all();
        $barangs = Barang::all();

        return view('penjualan.create', compact('pembelis', 'kasirs', 'barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pembeli_id' => 'required|exists:pembelis,id',
            'kasir_id' => 'required|exists:users,id',
            'tanggal_pesan' => 'required|date',
            'detail_penjualan' => 'required|string',
        ]);

        $details = json_decode($request->detail_penjualan, true);

        $totalHarga = 0;
        foreach ($details as $item) {
            $totalHarga += $item['harga'] * $item['jumlah'];
        }

        $penjualan = Penjualan::create([
            'pembeli_id' => $request->pembeli_id,
            'kasir_id' => $request->kasir_id,
            'tanggal_pesan' => $request->tanggal_pesan,
            'total_harga' => $totalHarga,
        ]);

        foreach ($details as $item) {
            DetailPenjualan::create([
                'penjualan_id' => $penjualan->id,
                'barang_id' => $item['id'],
                'jumlah' => $item['jumlah'],
                'harga' => $item['harga'],
                'total_harga' => $item['jumlah'] * $item['harga'],
            ]);

            // Kurangi stok barang
            $barang = Barang::findOrFail($item['id']);
            if ($barang->stok < $item['jumlah']) {
                return back()->with('error', 'Stok barang "' . $barang->nama . '" tidak cukup!');
            }
            $barang->stok -= $item['jumlah'];
            $barang->save();
        }

        return redirect()->route('penjualan.index')->with('success', 'Data penjualan berhasil disimpan!');
    }

    public function show($id)
    {
        $penjualan = Penjualan::with(['pembeli', 'kasir', 'details.barang'])->findOrFail($id);
        return view('penjualan.show', compact('penjualan'));
    }

    public function destroy($id)
    {
        $penjualan = Penjualan::with('details')->findOrFail($id);

        // Kembalikan stok barang sebelum menghapus
        foreach ($penjualan->details as $detail) {
            $barang = Barang::find($detail->barang_id);
            if ($barang) {
                $barang->stok += $detail->jumlah;
                $barang->save();
            }
        }

        // Hapus detail penjualan
        $penjualan->details()->delete();

        // Hapus penjualan
        $penjualan->delete();

        return redirect()->route('penjualan.index')->with('success', 'Data penjualan berhasil dihapus!');
    }

    public function cetakPdf()
    {
        $penjualans = Penjualan::with(['pembeli', 'kasir', 'details.barang'])->orderByDesc('tanggal_pesan')->get();

        $pdf = Pdf::loadView('penjualan.cetakpenjualan', compact('penjualans'));
        $pdf->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);

        return $pdf->stream('laporan_penjualan.pdf');
    }

    public function cetakDetail($id)
    {
        $penjualan = Penjualan::with(['pembeli', 'kasir', 'details.barang'])->findOrFail($id);

        $pdf = Pdf::loadView('penjualan.cetakdetailpenjualan', compact('penjualan'));
        $pdf->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);

        return $pdf->stream('detail_penjualan_' . $id . '.pdf');
    }
}
