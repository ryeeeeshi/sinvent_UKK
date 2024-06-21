<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rsetKategori = Kategori::all();
        return response()->json(['data' => $rsetKategori]);    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'deskripsi' => 'required',
            'kategori' => 'required',
        ]);
    
        try {
            $kategori = Kategori::create([
                'deskripsi' => $request->deskripsi,
                'kategori' => $request->kategori
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menyimpan data kategori: ' . $e->getMessage()], 500);
        }
    
        return response()->json(['data' => $kategori], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return response()->json(['error' => 'Data kategori tidak ditemukan.'], 404);
        }
    
        return response()->json(['data' => $kategori]);  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'deskripsi' => 'required',
            'kategori' => 'required',
        ]);
    
        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        // Find Kategori by ID
        $kategori = Kategori::find($id);
    
        if (!$kategori) {
            return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
        }
    
        $kategori->update([
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
        ]);
    
        // Return response
        return response()->json(['message' => 'Data Kategori Berhasil Diubah'], 200);
    }
            /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = Kategori::find($id);

        if (is_null($kategori)) {
            return response()->json(['status' => 'Data kategori tidak ditemukan'], 404);
        }

        try {
            $kategori->delete();
            return response()->json(['status' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'Gagal menghapus data kategori'], 500);
        }
    }
}