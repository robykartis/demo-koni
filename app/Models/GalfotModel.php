<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalfotModel extends Model
{
    use HasFactory;
    protected $table = "tb_galfot";
    protected $fillable = [
        'id',
        'nama',
    ];
}
