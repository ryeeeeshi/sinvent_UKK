<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Models\Kategori;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class BarangController extends Controller
{
    use ValidatesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $query = DB::table('barang')
        // ->join('kategori', 'barang.kategori_id', '=', 'kategori.id')
        // ->select('barang.*', 'kategori.deskripsi as kategori_deskripsi');

        $search = $request->query('search');
        if ($search) {
            $rsetBarang = Barang::where('merk', 'like', '%' . $search . '%')
                                    ->orWhere('seri', 'like', '%' . $search . '%')
                                    ->orWhere('spesifikasi', 'like', '%' . $search . '%')
                                    ->orWhere('stok', 'like', '%' . $search . '%')
                                    ->orWhere('kategori_id', 'like', '%' . $search . '%')
                                    ->orWhereHas('kategori', function($query) use ($search) {
                                        $query->where('deskripsi', 'like', '%' . $search . '%');
                                    })
                                    ->with('kategori')
                                    ->get();
        } else {
            $rsetBarang = Barang::with('kategori')->get();
        }
                        
        return view('barang.index', compact('rsetBarang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rsetKategori = Kategori::all();
        $aKategori = array(
            'blank' => 'Pilih Kategori',
            'M' => 'Barang Modal',
            'A' => 'Alat',
            'BHP' => 'Bahan Habis Pakai',
            'BTHP' => 'Bahan Tidak Habis Pakai'
        );

        return view('barang.create', compact('rsetKategori', 'aKategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'merk' => [
                'required',
                'string',
                'max:50',
                Rule::unique('barang')->where(function ($query) use ($request) {
                    return $query->where('seri', $request->seri);
                }),
            ],
            'seri' => 'nullable|string|max:50',
            'spesifikasi' => 'nullable|string',
            'kategori_id' => 'required|exists:kategori,id',
        ], [
            'merk.required' => 'Item brand must be filled in',
        ]);

        if ($validator->fails()) {
            return redirect()->route('barang.create')
                ->withErrors($validator)
                ->withInput()
                ->with(['error' => 'Failed to add an item!']);
        }

        try {
            DB::beginTransaction(); 

            DB::table('barang')->insert([
                'merk' => $request->merk,
                'seri' => $request->seri,
                'spesifikasi' => $request->spesifikasi,
                'kategori_id' => $request->kategori_id,
            ]);

            DB::commit(); 
        } catch (\Exception $e) {
            report($e);

            DB::rollBack();

            return redirect()->route('barang.create')->with([
                'Gagal' => 'An error occurred while saving data! Message: ' . $e->getMessage()
            ]);
        }

        return redirect()->route('barang.index')->with(['Success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rsetBarang = Barang::with('kategori')->find($id);
        $rsetKategori = Kategori::all(); // Assuming you also fetch categories here
        return view('barang.show', compact('rsetBarang', 'rsetKategori'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rsetBarang = Barang::find($id);
        $rsetKategori = Kategori::all(); // Assuming you also fetch categories here
    
        return view('barang.edit', compact('rsetBarang', 'rsetKategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $this->validate($request, [
            'merk' => 'required',
            'seri' => 'required',
            'spesifikasi' => 'required',
            'kategori_id' => 'required',
        ]);

        $rsetBarang = Barang::find($id);
        $rsetBarang->update($validatedData);

        return redirect()->route('barang.index')->with(['Success' => 'Successfully modified!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (DB::table('barangmasuk')->where('barang_id', $id)->exists() || DB::table('barangkeluar')->where('barang_id', $id)->exists()) {
            return redirect()->route('barang.index')->with(['Gagal' => 'Data failed to delete']);
        } else {
            $rsetBarang = Barang::find($id);
            $rsetBarang->delete();
            return redirect()->route('barang.index')->with(['Success' => 'Successfully deleted']);
        }
    }
}