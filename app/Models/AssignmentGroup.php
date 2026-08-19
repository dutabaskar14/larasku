<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AssignmentGroup extends Model
{
    protected $fillable = [
        'assignment_id',
        'kelas',
        'nomor_kelompok',
    ];

    protected $casts = [
        'assignment_id' => 'integer',
        'nomor_kelompok' => 'integer',
    ];

    public function assignment(): BelongsTo
    {
        return $this->belongsTo(
            Assignment::class,
            'assignment_id'
        );
    }

    public function members(): HasMany
    {
        return $this->hasMany(
            AssignmentGroupMember::class,
            'assignment_group_id'
        );
    }

    public function submissions(): HasMany
    {
        return $this->hasMany(
            AssignmentSubmission::class,
            'assignment_group_id'
        );
    }
}