<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration.
     */
    public function up(): void
    {
        Schema::table('lkpds', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | Status Persetujuan Guru
            |--------------------------------------------------------------------------
            */

            $table->boolean('disetujui')
                ->default(false)
                ->after('foto');


            /*
            |--------------------------------------------------------------------------
            | Waktu Persetujuan
            |--------------------------------------------------------------------------
            */

            $table->timestamp('disetujui_at')
                ->nullable()
                ->after('disetujui');
        });
    }


    /**
     * Balikkan migration.
     */
    public function down(): void
    {
        Schema::table('lkpds', function (Blueprint $table) {

            $table->dropColumn([
                'disetujui',
                'disetujui_at',
            ]);

        });
    }
};