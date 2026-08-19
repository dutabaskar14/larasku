<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id')
                ->constrained('students')
                ->cascadeOnDelete();

            $table->unsignedTinyInteger('pertemuan');

            $table->date('tanggal')->nullable();

            $table->enum('status', [
                'hadir',
                'sakit',
                'izin',
                'alfa',
                'dispensasi',
            ])->default('hadir');

            $table->timestamps();

            $table->unique([
                'student_id',
                'pertemuan',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};