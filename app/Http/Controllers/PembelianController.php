<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\Barang;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    public function index()
    {
        $pembelians = Pembelian::with(['barang', 'supplier'])->latest()->get();
        return view('pembelian.index', compact('pembelians'));
    }

    public function create()
    {
        $barangs = Barang::all();
        $suppliers = Supplier::all();
        return view('pembelian.create', compact('barangs', 'suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal' => 'required|date',
        ]);

        // Simpan data pembelian
        $pembelian = Pembelian::create([
            'barang_id' => $request->barang_id,
            'supplier_id' => $request->supplier_id,
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
        ]);

        // Tambahkan stok barang
        $barang = Barang::find($request->barang_id);
        $barang->stok += $request->jumlah;
        $barang->save();

        return redirect()->route('pembelian.index')->with('success', 'Data pembelian berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pembelian = Pembelian::findOrFail($id);
        $barangs = Barang::all();
        $suppliers = Supplier::all();
        return view('pembelian.edit', compact('pembelian', 'barangs', 'suppliers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal' => 'required|date',
        ]);

        $pembelian = Pembelian::findOrFail($id);

        // Kembalikan stok lama dulu sebelum update
        $barangLama = Barang::find($pembelian->barang_id);
        $barangLama->stok -= $pembelian->jumlah;
        $barangLama->save();

        // Update pembelian
        $pembelian->update([
            'barang_id' => $request->barang_id,
            'supplier_id' => $request->supplier_id,
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
        ]);

        // Tambahkan stok baru
        $barangBaru = Barang::find($request->barang_id);
        $barangBaru->stok += $request->jumlah;
        $barangBaru->save();

        return redirect()->route('pembelian.index')->with('success', 'Data pembelian berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pembelian = Pembelian::findOrFail($id);

        // Kurangi stok barang saat pembelian dihapus
        $barang = Barang::find($pembelian->barang_id);
        if ($barang) {
            $barang->stok -= $pembelian->jumlah;
            if ($barang->stok < 0) $barang->stok = 0; // Cegah stok negatif
            $barang->save();
        }

        $pembelian->delete();

        return redirect()->route('pembelian.index')->with('success', 'Data pembelian berhasil dihapus.');
    }
}
