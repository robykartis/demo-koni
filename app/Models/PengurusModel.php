<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengurusModel extends Model
{
    use  HasFactory;
    protected $table = "tb_pengurus";
    protected $fillable = [
        'id_kat_peng',
        'nama',
        'jk',
        'nohp',
        'jabatan',
        'foto',

    ];
}
