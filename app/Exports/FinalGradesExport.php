<?php

namespace App\Exports;

use App\Models\Student;
use App\Services\GradeCalculationService;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FinalGradesExport implements FromCollection, WithHeadings
{
    protected ?string $kelas;

    protected GradeCalculationService $gradeService;


    /**
     * Constructor.
     */
    public function __construct(
        ?string $kelas = null
    ) {
        $this->kelas = $kelas;

        $this->gradeService =
            app(GradeCalculationService::class);
    }


    /**
     * Data nilai akhir siswa.
     */
    public function collection(): Collection
    {
        $students = Student::query()
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


        return $students
            ->values()
            ->map(
                function ($student, $index) {

                    $scores =
                        $this->gradeService
                            ->calculate($student);


                    return [
                        $index + 1,
                        $student->nomor_absen,
                        $student->nama,
                        $student->kelas,

                        $scores['attendance'],
                        $scores['lkpd'],
                        $scores['quiz'],
                        $scores['practice'],
                        $scores['reflection'],

                        $scores['final'],
                    ];
                }
            );
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
            'Absensi (10%)',
            'LKPD (30%)',
            'Quiz (25%)',
            'Praktik (25%)',
            'Refleksi (10%)',
            'Nilai Akhir',
        ];
    }
}