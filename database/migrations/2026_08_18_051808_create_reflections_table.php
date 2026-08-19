<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reflections', function (Blueprint $table) {
            $table->id();

            $table->string('nama');
            $table->string('nomor_absen', 20);

            $table->unsignedTinyInteger('pertemuan');

            $table->text('jawaban_1');
            $table->text('jawaban_2');
            $table->text('jawaban_3');
            $table->text('jawaban_4');
            $table->text('jawaban_5');

            $table->timestamps();

            $table->unique(
                ['nama', 'nomor_absen', 'pertemuan'],
                'reflection_student_meeting_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reflections');
    }
};