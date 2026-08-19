<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quizzes', function (Blueprint $table) {

            $table->id();

            $table->unsignedTinyInteger('pertemuan');

            $table->string('judul');

            $table->text('deskripsi')->nullable();

            $table->boolean('aktif')->default(true);

            $table->timestamps();

            $table->unique('pertemuan');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};