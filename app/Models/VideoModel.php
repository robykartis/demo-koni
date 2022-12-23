<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class VideoModel extends Model
{
    use  HasFactory;
    protected $table = "tb_video";
    protected $fillable = [
        'id',
        'judul',
        'slug',
        'tgl',
        'isi',
        'video',
    ];

    public function tgl_video_formatsatu()
    {


        return  Carbon::parse($this->tgl)->isoFormat('D MMMM Y');
    }
}
