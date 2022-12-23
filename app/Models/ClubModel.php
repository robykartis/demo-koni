<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClubModel extends Model
{
    use  HasFactory;
    protected $table = "tb_club";
    protected $fillable = [
        'id_cabor',
        'club',
        'alamat',
        'lat',
        'lng',
        'sk',

        'logo',

        //baru
        'tgl_terbit',
        'tgl_berakhir',
        'nama_ketua',
        'nama_sekretaris',
        'nama_bendahara',
        'jml_pengurus',
        'editor',


    ];
}
