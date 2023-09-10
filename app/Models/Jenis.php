<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TipeModel;

class Jenis extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // public function tipe_model()
    // {
    //     return $this->hasMany(TipeModel::class, )
    // }
}
