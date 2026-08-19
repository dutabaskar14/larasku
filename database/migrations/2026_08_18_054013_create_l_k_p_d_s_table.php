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
        Schema::create('lkpds', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Siswa
            |--------------------------------------------------------------------------
            */

            $table->foreignId('student_id')
                ->constrained('students')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Pertemuan
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('pertemuan');


            /*
            |--------------------------------------------------------------------------
            | Foto tugas
            |--------------------------------------------------------------------------
            */

            $table->string('foto');


            /*
            |--------------------------------------------------------------------------
            | Timestamp
            |--------------------------------------------------------------------------
            */

            $table->timestamps();


            /*
            |--------------------------------------------------------------------------
            | Satu siswa hanya boleh mengumpulkan
            | satu LKPD pada setiap pertemuan.
            |--------------------------------------------------------------------------
            */

            $table->unique([
                'student_id',
                'pertemuan',
            ]);

        });
    }


    /**
     * Balikkan migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('lkpds');
    }
};