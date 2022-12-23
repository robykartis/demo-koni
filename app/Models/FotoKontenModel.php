<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class FotoKontenModel extends Model
{
    use HasFactory;
    protected $table = "tb_foto_konten";
    protected $fillable = [
        'id',
        'id_galkat',
        'judul',
        'isi',
        'tgl',

    ];

    public function tgl_formatsatu()
    {
        return  Carbon::parse($this->tgl)->isoFormat('D MMMM Y');
    }
}
