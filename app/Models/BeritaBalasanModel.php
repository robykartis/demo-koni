<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeritaBalasanModel extends Model
{
    use  HasFactory;
    protected $table = "tb_berita_balasan";
    protected $fillable = [
        'id',
        'id_berita',
        'editor',
        'balasan',
        'tgl',
    ];
}
