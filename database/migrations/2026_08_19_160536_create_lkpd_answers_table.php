<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lkpd_answers', function (Blueprint $table) {

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
            | SISWA
            |--------------------------------------------------------------------------
            */

            $table->foreignId('student_id')
                ->constrained('students')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | SOAL
            |--------------------------------------------------------------------------
            */

            $table->foreignId('lkpd_question_id')
                ->constrained('lkpd_questions')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | JAWABAN SISWA
            |--------------------------------------------------------------------------
            |
            | PG  : menyimpan A/B/C/D
            | Essay: menyimpan teks jawaban
            |
            */

            $table->text('jawaban')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | NILAI
            |--------------------------------------------------------------------------
            |
            | PG    : diisi otomatis oleh sistem
            | Essay : diisi manual oleh guru
            | NULL  : belum dinilai
            |
            */

            $table->unsignedTinyInteger('nilai')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | WAKTU PENILAIAN
            |--------------------------------------------------------------------------
            */

            $table->timestamp('dinilai_at')
                ->nullable();


            $table->timestamps();


            /*
            |--------------------------------------------------------------------------
            | SATU JAWABAN PER SOAL
            |--------------------------------------------------------------------------
            |
            | Satu siswa hanya mempunyai satu jawaban
            | untuk satu soal pada satu LKPD.
            |
            */

            $table->unique(
                [
                    'lkpd_id',
                    'student_id',
                    'lkpd_question_id',
                ],
                'lkpd_answer_unique'
            );


            /*
            |--------------------------------------------------------------------------
            | INDEX
            |--------------------------------------------------------------------------
            */

            $table->index([
                'lkpd_id',
                'student_id',
            ]);
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('lkpd_answers');
    }
};