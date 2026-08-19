<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reflection_answers', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | REFLEKSI
            |--------------------------------------------------------------------------
            */

            $table->foreignId('reflection_id')
                ->constrained('reflections')
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
            | PERTANYAAN REFLEKSI
            |--------------------------------------------------------------------------
            */

            $table->foreignId('reflection_question_id')
                ->constrained('reflection_questions')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | JAWABAN ESSAY
            |--------------------------------------------------------------------------
            */

            $table->text('jawaban')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | NILAI MANUAL GURU
            |--------------------------------------------------------------------------
            |
            | NULL = belum dinilai
            | 0-100 = sudah dinilai
            |
            */

            $table->unsignedTinyInteger('nilai')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | WAKTU SELESAI PENILAIAN
            |--------------------------------------------------------------------------
            */

            $table->timestamp('dinilai_at')
                ->nullable();

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | SATU JAWABAN SISWA UNTUK SATU SOAL
            |--------------------------------------------------------------------------
            */

            $table->unique(
                [
                    'reflection_id',
                    'student_id',
                    'reflection_question_id',
                ],
                'reflection_answer_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reflection_answers');
    }
};