<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductHeader;
use App\Models\Warna;

class ProductDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function ProductHeaderKodeBarang()
    {
        return $this->belongsTo(ProductHeader::class, 'kode_barang', 'kode_barang');
    }

    public function warna()
    {
        return $this->hasMany(Warna::class, 'id', 'id_warna');
    }
     
}
