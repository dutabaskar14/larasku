<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reflections', function (Blueprint $table) {

            $table->string('judul')
                ->nullable()
                ->after('pertemuan');

            $table->text('deskripsi')
                ->nullable()
                ->after('judul');

            $table->boolean('aktif')
                ->default(false)
                ->after('deskripsi');

        });
    }

    public function down(): void
    {
        Schema::table('reflections', function (Blueprint $table) {

            $table->dropColumn([
                'judul',
                'deskripsi',
                'aktif',
            ]);

        });
    }
};