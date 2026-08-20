<?php

namespace App\Exports;

use App\Models\QuizAttempt;
use App\Models\Student;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class QuizExport implements FromCollection, WithHeadings
{
    protected ?string $kelas;

    public function __construct(
        ?string $kelas = null
    ) {
        $this->kelas = $kelas;
    }


    /**
     * Data nilai Quiz siswa.
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


        $attempts = QuizAttempt::query()
            ->whereNotNull('nilai')
            ->get()
            ->groupBy('student_id');


        return $students
            ->values()
            ->map(
                function ($student, $index) use ($attempts) {

                    $studentAttempts =
                        $attempts->get(
                            $student->id,
                            collect()
                        );


                    $nilai = $studentAttempts->isNotEmpty()
                        ? round(
                            $studentAttempts->avg(
                                fn ($attempt) =>
                                    (float) $attempt->nilai
                            ),
                            2
                        )
                        : 0;


                    return [
                        $index + 1,
                        $student->nomor_absen,
                        $student->nama,
                        $student->kelas,
                        $nilai,
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
            'Nilai Quiz',
        ];
    }
}