<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StudentsExport implements FromCollection, WithHeadings, WithMapping
{
    protected ?string $kelas;

    /**
     * Filter kelas.
     */
    public function __construct(?string $kelas = null)
    {
        $this->kelas = $kelas;
    }


    /**
     * Data siswa berdasarkan kelas dan nomor absen.
     */
    public function collection()
    {
        return Student::query()
            ->when(
                $this->kelas,
                function ($query) {
                    $query->where(
                        'kelas',
                        $this->kelas
                    );
                }
            )
            ->orderByRaw(
                'CAST(nomor_absen AS INTEGER) ASC'
            )
            ->get();
    }


    /**
     * Header Excel.
     */
    public function headings(): array
    {
        return [
            'No',
            'Nomor Absen',
            'Nama Siswa',
            'Kelas',
            'Status',
        ];
    }


    /**
     * Format setiap baris.
     */
    public function map($student): array
    {
        static $no = 0;

        $no++;

        return [
            $no,
            $student->nomor_absen,
            $student->nama,
            $student->kelas,
            $student->aktif
                ? 'Aktif'
                : 'Nonaktif',
        ];
    }
}