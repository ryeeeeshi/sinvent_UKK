<?php

namespace App\Models;
use App\Models\Barang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $table = 'barangmasuk';
    protected $primaryKey = 'id';
    protected $fillable = ['tgl_masuk','qty_masuk','barang_id'];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
