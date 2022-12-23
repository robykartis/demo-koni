<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaborModel extends Model
{
    use  HasFactory;
    protected $table = "tb_cabor";
    protected $fillable = [
        'id_induk',
        'cabor',
        'alamat',
        'lat',
        'lng',
        'sk',
        'file_sk',
        'logo',

        //baru
        'tgl_terbit',
        'tgl_berakhir',
        'no_surat_koni',
        'tgl_surat_koni',
        'nama_ketua',
        'nama_sekretaris',
        'nama_bendahara',
        'jml_pengurus',


    ];
}
