<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeritaKatModel extends Model
{
    use  HasFactory;
    protected $table = "tb_beritakat";
    protected $fillable = [
        'id',
        'nama',
    ];
}
