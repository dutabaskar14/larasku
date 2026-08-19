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
        Schema::create('assignment_meetings', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Kelas
            |--------------------------------------------------------------------------
            |
            | Pertemuan tugas dibuat khusus untuk kelas tertentu.
            |
            */

            $table->string('kelas', 50);


            /*
            |--------------------------------------------------------------------------
            | Nomor Pertemuan
            |--------------------------------------------------------------------------
            |
            | Guru bebas membuat nomor pertemuan:
            | 1, 2, 4, 5, 8, dst.
            |
            */

            $table->unsignedInteger('pertemuan');


            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            $table->boolean('aktif')
                ->default(true);


            /*
            |--------------------------------------------------------------------------
            | Timestamp
            |--------------------------------------------------------------------------
            */

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


            /*
            |--------------------------------------------------------------------------
            | Satu Pertemuan Tidak Boleh Dobel Dalam Satu Kelas
            |--------------------------------------------------------------------------
            */

            $table->unique([
                'kelas',
                'pertemuan',
            ]);

        });
    }


    /**
     * Balikkan migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignment_meetings');
    }
};