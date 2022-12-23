<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndukOrganModel extends Model
{
    use  HasFactory;
    protected $table = "indukorganisasi";
    protected $fillable = [
        'panjang',
        'pendek',

    ];
}
