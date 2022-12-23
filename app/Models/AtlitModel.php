<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtlitModel extends Model
{
    use  HasFactory;
    protected $table = "tb_atlit";
    protected $fillable = [
        'id_cabor',
        'id',
        'id_club',
        'nik',
        'nama',
        'nohp',
        'tgl_lahir',
        'jk',
        'agama',
        'berat_badan',
        'tinggi_badan',
        'ayah',
        'ibu',
        'foto',
        'kecamatan',
        'kelurahan',
        'alamat',

        //
        'editor',
        'nia',
    ];
}
