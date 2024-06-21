<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DB::table('barangkeluar')
        ->join('barang', 'barangkeluar.barang_id', '=', 'barang.id')
        ->select('barangkeluar.*', 'barang.merk', 'barang.seri', 'barang.spesifikasi');

        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function ($query) use ($searchTerm) {
                $query->where('barangkeluar.tgl_keluar', 'like', '%' . $searchTerm . '%')
                    ->orWhere('barangkeluar.qty_keluar', 'like', '%' . $searchTerm . '%')
                    ->orWhere('barang.merk', 'like', '%' . $searchTerm . '%')
                    ->orWhere('barang.seri', 'like', '%' . $searchTerm . '%')
                    ->orWhere('barang.spesifikasi', 'like', '%' . $searchTerm . '%');
            });
        }
        
        $barangKeluar = $query->paginate(10);

        return view('barangkeluar.index', compact('barangKeluar'));    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rsetBarang = Barang::all();
        return view('barangkeluar.create', compact('rsetBarang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tgl_keluar'   => 'required|date',
            'qty_keluar'   => [
                'required',
                'integer',
                'min:0',
                function ($attribute, $value, $fail) use ($request) {
                    $barang = Barang::findOrFail($request->barang_id);
                    $stok_barang = $barang->stok;

                    if ($value > $stok_barang) {
                        $fail("Quantity must not exceed ($stok_barang) stock!");
                    }
                },
            ],
            'barang_id'    => 'required|exists:barang,id',
        ]);
    
        // Check if the exit date is before any entry date of the item
        $beforeBMasuk = BarangMasuk::where('barang_id', $validatedData['barang_id'])
            ->where('tgl_masuk', '>', $validatedData['tgl_keluar'])
            ->exists();
        
        if ($beforeBMasuk) {
            return redirect()->back()->withInput()->withErrors(['tgl_keluar' => 'The exit date cannot be before the entry date!']);
        }
    
        try {
            DB::beginTransaction(); 
    
            DB::table('barangkeluar')->insert([
                'tgl_keluar' => $validatedData['tgl_keluar'],
                'qty_keluar' => $validatedData['qty_keluar'],
                'barang_id' => $validatedData['barang_id'],
            ]);
    
            DB::commit();
        } catch (\Exception $e) {
            report($e);
    
            DB::rollBack(); 
            return redirect()->back()->withErrors(['Gagal' => 'An error occurred while saving the data']);
        }
    
        return redirect()->route('barangkeluar.index')->with(['Success' => 'Successfully saved!']);
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $barangKeluar = BarangKeluar::find($id);
        return view('barangkeluar.show', compact('barangKeluar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $barangKeluar = BarangKeluar::find($id);
        $rsetBarang = Barang::all();
        return view('barangkeluar.edit', compact('barangKeluar', 'rsetBarang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $barangKeluar = BarangKeluar::find($id);
        $barang = Barang::find($request->barang_id);

        $request->validate([
            'tgl_keluar'   => 'required|date',
            'qty_keluar'   => 'required|numeric|min:1',
            'barang_id'    => 'required|exists:barang,id',
        ]);

        $beforeBMasuk = BarangMasuk::where('barang_id', $request->barang_id)
        ->where('tgl_masuk', '>', $request->tgl_keluar)
        ->exists();
        if ($beforeBMasuk) {
            return redirect()->back()->withInput()->withErrors(['tgl_keluar' => 'The exit date cannot be before the entry date!']);
        }
        
        $barang = Barang::find($request->barang_id);
        if ($request->qty_keluar > $barang->stok) {
            return redirect()->back()->withInput()->withErrors(['qty_keluar' => 'The quantity exceeds existing stock items!']);
        }

        $barangKeluar->update([
            'tgl_keluar' => $request->tgl_keluar,
            'qty_keluar' => $request->qty_keluar,
            'barang_id' => $request->barang_id,
        ]);

        return redirect()->route('barangkeluar.index')->with(['Success' => 'Successfully modified!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $barangKeluar = BarangKeluar::find($id);
        $barangKeluar->delete();
        return redirect()->route('barangkeluar.index')->with(['Success' => 'Successfully deleted!']);
    }
}