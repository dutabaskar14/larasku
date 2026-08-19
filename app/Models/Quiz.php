<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quiz extends Model
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
     * Soal-soal dalam quiz.
     */
    public function questions(): HasMany
    {
        return $this->hasMany(
            QuizQuestion::class,
            'quiz_id'
        )->orderBy('urutan');
    }

    /**
     * Hasil pengerjaan siswa.
     */
    public function attempts(): HasMany
    {
        return $this->hasMany(
            QuizAttempt::class,
            'quiz_id'
        );
    }
}