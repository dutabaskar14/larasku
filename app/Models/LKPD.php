<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LKPD extends Model
{
    protected $table = 'lkpds';

    protected $fillable = [
        'student_id',
        'pertemuan',
        'foto',
        'disetujui',
        'disetujui_at',
    ];

    protected $casts = [
        'pertemuan' => 'integer',
        'disetujui' => 'boolean',
        'disetujui_at' => 'datetime',
    ];


    /**
     * LKPD milik siswa.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(
            \App\Models\Student::class,
            'student_id'
        );
    }
}