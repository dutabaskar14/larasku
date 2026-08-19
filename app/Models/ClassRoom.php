<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClassRoom extends Model
{
    protected $table = 'classes';

    protected $fillable = [
        'nama',
        'aktif',
        'pertemuan_aktif',
    ];

    protected $casts = [
        'aktif' => 'boolean',
        'pertemuan_aktif' => 'integer',
    ];

    public function students(): HasMany
    {
        return $this->hasMany(
            Student::class,
            'kelas',
            'nama'
        );
    }
}