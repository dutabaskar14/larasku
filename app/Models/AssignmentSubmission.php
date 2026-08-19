<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssignmentSubmission extends Model
{
    protected $fillable = [
        'assignment_id',
        'student_id',
        'assignment_group_id',
        'link',
        'catatan_siswa',
        'nilai',
        'catatan_guru',
        'status',
        'submitted_at',
        'graded_at',
    ];

    protected $casts = [
        'assignment_id' => 'integer',
        'student_id' => 'integer',
        'assignment_group_id' => 'integer',
        'nilai' => 'decimal:2',
        'submitted_at' => 'datetime',
        'graded_at' => 'datetime',
    ];

    public function assignment(): BelongsTo
    {
        return $this->belongsTo(
            Assignment::class,
            'assignment_id'
        );
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(
            Student::class,
            'student_id'
        );
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(
            AssignmentGroup::class,
            'assignment_group_id'
        );
    }
}