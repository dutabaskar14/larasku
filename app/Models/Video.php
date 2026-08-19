<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'videos';

    protected $fillable = [
        'pertemuan',
        'judul',
        'youtube_url',
        'deskripsi',
        'urutan',
    ];

    protected $casts = [
        'pertemuan' => 'integer',
        'urutan' => 'integer',
    ];
}