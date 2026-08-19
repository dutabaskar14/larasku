<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assignments', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Kelas
            |--------------------------------------------------------------------------
            */

            $table->string('kelas', 50);


            /*
            |--------------------------------------------------------------------------
            | Pertemuan
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('pertemuan');


            /*
            |--------------------------------------------------------------------------
            | Informasi Tugas
            |--------------------------------------------------------------------------
            */

            $table->string('judul');

            $table->text('instruksi')->nullable();


            /*
            |--------------------------------------------------------------------------
            | Mode Pengumpulan
            |--------------------------------------------------------------------------
            |
            | individu = setiap siswa mengumpulkan sendiri
            | kelompok = satu pengumpulan untuk satu kelompok
            |
            */

            $table->enum('mode_pengumpulan', [
                'individu',
                'kelompok',
            ])->default('individu');


            /*
            |--------------------------------------------------------------------------
            | Tenggang Waktu
            |--------------------------------------------------------------------------
            */

            $table->dateTime('batas_waktu')->nullable();


            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            $table->boolean('aktif')->default(true);


            $table->timestamps();


            /*
            |--------------------------------------------------------------------------
            | Index
            |--------------------------------------------------------------------------
            */

            $table->index([
                'kelas',
                'pertemuan',
            ]);

        });
    }


    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};