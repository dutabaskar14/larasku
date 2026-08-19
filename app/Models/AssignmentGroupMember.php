<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssignmentGroupMember extends Model
{
    protected $fillable = [
        'assignment_group_id',
        'student_id',
    ];

    protected $casts = [
        'assignment_group_id' => 'integer',
        'student_id' => 'integer',
    ];

    public function group(): BelongsTo
    {
        return $this->belongsTo(
            AssignmentGroup::class,
            'assignment_group_id'
        );
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(
            Student::class,
            'student_id'
        );
    }
}