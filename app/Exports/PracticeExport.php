<?php

namespace App\Exports;

use App\Models\AssignmentSubmission;
use App\Models\Student;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PracticeExport implements FromCollection, WithHeadings
{
    protected ?string $kelas;

    public function __construct(
        ?string $kelas = null
    ) {
        $this->kelas = $kelas;
    }


    /**
     * Data nilai praktik siswa.
     *
     * Praktik individu:
     * menggunakan student_id.
     *
     * Praktik kelompok:
     * nilai submission diberikan kepada
     * seluruh anggota kelompok.
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


        /*
        |--------------------------------------------------------------------------
        | NILAI PRAKTIK INDIVIDU
        |--------------------------------------------------------------------------
        */

        $individualScores = AssignmentSubmission::query()
            ->whereNotNull('student_id')
            ->whereNull('assignment_group_id')
            ->whereNotNull('nilai')
            ->get()
            ->groupBy('student_id');


        /*
        |--------------------------------------------------------------------------
        | NILAI PRAKTIK KELOMPOK
        |--------------------------------------------------------------------------
        */

        $groupSubmissions = AssignmentSubmission::query()
            ->whereNotNull('assignment_group_id')
            ->whereNotNull('nilai')
            ->with('group.members')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | SIAPKAN NILAI PER SISWA
        |--------------------------------------------------------------------------
        */

        $scoresByStudent = collect();


        /*
        |--------------------------------------------------------------------------
        | MASUKKAN NILAI INDIVIDU
        |--------------------------------------------------------------------------
        */

        foreach ($individualScores as $studentId => $submissions) {

            $scoresByStudent->put(
                $studentId,
                $submissions
                    ->pluck('nilai')
                    ->map(
                        fn ($value) => (float) $value
                    )
                    ->values()
            );
        }


        /*
        |--------------------------------------------------------------------------
        | MASUKKAN NILAI KELOMPOK
        |--------------------------------------------------------------------------
        */

        foreach ($groupSubmissions as $submission) {

            $group = $submission->group;

            if (!$group) {
                continue;
            }


            foreach ($group->members as $member) {

                $studentId = $member->student_id;

                $currentScores =
                    $scoresByStudent->get(
                        $studentId,
                        collect()
                    );


                $currentScores->push(
                    (float) $submission->nilai
                );


                $scoresByStudent->put(
                    $studentId,
                    $currentScores
                );
            }
        }


        /*
        |--------------------------------------------------------------------------
        | HASIL EXPORT
        |--------------------------------------------------------------------------
        */

        return $students
            ->values()
            ->map(
                function ($student, $index) use (
                    $scoresByStudent
                ) {

                    $scores =
                        $scoresByStudent->get(
                            $student->id,
                            collect()
                        );


                    $nilai = $scores->isNotEmpty()
                        ? round(
                            $scores->avg(),
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
            'Nilai Praktik',
        ];
    }
}