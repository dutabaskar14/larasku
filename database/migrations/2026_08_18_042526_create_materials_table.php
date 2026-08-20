<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('materials', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Pertemuan
            |--------------------------------------------------------------------------
            |
            | Nomor pertemuan materi.
            | Daftar pertemuan dikelola melalui tabel
            | material_meetings yang akan ditambahkan terpisah.
            |
            */

            $table->unsignedTinyInteger('pertemuan');


            /*
            |--------------------------------------------------------------------------
            | Judul Materi
            |--------------------------------------------------------------------------
            */

            $table->string('judul');


            /*
            |--------------------------------------------------------------------------
            | Kategori Materi
            |--------------------------------------------------------------------------
            */

            $table->string('kategori')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Isi Materi
            |--------------------------------------------------------------------------
            */

            $table->longText('isi')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Media Pembelajaran
            |--------------------------------------------------------------------------
            */

            $table->string('gambar')
                ->nullable();

            $table->string('video_url')
                ->nullable();

            $table->string('audio_url')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Status Materi
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

            $table->index('pertemuan');

            $table->index('aktif');

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};