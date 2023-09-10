<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductDetail;

class ProductHeader extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function ProdukDetailKodeBarang() 
    {
        return $this->hasMany(ProductDetail::class, 'kode_barang', 'kode_barang');
    }
}
