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
        Schema::create('material_meetings', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Nomor Pertemuan
            |--------------------------------------------------------------------------
            |
            | Contoh:
            | 1 = Pertemuan 1
            | 2 = Pertemuan 2
            | 8 = Pertemuan 8
            |
            */

            $table->unsignedTinyInteger('pertemuan');


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
            | Satu nomor pertemuan tidak boleh duplikat
            |--------------------------------------------------------------------------
            */

            $table->unique('pertemuan');


            /*
            |--------------------------------------------------------------------------
            | Index status
            |--------------------------------------------------------------------------
            */

            $table->index('aktif');

        });
    }


    /**
     * Balikkan migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_meetings');
    }
};