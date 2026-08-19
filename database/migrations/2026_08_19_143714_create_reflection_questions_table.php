<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reflection_questions', function (Blueprint $table) {

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
            | URUTAN SOAL
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('urutan');

            /*
            |--------------------------------------------------------------------------
            | PERTANYAAN ESSAY
            |--------------------------------------------------------------------------
            */

            $table->text('pertanyaan');

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | INDEX
            |--------------------------------------------------------------------------
            */

            $table->index([
                'reflection_id',
                'urutan',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reflection_questions');
    }
};