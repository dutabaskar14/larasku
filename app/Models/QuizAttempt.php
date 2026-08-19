<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuizAttempt extends Model
{
    protected $fillable = [
        'quiz_id',
        'student_id',
        'jawaban',
        'jumlah_benar',
        'jumlah_soal',
        'nilai',
        'dikerjakan_at',
    ];

    protected $casts = [
        'quiz_id' => 'integer',
        'student_id' => 'integer',
        'jawaban' => 'array',
        'jumlah_benar' => 'integer',
        'jumlah_soal' => 'integer',
        'nilai' => 'decimal:2',
        'dikerjakan_at' => 'datetime',
    ];


    /**
     * Quiz yang dikerjakan.
     */
    public function quiz(): BelongsTo
    {
        return $this->belongsTo(
            Quiz::class,
            'quiz_id'
        );
    }


    /**
     * Siswa yang mengerjakan.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(
            Student::class,
            'student_id'
        );
    }
}