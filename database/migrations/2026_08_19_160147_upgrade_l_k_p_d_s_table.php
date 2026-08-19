<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Upgrade struktur tabel LKPD lama
     * menjadi tabel induk LKPD guru.
     */
    public function up(): void
    {
        Schema::table('lkpds', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | HAPUS STRUKTUR LKPD LAMA
            |--------------------------------------------------------------------------
            |
            | Sistem lama:
            | - student_id
            | - foto
            |
            | Sistem baru menggunakan:
            | - lkpds sebagai induk tugas
            | - lkpd_questions sebagai soal
            | - lkpd_answers sebagai jawaban siswa
            |
            */

            $table->dropForeign([
                'student_id',
            ]);

            $table->dropUnique(
                'lkpds_student_id_pertemuan_unique'
            );

            $table->dropColumn([
                'student_id',
                'foto',
            ]);


            /*
            |--------------------------------------------------------------------------
            | INFORMASI LKPD
            |--------------------------------------------------------------------------
            */

            $table->string('judul')
                ->after('pertemuan');

            $table->text('deskripsi')
                ->nullable()
                ->after('judul');


            /*
            |--------------------------------------------------------------------------
            | STATUS LKPD
            |--------------------------------------------------------------------------
            |
            | false = belum tersedia untuk siswa
            | true  = tersedia untuk siswa
            |
            */

            $table->boolean('aktif')
                ->default(false)
                ->after('deskripsi');


            /*
            |--------------------------------------------------------------------------
            | SATU LKPD PER PERTEMUAN
            |--------------------------------------------------------------------------
            |
            | Nomor pertemuan dikelola sendiri oleh LKPD.
            | Tidak bergantung pada Material.
            |
            */

            $table->unique(
                'pertemuan',
                'lkpds_pertemuan_unique'
            );
        });
    }


    /**
     * Mengembalikan struktur LKPD lama.
     */
    public function down(): void
    {
        Schema::table('lkpds', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | HAPUS STRUKTUR BARU
            |--------------------------------------------------------------------------
            */

            $table->dropUnique(
                'lkpds_pertemuan_unique'
            );

            $table->dropColumn([
                'judul',
                'deskripsi',
                'aktif',
            ]);


            /*
            |--------------------------------------------------------------------------
            | KEMBALIKAN STRUKTUR LAMA
            |--------------------------------------------------------------------------
            */

            $table->foreignId('student_id')
                ->after('id')
                ->constrained('students')
                ->cascadeOnDelete();

            $table->string('foto')
                ->after('pertemuan');


            $table->unique(
                [
                    'student_id',
                    'pertemuan',
                ],
                'lkpds_student_id_pertemuan_unique'
            );
        });
    }
};