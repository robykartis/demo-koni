<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrestasiModel extends Model
{
    use  HasFactory;
    protected $table = "tb_prestasi";
    protected $fillable = [
        'id',
        'id_atlet',
        'kejuaraan',
        'tahun',
        'tempat',
        'medali',

    ];
}
