<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assignment_groups', function (Blueprint $table) {

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
            | Kelas
            |--------------------------------------------------------------------------
            */

            $table->string('kelas', 50);


            /*
            |--------------------------------------------------------------------------
            | Nomor Kelompok
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('nomor_kelompok');


            $table->timestamps();


            /*
            |--------------------------------------------------------------------------
            | Satu nomor kelompok tidak boleh duplikat
            | dalam tugas yang sama
            |--------------------------------------------------------------------------
            */

            $table->unique([
                'assignment_id',
                'nomor_kelompok',
            ]);


            $table->index([
                'assignment_id',
                'kelas',
            ]);

        });
    }


    public function down(): void
    {
        Schema::dropIfExists('assignment_groups');
    }
};