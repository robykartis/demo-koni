<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KatPengModel extends Model
{
    use  HasFactory;
    protected $table = "tb_kat_pengurus";
    protected $fillable = [
        'nama_kat',
        'tupoksi',

    ];
}
