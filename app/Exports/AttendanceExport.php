<?php

namespace App\Exports;

use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AttendanceExport implements FromCollection, WithHeadings
{
    protected ?string $kelas;

    protected ?int $pertemuan;

    public function __construct(
        ?string $kelas = null,
        ?int $pertemuan = null
    ) {
        $this->kelas = $kelas;
        $this->pertemuan = $pertemuan;
    }


    /**
     * Data rekap absensi.
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


        $attendanceQuery = Attendance::query();


        if ($this->pertemuan !== null) {

            $attendanceQuery->where(
                'pertemuan',
                $this->pertemuan
            );

        }


        $attendances = $attendanceQuery
            ->get()
            ->groupBy('student_id');


        return $students->values()->map(
            function ($student, $index) use ($attendances) {

                $records = $attendances->get(
                    $student->id,
                    collect()
                );


                /*
                |--------------------------------------------------------------------------
                | Jika filter pertemuan dipilih
                |--------------------------------------------------------------------------
                */

                if ($this->pertemuan !== null) {

                    $record = $records
                        ->firstWhere(
                            'pertemuan',
                            $this->pertemuan
                        );


                    $status = $record
                        ? ucfirst($record->status)
                        : 'Alfa';


                    return collect([
                        $index + 1,
                        $student->nomor_absen,
                        $student->nama,
                        $student->kelas,
                        $status,
                    ]);
                }


                /*
                |--------------------------------------------------------------------------
                | Semua pertemuan yang sudah memiliki data absensi
                |--------------------------------------------------------------------------
                */

                $meetings = Attendance::query()
                    ->select('pertemuan')
                    ->distinct()
                    ->orderBy('pertemuan')
                    ->pluck('pertemuan');


                $row = collect([
                    $index + 1,
                    $student->nomor_absen,
                    $student->nama,
                    $student->kelas,
                ]);


                foreach ($meetings as $meeting) {

                    $record = $records
                        ->firstWhere(
                            'pertemuan',
                            $meeting
                        );


                    $row->push(
                        $record
                            ? ucfirst($record->status)
                            : 'Alfa'
                    );
                }


                /*
                |--------------------------------------------------------------------------
                | Persentase Kehadiran
                |--------------------------------------------------------------------------
                */

                $totalMeetings =
                    $meetings->count();


                $hadir =
                    $records
                        ->whereIn(
                            'pertemuan',
                            $meetings
                        )
                        ->where(
                            'status',
                            'hadir'
                        )
                        ->count();


                $percentage =
                    $totalMeetings > 0
                        ? round(
                            ($hadir / $totalMeetings) * 100,
                            2
                        ) . '%'
                        : '0%';


                $row->push(
                    $percentage
                );


                return $row;
            }
        );
    }


    /**
     * Header Excel.
     */
    public function headings(): array
    {
        $headings = [
            'No',
            'Nomor Absen',
            'Nama Siswa',
            'Kelas',
        ];


        if ($this->pertemuan !== null) {

            $headings[] =
                'Pertemuan ' .
                $this->pertemuan;

        } else {

            $meetings = Attendance::query()
                ->select('pertemuan')
                ->distinct()
                ->orderBy('pertemuan')
                ->pluck('pertemuan');


            foreach ($meetings as $meeting) {

                $headings[] =
                    'Pertemuan ' .
                    $meeting;
            }


            $headings[] =
                'Kehadiran';
        }


        return $headings;
    }
}