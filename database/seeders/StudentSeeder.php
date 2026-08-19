<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\ClassRoom;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | BUAT / PASTIKAN KELAS VIII D
        |--------------------------------------------------------------------------
        */

        ClassRoom::firstOrCreate(
            [
                'nama' => 'VIII D',
            ],
            [
                'aktif' => true,
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | DATA SISWA
        |--------------------------------------------------------------------------
        */

        $students = [
            'AGNIA RAYYISA ISKANDAR',
            'ALDEBARAN NAGA ADNRIANTO',
            'ALIFA KHOIRUNNISA KUSNANDAR',
            'AZIZAH RAIYA HUMAIRA',
            'BILQIS NAURA ATIFA',
            'CARISSA NUR AZIZAH',
            'FADLI ARRASYID WIBOWO',
            'FAUZIAH OKTAVIANA',
            'FEBYOLLA AZ -ZAHRA',
            'GHAISANO SATRIA ADITYA',
            'KHANZA SALMA',
            'KHAYLA AFIQAH RAIHANNAH',
            'MOCHAMAD GIO SYAHPUTRA',
            'MUCHAMAD ALLDIYON ANUGRAH',
            'MUHAMAD ALDO ALDIANSYAH',
            'MUHAMMAD ACENG ZULFAN',
            'MUHAMMAD ADIKA RAMADHAN',
            'MUHAMMAD MULQY FATURRAHMAN',
            'MUHAMMAD NATHAN AL-GHIFARI',
            'NABIL AZKA KIRANA',
            'NAUVAL AL HAKIM DWI PUTRA',
            'NAZWAR ADITIA RAZAQ',
            'NISA NUR KOMALASARI',
            'PEBRI MUHAMAD ROHMAN',
            'RAFA NADIA SAPUTRA',
            'RAIQA SALSABILA PRATAMA',
            'RAYI MAKKI RAHMAYADI',
            'SAFIRA AULIA RIZKIANTI',
            'SALMA KEYSHА OKTAVIANY',
            'SALWA NABILA ANSARIA',
            'SHAKILA PUTRI DIANLA',
            'SILVI ARDIANI PUTRI',
            'SILVIA SAKILA ALVIANI',
            'ZHIAN ASRA PRAYOGA',
        ];


        /*
        |--------------------------------------------------------------------------
        | SIMPAN 34 SISWA
        |--------------------------------------------------------------------------
        */

        foreach ($students as $index => $nama) {

            Student::create([
                'nama' => $nama,
                'kelas' => 'VIII D',
                'nomor_absen' => $index + 1,
                'aktif' => true,
            ]);
        }
    }
}