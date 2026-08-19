<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assignment_submissions', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Tugas
            |--------------------------------------------------------------------------
            */

            $table->foreignId('assignment_id')
                ->constrained('assignments')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Siswa
            |--------------------------------------------------------------------------
            |
            | Dipakai untuk tugas INDIVIDU.
            |
            */

            $table->foreignId('student_id')
                ->nullable()
                ->constrained('students')
                ->nullOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Kelompok
            |--------------------------------------------------------------------------
            |
            | Dipakai untuk tugas KELOMPOK.
            |
            */

            $table->foreignId('assignment_group_id')
                ->nullable()
                ->constrained('assignment_groups')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Link Hasil Pekerjaan
            |--------------------------------------------------------------------------
            */

            $table->text('link')->nullable();


            /*
            |--------------------------------------------------------------------------
            | Catatan Siswa
            |--------------------------------------------------------------------------
            */

            $table->text('catatan_siswa')->nullable();


            /*
            |--------------------------------------------------------------------------
            | Penilaian Guru
            |--------------------------------------------------------------------------
            */

            $table->decimal('nilai', 5, 2)->nullable();

            $table->text('catatan_guru')->nullable();


            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            $table->enum('status', [
                'belum_dinilai',
                'selesai',
            ])->default('belum_dinilai');


            /*
            |--------------------------------------------------------------------------
            | Waktu
            |--------------------------------------------------------------------------
            */

            $table->timestamp('submitted_at')->nullable();

            $table->timestamp('graded_at')->nullable();


            $table->timestamps();


            /*
            |--------------------------------------------------------------------------
            | Index
            |--------------------------------------------------------------------------
            */

            $table->index([
                'assignment_id',
                'student_id',
            ]);

            $table->index([
                'assignment_id',
                'assignment_group_id',
            ]);

        });
    }


    public function down(): void
    {
        Schema::dropIfExists('assignment_submissions');
    }
};