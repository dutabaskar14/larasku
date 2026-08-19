<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReflectionMeeting extends Model
{
    protected $table = 'reflection_meetings';

    protected $fillable = [
        'pertemuan',
    ];

    protected $casts = [
        'pertemuan' => 'integer',
    ];


    /**
     * ============================================================
     * REFLEKSI PADA PERTEMUAN INI
     * ============================================================
     *
     * Relasi berdasarkan nomor pertemuan.
     *
     * Contoh:
     *
     * reflection_meetings.pertemuan = 2
     * reflections.pertemuan          = 2
     *
     */
    public function reflections(): HasMany
    {
        return $this->hasMany(
            Reflection::class,
            'pertemuan',
            'pertemuan'
        );
    }
}