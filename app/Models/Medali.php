<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medali extends Model
{
    use  HasFactory;
    protected $table = "tb_medali";
    protected $fillable = [
        'medali',


    ];
}
