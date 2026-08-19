<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lkpd_questions', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | LKPD
            |--------------------------------------------------------------------------
            */

            $table->foreignId('lkpd_id')
                ->constrained('lkpds')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | URUTAN SOAL
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('urutan');


            /*
            |--------------------------------------------------------------------------
            | JENIS SOAL
            |--------------------------------------------------------------------------
            |
            | pilihan_ganda = soal pilihan ganda
            | essay         = soal essay
            |
            */

            $table->string('jenis', 20);


            /*
            |--------------------------------------------------------------------------
            | PERTANYAAN
            |--------------------------------------------------------------------------
            */

            $table->text('pertanyaan');


            /*
            |--------------------------------------------------------------------------
            | OPSI PILIHAN GANDA
            |--------------------------------------------------------------------------
            |
            | Untuk essay semua kolom ini NULL.
            |
            */

            $table->text('opsi_a')
                ->nullable();

            $table->text('opsi_b')
                ->nullable();

            $table->text('opsi_c')
                ->nullable();

            $table->text('opsi_d')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | JAWABAN BENAR
            |--------------------------------------------------------------------------
            |
            | Hanya digunakan untuk pilihan ganda.
            |
            | Contoh:
            | A
            | B
            | C
            | D
            |
            */

            $table->string('jawaban_benar', 1)
                ->nullable();


            $table->timestamps();


            /*
            |--------------------------------------------------------------------------
            | INDEX
            |--------------------------------------------------------------------------
            */

            $table->index([
                'lkpd_id',
                'urutan',
            ]);

            $table->index([
                'lkpd_id',
                'jenis',
            ]);
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('lkpd_questions');
    }
};