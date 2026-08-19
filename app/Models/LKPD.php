<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LKPD extends Model
{
    protected $table = 'lkpds';

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
     * SOAL LKPD
     * ============================================================
     */

    public function questions(): HasMany
    {
        return $this->hasMany(
            LKPDQuestion::class,
            'lkpd_id'
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
            LKPDAnswer::class,
            'lkpd_id'
        );
    }
}