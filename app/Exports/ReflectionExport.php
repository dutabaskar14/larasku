<?php

namespace App\Exports;

use App\Models\ReflectionAnswer;
use App\Models\Student;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReflectionExport implements FromCollection, WithHeadings
{
    protected ?string $kelas;

    public function __construct(
        ?string $kelas = null
    ) {
        $this->kelas = $kelas;
    }


    /**
     * Data nilai refleksi siswa.
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


        $answers = ReflectionAnswer::query()
            ->whereNotNull('nilai')
            ->get()
            ->groupBy('student_id');


        return $students
            ->values()
            ->map(
                function ($student, $index) use ($answers) {

                    $studentAnswers =
                        $answers->get(
                            $student->id,
                            collect()
                        );


                    $nilai = $studentAnswers->isNotEmpty()
                        ? round(
                            $studentAnswers->avg(
                                fn ($answer) =>
                                    (float) $answer->nilai
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
            'Nilai Refleksi',
        ];
    }
}