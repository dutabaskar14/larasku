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

            // Pertemuan 1 - 8
            $table->unsignedTinyInteger('pertemuan');

            // Judul materi
            $table->string('judul');

            // Kategori materi
            $table->string('kategori')->nullable();

            // Isi materi utama
            $table->longText('isi')->nullable();

            // Media pembelajaran
            $table->string('gambar')->nullable();
            $table->string('video_url')->nullable();
            $table->string('audio_url')->nullable();

            // Status materi
            $table->boolean('aktif')->default(true);

            $table->timestamps();

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