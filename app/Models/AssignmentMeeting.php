<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AssignmentMeeting extends Model
{
    protected $table = 'assignment_meetings';

    protected $fillable = [
        'kelas',
        'pertemuan',
        'aktif',
    ];

    protected $casts = [
        'pertemuan' => 'integer',
        'aktif' => 'boolean',
    ];

    /**
     * Semua tugas pada pertemuan ini.
     */
    public function assignments(): HasMany
    {
        return $this->hasMany(
            Assignment::class,
            'assignment_meeting_id'
        );
    }
}