<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReflectionAnswer extends Model
{
    protected $fillable = [
        'reflection_id',
        'student_id',
        'reflection_question_id',
        'jawaban',
        'nilai',
        'dinilai_at',
    ];

    protected $casts = [
        'reflection_id' => 'integer',
        'student_id' => 'integer',
        'reflection_question_id' => 'integer',
        'nilai' => 'integer',
        'dinilai_at' => 'datetime',
    ];


    /**
     * Refleksi yang dijawab.
     */
    public function reflection(): BelongsTo
    {
        return $this->belongsTo(
            Reflection::class,
            'reflection_id'
        );
    }


    /**
     * Siswa yang menjawab.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(
            Student::class,
            'student_id'
        );
    }


    /**
     * Pertanyaan yang dijawab.
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(
            ReflectionQuestion::class,
            'reflection_question_id'
        );
    }
}