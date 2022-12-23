<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoModel extends Model
{
    use HasFactory;
    protected $table = "tb_foto";
    protected $fillable = [
        'id',
        'id_galeri',
        'foto',

    ];
}
