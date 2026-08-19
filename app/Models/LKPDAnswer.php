<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LKPDAnswer extends Model
{
    protected $table = 'lkpd_answers';

    protected $fillable = [
        'lkpd_id',
        'student_id',
        'lkpd_question_id',
        'jawaban',
        'nilai',
        'dinilai_at',
    ];

    protected $casts = [
        'lkpd_id' => 'integer',
        'student_id' => 'integer',
        'lkpd_question_id' => 'integer',
        'nilai' => 'integer',
        'dinilai_at' => 'datetime',
    ];

    /**
     * LKPD yang dikerjakan.
     */
    public function lkpd(): BelongsTo
    {
        return $this->belongsTo(
            LKPD::class,
            'lkpd_id'
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

    /**
     * Soal yang dijawab.
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(
            LKPDQuestion::class,
            'lkpd_question_id'
        );
    }
}