<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
    $search = $request->input('search');

    $query = Supplier::query();

    if ($search) {
        $query->where('nama', 'like', '%' . $search . '%')
              ->orWhere('alamat', 'like', '%' . $search . '%')
              ->orWhere('kodepos', 'like', '%' . $search . '%');
    }

    $suppliers = $query->orderBy('nama')->paginate(2)->withQueryString();

    return view('supplier.index', compact('suppliers'));
    }

    public function create()
    {
        return view('supplier.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'kodepos' => 'required|size:5',
        ]);

        Supplier::create($request->only(['nama', 'alamat', 'kodepos']));

        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil ditambahkan');
    }

    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('supplier.edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'kodepos' => 'required|size:5',
        ]);

        $supplier = Supplier::findOrFail($id);
        $supplier->update($request->only(['nama', 'alamat', 'kodepos']));

        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil diupdate');
    }

    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil dihapus');
    }
}
