<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilModel extends Model
{

    use  HasFactory;
    protected $table = "tb_profil";
    protected $fillable = [
        'nama',
        'email',
        'telp',
        'alamat',
        'fb',
        'ig',
        'yt',
        'logo',
        'lat',
        'lng',
        'deskripsi',
    ];
}
