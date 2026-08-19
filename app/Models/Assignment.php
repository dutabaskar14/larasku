<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Assignment extends Model
{
    protected $fillable = [
        'assignment_meeting_id',
        'kelas',
        'pertemuan',
        'judul',
        'instruksi',
        'mode_pengumpulan',
        'batas_waktu',
        'aktif',
    ];

    protected $casts = [
        'assignment_meeting_id' => 'integer',
        'pertemuan' => 'integer',
        'batas_waktu' => 'datetime',
        'aktif' => 'boolean',
    ];

    /**
     * Pertemuan tugas.
     */
    public function assignmentMeeting(): BelongsTo
    {
        return $this->belongsTo(
            AssignmentMeeting::class,
            'assignment_meeting_id'
        );
    }

    /**
     * Kelompok tugas.
     */
    public function groups(): HasMany
    {
        return $this->hasMany(
            AssignmentGroup::class,
            'assignment_id'
        );
    }

    /**
     * Pengumpulan tugas.
     */
    public function submissions(): HasMany
    {
        return $this->hasMany(
            AssignmentSubmission::class,
            'assignment_id'
        );
    }
}