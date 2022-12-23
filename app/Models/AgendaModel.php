<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AgendaModel extends Model
{
    use  HasFactory;
    protected $table = "tb_agenda";
    protected $fillable = [
        'id',
        'id_kat',
        'judul',
        'slug',
        'waktu',
        'tempat',
        'isi',

    ];

    public function tgl_ag_formatsatu()
    {


        return  Carbon::parse($this->waktu)->isoFormat('D MMMM Y - H:m ');
    }
}
