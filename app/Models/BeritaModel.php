<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class BeritaModel extends Model
{
    use  HasFactory;
    protected $table = "tb_berita";
    protected $fillable = [
        'id',
        'judul',
        'slug',
        'tag',
        'tgl_berita',
        'foto',
        'isi',
        'id_katberita',
        'id_user',
        'aktif',
        'status',
        'visitor',
    ];

    public function tgl_berita_formatsatu()
    {


        return  Carbon::parse($this->tgl_berita)->isoFormat('D MMMM Y');
    }
}
