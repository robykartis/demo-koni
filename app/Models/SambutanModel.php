<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SambutanModel extends Model
{
    use HasFactory;

    protected $table = "tb_sambutan";
    protected $fillable = [
        'id_pengurus',
        'isi',


    ];
}
