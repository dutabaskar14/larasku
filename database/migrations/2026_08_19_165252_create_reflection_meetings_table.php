<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Membuat tabel pertemuan Refleksi.
     *
     * Pertemuan Refleksi berdiri sendiri dan
     * tidak bergantung pada tabel materials.
     */
    public function up(): void
    {
        Schema::create('reflection_meetings', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | NOMOR PERTEMUAN
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('pertemuan');

            /*
            |--------------------------------------------------------------------------
            | TIMESTAMP
            |--------------------------------------------------------------------------
            */

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | SATU NOMOR PERTEMUAN HANYA BOLEH SATU
            |--------------------------------------------------------------------------
            */

            $table->unique(
                'pertemuan',
                'reflection_meetings_pertemuan_unique'
            );
        });
    }


    /**
     * Menghapus tabel pertemuan Refleksi.
     */
    public function down(): void
    {
        Schema::dropIfExists('reflection_meetings');
    }
};