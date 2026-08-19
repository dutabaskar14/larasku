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
        Schema::table('assignments', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | Pertemuan Tugas
            |--------------------------------------------------------------------------
            |
            | Setiap tugas terhubung langsung dengan pertemuan
            | yang dibuat guru untuk kelas tertentu.
            |
            */

            $table->foreignId('assignment_meeting_id')
                ->nullable()
                ->after('id')
                ->constrained('assignment_meetings')
                ->nullOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Index
            |--------------------------------------------------------------------------
            */

            $table->index(
                'assignment_meeting_id'
            );
        });
    }


    /**
     * Balikkan migration.
     */
    public function down(): void
    {
        Schema::table('assignments', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | Hapus Foreign Key
            |--------------------------------------------------------------------------
            */

            $table->dropForeign([
                'assignment_meeting_id',
            ]);


            /*
            |--------------------------------------------------------------------------
            | Hapus Kolom
            |--------------------------------------------------------------------------
            */

            $table->dropColumn(
                'assignment_meeting_id'
            );
        });
    }
};