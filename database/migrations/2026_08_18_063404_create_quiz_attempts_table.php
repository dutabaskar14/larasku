<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quiz_attempts', function (Blueprint $table) {

            $table->id();

            $table->foreignId('quiz_id')
                ->constrained('quizzes')
                ->cascadeOnDelete();

            $table->foreignId('student_id')
                ->constrained('students')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Jawaban siswa
            |--------------------------------------------------------------------------
            |
            | Contoh:
            | {
            |     "1": "A",
            |     "2": "C",
            |     "3": "B"
            | }
            |
            */

            $table->json('jawaban');

            $table->unsignedTinyInteger('jumlah_benar')->default(0);

            $table->unsignedTinyInteger('jumlah_soal')->default(0);

            $table->decimal('nilai', 5, 2)->default(0);

            $table->timestamp('dikerjakan_at')->nullable();

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | Satu siswa satu kali pengerjaan setiap quiz
            |--------------------------------------------------------------------------
            */

            $table->unique([
                'quiz_id',
                'student_id',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quiz_attempts');
    }
};