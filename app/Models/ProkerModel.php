<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProkerModel extends Model
{
    use  HasFactory;
    protected $table = "tb_proker";
    protected $fillable = [
        'judul',
        'isi',

    ];
}
