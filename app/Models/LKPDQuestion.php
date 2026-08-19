<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LKPDQuestion extends Model
{
    protected $table = 'lkpd_questions';

    protected $fillable = [
        'lkpd_id',
        'urutan',
        'jenis',
        'pertanyaan',
        'opsi_a',
        'opsi_b',
        'opsi_c',
        'opsi_d',
        'jawaban_benar',
    ];

    protected $casts = [
        'lkpd_id' => 'integer',
        'urutan' => 'integer',
    ];

    /**
     * LKPD induk.
     */
    public function lkpd(): BelongsTo
    {
        return $this->belongsTo(
            LKPD::class,
            'lkpd_id'
        );
    }

    /**
     * Seluruh jawaban siswa untuk soal ini.
     */
    public function answers(): HasMany
    {
        return $this->hasMany(
            LKPDAnswer::class,
            'lkpd_question_id'
        );
    }
}