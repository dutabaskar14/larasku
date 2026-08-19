<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reflections', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | PERTEMUAN
            |--------------------------------------------------------------------------
            |
            | Mengikuti pertemuan yang tersedia pada Material.
            | Tidak dibatasi 1-8.
            |
            */

            $table->unsignedInteger('pertemuan');

            /*
            |--------------------------------------------------------------------------
            | INFORMASI REFLEKSI
            |--------------------------------------------------------------------------
            */

            $table->string('judul');

            $table->text('deskripsi')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | STATUS
            |--------------------------------------------------------------------------
            |
            | true  = aktif dan dapat dilihat siswa
            | false = nonaktif / disembunyikan
            |
            */

            $table->boolean('aktif')
                ->default(false);

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | SATU REFLEKSI PER PERTEMUAN
            |--------------------------------------------------------------------------
            */

            $table->unique(
                'pertemuan',
                'reflections_pertemuan_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reflections');
    }
};