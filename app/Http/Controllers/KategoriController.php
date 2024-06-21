<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        // $searchTerm = '%' . $request->input('search', '') . '%';

        $DBKategori = DB::select('CALL getKategori("kategori")');
    
        $kategoriMapFromDB = collect($DBKategori)->map(function ($item) {
            return (array) $item;
        })->pluck('deskripsi', 'id')->toArray();
    
        $query = DB::table('kategori')->select('id', 'deskripsi', 'kategori');
    
        if ($request->search) {
            $query->where('id', 'like', '%' . $request->search . '%')
                ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
        }

        $rsetKategori = $query->paginate(10);

        foreach ($rsetKategori as $item) {
            $item->kategori = DB::select('SELECT ketKategori(?) AS deskripsi', [$item->kategori])[0]->deskripsi ?? $item->kategori;
        }
    
        return view('kategori.index', ['rsetKategori' => $rsetKategori]);
    }
            /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'deskripsi' => 'required',
            'kategori' => 'required'
        ]);        

        try {
            DB::beginTransaction(); // <= Starting the transaction

            // Insert a new order history
            DB::table('kategori')->insert([
                'deskripsi' => $request->deskripsi,
                'kategori' => $request->kategori,
            ]);

            DB::commit(); // <= Commit the changes
        } catch (\Exception $e) {
            report($e);

            DB::rollBack(); // <= Rollback in case of an exception
        }
        
        return redirect()->route('kategori.index')->with('Success', 'Data saved successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rsetKategori = Kategori::find($id);
        return view('kategori.show', compact('rsetKategori'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rsetKategori = Kategori::find($id);
        return view('kategori.edit', compact('rsetKategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'deskripsi' => 'required|string|max:100',
            'kategori' => 'required|in:M,A,BHP,BTHP',
        ]);        

        $rsetKategori = Kategori::find($id);

        $rsetKategori->update([
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
        ]);

        return redirect()->route('kategori.index')->with('Success', 'Successfully modified');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (DB::table('barang')->where('kategori_id', $id)->exists()){ 
            return redirect()->route('kategori.index')->with(['Gagal' => 'Data failed to delete']);
        } else {
            $rseKategori = Kategori::find($id);
            $rseKategori->delete();
            return redirect()->route('kategori.index')->with(['Success' => 'Successfully deleted']);
        }
    }
}