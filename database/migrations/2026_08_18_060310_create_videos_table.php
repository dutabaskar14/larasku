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
        Schema::create('videos', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Pertemuan
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('pertemuan');


            /*
            |--------------------------------------------------------------------------
            | Informasi Video
            |--------------------------------------------------------------------------
            */

            $table->string('judul');

            $table->text('youtube_url');

            $table->text('deskripsi')->nullable();


            /*
            |--------------------------------------------------------------------------
            | Urutan Video
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('urutan')
                ->default(1);


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
                'pertemuan',
                'urutan',
            ]);

        });
    }


    /**
     * Balikkan migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};