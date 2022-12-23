<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WasitModel extends Model
{
    use  HasFactory;
    protected $table = "tb_wasit";
    protected $fillable = [
        'id',
        'nama',
        'tempat_lahir',
        'tgl_lahir',
        'nohp',
        'no_sertifikat',
        'tgl_terbit',
        'masa_sertifikat',
        'level',
        'foto',
        'id_cabor',
    ];
}
