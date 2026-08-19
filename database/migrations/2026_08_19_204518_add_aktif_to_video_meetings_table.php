<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('video_meetings', function (Blueprint $table) {
            $table->boolean('aktif')
                ->default(true)
                ->after('pertemuan');
        });
    }

    public function down(): void
    {
        Schema::table('video_meetings', function (Blueprint $table) {
            $table->dropColumn('aktif');
        });
    }
};