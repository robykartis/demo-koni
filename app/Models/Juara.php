<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Juara extends Model
{
    use  HasFactory;
    protected $table = "tb_juara";
    protected $fillable = [
        'nama',


    ];
}
