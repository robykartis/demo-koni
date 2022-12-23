<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisotorModel extends Model
{
    use  HasFactory;
    protected $table = "tb_visitor";
    protected $fillable = [
        'id',
        'hits',
        'ip',
        'date',

    ];
}
