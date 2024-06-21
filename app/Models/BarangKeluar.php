<?php

namespace App\Models;
use App\Models\Barang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BarangKeluar extends Model
{
    use HasFactory;

    protected $table = 'barangkeluar';
    protected $primaryKey = 'id';
    protected $fillable = ['tgl_keluar','qty_keluar','barang_id'];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
