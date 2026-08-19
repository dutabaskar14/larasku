<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
        'pertemuan',
        'judul',
        'kategori',
        'isi',
        'gambar',
        'video_url',
        'audio_url',
        'aktif',
    ];

    protected $casts = [
        'pertemuan' => 'integer',
        'aktif' => 'boolean',
    ];
}