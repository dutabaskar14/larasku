<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | HAPUS FOREIGN KEY LAMA
        |--------------------------------------------------------------------------
        */

        Schema::table('reflections', function (Blueprint $table) {
            $table->dropForeign(['student_id']);
        });


        /*
        |--------------------------------------------------------------------------
        | HAPUS UNIQUE INDEX LAMA
        |--------------------------------------------------------------------------
        */

        Schema::table('reflections', function (Blueprint $table) {
            $table->dropUnique(
                'reflection_student_meeting_unique'
            );
        });


        /*
        |--------------------------------------------------------------------------
        | HAPUS KOLOM LAMA
        |--------------------------------------------------------------------------
        */

        Schema::table('reflections', function (Blueprint $table) {
            $table->dropColumn([
                'student_id',
                'jawaban_1',
                'jawaban_2',
                'jawaban_3',
                'jawaban_4',
                'jawaban_5',
            ]);
        });
    }


    public function down(): void
    {
        /*
        |--------------------------------------------------------------------------
        | KEMBALIKAN KOLOM LAMA
        |--------------------------------------------------------------------------
        */

        Schema::table('reflections', function (Blueprint $table) {

            $table->foreignId('student_id')
                ->nullable()
                ->constrained('students')
                ->nullOnDelete();

            $table->text('jawaban_1')
                ->nullable();

            $table->text('jawaban_2')
                ->nullable();

            $table->text('jawaban_3')
                ->nullable();

            $table->text('jawaban_4')
                ->nullable();

            $table->text('jawaban_5')
                ->nullable();
        });


        /*
        |--------------------------------------------------------------------------
        | KEMBALIKAN UNIQUE INDEX LAMA
        |--------------------------------------------------------------------------
        */

        Schema::table('reflections', function (Blueprint $table) {

            $table->unique(
                [
                    'student_id',
                    'pertemuan',
                ],
                'reflection_student_meeting_unique'
            );
        });
    }
};