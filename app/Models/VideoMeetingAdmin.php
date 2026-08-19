<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VideoMeetingAdmin extends Model
{
    protected $table = 'video_meetings';

    protected $fillable = [
        'pertemuan',
        'aktif',
    ];

    protected $casts = [
        'pertemuan' => 'integer',
        'aktif' => 'boolean',
    ];


    /**
     * Video pada pertemuan ini.
     */
    public function videos(): HasMany
    {
        return $this->hasMany(
            Video::class,
            'pertemuan',
            'pertemuan'
        )->orderBy('urutan');
    }
}