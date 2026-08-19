<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuizQuestion extends Model
{
    protected $fillable = [
        'quiz_id',
        'urutan',
        'pertanyaan',
        'opsi_a',
        'opsi_b',
        'opsi_c',
        'opsi_d',
        'jawaban_benar',
    ];

    protected $casts = [
        'quiz_id' => 'integer',
        'urutan' => 'integer',
    ];

    /**
     * Quiz tempat soal berada.
     */
    public function quiz(): BelongsTo
    {
        return $this->belongsTo(
            Quiz::class,
            'quiz_id'
        );
    }
}