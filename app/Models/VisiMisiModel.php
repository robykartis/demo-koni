<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisiMisiModel extends Model
{
    use  HasFactory;
    protected $table = "tb_visimisi";
    protected $fillable = [
        'visi',
        'misi',

    ];
}
