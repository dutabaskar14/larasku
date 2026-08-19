<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assignment_group_members', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Kelompok
            |--------------------------------------------------------------------------
            */

            $table->foreignId('assignment_group_id')
                ->constrained('assignment_groups')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Siswa
            |--------------------------------------------------------------------------
            */

            $table->foreignId('student_id')
                ->constrained('students')
                ->cascadeOnDelete();


            $table->timestamps();


            /*
            |--------------------------------------------------------------------------
            | Satu siswa hanya boleh berada dalam
            | satu kelompok untuk satu tugas.
            |--------------------------------------------------------------------------
            */

            $table->unique([
                'assignment_group_id',
                'student_id',
            ]);


            $table->index('student_id');

        });
    }


    public function down(): void
    {
        Schema::dropIfExists('assignment_group_members');
    }
};