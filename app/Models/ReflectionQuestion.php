<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReflectionQuestion extends Model
{
    protected $fillable = [
        'reflection_id',
        'urutan',
        'pertanyaan',
    ];

    protected $casts = [
        'reflection_id' => 'integer',
        'urutan' => 'integer',
    ];


    /**
     * Refleksi tempat soal berada.
     */
    public function reflection(): BelongsTo
    {
        return $this->belongsTo(
            Reflection::class,
            'reflection_id'
        );
    }
}