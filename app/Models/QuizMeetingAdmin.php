<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuizMeetingAdmin extends Model
{
    protected $table = 'quiz_meetings';

    protected $fillable = [
        'pertemuan',
    ];

    protected $casts = [
        'pertemuan' => 'integer',
    ];

    public function quizzes(): HasMany
    {
        return $this->hasMany(
            Quiz::class,
            'pertemuan',
            'pertemuan'
        );
    }
}