<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reflections', function (Blueprint $table) {
            $table->foreignId('student_id')
                ->after('id')
                ->constrained('students')
                ->cascadeOnDelete();
        });

        Schema::table('reflections', function (Blueprint $table) {
            $table->dropUnique('reflection_student_meeting_unique');

            $table->unique(
                ['student_id', 'pertemuan'],
                'reflection_student_meeting_unique'
            );

            $table->dropColumn([
                'nama',
                'nomor_absen',
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('reflections', function (Blueprint $table) {
            $table->string('nama')->after('student_id');
            $table->string('nomor_absen', 20)->after('nama');
        });

        Schema::table('reflections', function (Blueprint $table) {
            $table->dropUnique('reflection_student_meeting_unique');

            $table->unique(
                ['nama', 'nomor_absen', 'pertemuan'],
                'reflection_student_meeting_unique'
            );

            $table->dropForeign(['student_id']);
            $table->dropColumn('student_id');
        });
    }
};