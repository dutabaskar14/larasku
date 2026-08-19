<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reflection extends Model
{
    protected $fillable = [
        'pertemuan',
        'judul',
        'deskripsi',
        'aktif',
    ];

    protected $casts = [
        'pertemuan' => 'integer',
        'aktif' => 'boolean',
    ];


    /**
     * ============================================================
     * SOAL REFLEKSI
     * ============================================================
     */

    public function questions(): HasMany
    {
        return $this->hasMany(
            ReflectionQuestion::class,
            'reflection_id'
        )->orderBy('urutan');
    }


    /**
     * ============================================================
     * JAWABAN SISWA
     * ============================================================
     */

    public function answers(): HasMany
    {
        return $this->hasMany(
            ReflectionAnswer::class,
            'reflection_id'
        );
    }
}