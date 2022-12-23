<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelatihModel extends Model
{
    use  HasFactory;
    protected $table = "tb_pelatih";
    protected $fillable = [
        'nama',
        'tempat_lahir',
        'tgl_lahir',
        'nohp',
        'id_cabor',
        'id_club',
        'alamat',
        'foto',
        'file',
        'no_sertifikat',
        'tgl_sertifikat',
        'masa_sertifikat',
        'level',
        'editor',
    ];
}
