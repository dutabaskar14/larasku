<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MaterialMeeting extends Model
{
    protected $fillable = [
        'pertemuan',
        'aktif',
    ];

    protected $casts = [
        'pertemuan' => 'integer',
        'aktif' => 'boolean',
    ];

    /**
     * Semua materi pada pertemuan ini.
     */
    public function materials(): HasMany
    {
        return $this->hasMany(
            Material::class,
            'pertemuan',
            'pertemuan'
        );
    }
}