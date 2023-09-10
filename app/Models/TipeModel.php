<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Jenis;

class TipeModel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function jenis()
    {
        return $this->hasMany(Jenis::class, 'id', 'id_jenis');
    }
}
