<?php

namespace App\Services;

use App\Models\AssignmentSubmission;
use App\Models\Attendance;
use App\Models\LKPDAnswer;
use App\Models\QuizAttempt;
use App\Models\ReflectionAnswer;
use App\Models\Student;
use Illuminate\Support\Collection;

class GradeCalculationService
{
    /*
    |--------------------------------------------------------------------------
    | BOBOT NILAI
    |--------------------------------------------------------------------------
    */

    public const WEIGHT_ATTENDANCE = 0.10;

    public const WEIGHT_LKPD = 0.30;

    public const WEIGHT_QUIZ = 0.25;

    public const WEIGHT_PRACTICE = 0.25;

    public const WEIGHT_REFLECTION = 0.10;


    /*
    |--------------------------------------------------------------------------
    | HITUNG NILAI SISWA
    |--------------------------------------------------------------------------
    */

    public function calculate(Student $student): array
    {
        $attendance = $this->attendanceScore($student);

        $lkpd = $this->lkpdScore($student);

        $quiz = $this->quizScore($student);

        $practice = $this->practiceScore($student);

        $reflection = $this->reflectionScore($student);


        $finalScore =
            ($attendance * self::WEIGHT_ATTENDANCE)
            +
            ($lkpd * self::WEIGHT_LKPD)
            +
            ($quiz * self::WEIGHT_QUIZ)
            +
            ($practice * self::WEIGHT_PRACTICE)
            +
            ($reflection * self::WEIGHT_REFLECTION);


        return [
            'attendance' => round($attendance, 2),

            'lkpd' => round($lkpd, 2),

            'quiz' => round($quiz, 2),

            'practice' => round($practice, 2),

            'reflection' => round($reflection, 2),

            'final' => round($finalScore, 2),
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | ABSENSI
    |--------------------------------------------------------------------------
    |
    | Pertemuan dihitung berdasarkan pertemuan yang memang sudah memiliki
    | data absensi.
    |
    | Contoh:
    |
    | Pertemuan 1 sudah ada data absensi
    | Pertemuan 2 belum ada data
    |
    | Maka hanya Pertemuan 1 yang dihitung.
    |
    | Jika siswa tidak mempunyai record pada pertemuan yang sudah
    | berlangsung, siswa dianggap ALFA.
    |
    */

    public function attendanceScore(Student $student): float
    {
        /*
        |--------------------------------------------------------------------------
        | Ambil semua pertemuan yang sudah berlangsung
        |--------------------------------------------------------------------------
        */

        $activeMeetings = Attendance::query()
            ->select('pertemuan')
            ->distinct()
            ->orderBy('pertemuan')
            ->pluck('pertemuan');


        /*
        |--------------------------------------------------------------------------
        | Belum ada pertemuan yang memiliki absensi
        |--------------------------------------------------------------------------
        */

        if ($activeMeetings->isEmpty()) {
            return 0;
        }


        /*
        |--------------------------------------------------------------------------
        | Ambil absensi siswa untuk pertemuan tersebut
        |--------------------------------------------------------------------------
        */

        $records = Attendance::query()
            ->where(
                'student_id',
                $student->id
            )
            ->whereIn(
                'pertemuan',
                $activeMeetings
            )
            ->get()
            ->keyBy('pertemuan');


        /*
        |--------------------------------------------------------------------------
        | Hitung kehadiran
        |--------------------------------------------------------------------------
        |
        | Jika tidak ada record:
        | dianggap alfa.
        |
        */

        $totalMeetings =
            $activeMeetings->count();


        $hadir = 0;


        foreach ($activeMeetings as $pertemuan) {

            $record =
                $records->get($pertemuan);


            if (
                $record &&
                $record->status === 'hadir'
            ) {

                $hadir++;

            }

        }


        /*
        |--------------------------------------------------------------------------
        | Persentase
        |--------------------------------------------------------------------------
        */

        return round(
            ($hadir / $totalMeetings) * 100,
            2
        );
    }


    /*
    |--------------------------------------------------------------------------
    | LKPD
    |--------------------------------------------------------------------------
    */

    public function lkpdScore(Student $student): float
    {
        $answers = LKPDAnswer::query()
            ->where(
                'student_id',
                $student->id
            )
            ->whereNotNull('nilai')
            ->get();


        return $this->average(
            $answers,
            'nilai'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | QUIZ
    |--------------------------------------------------------------------------
    */

    public function quizScore(Student $student): float
    {
        $attempts = QuizAttempt::query()
            ->where(
                'student_id',
                $student->id
            )
            ->whereNotNull('nilai')
            ->get();


        return $this->average(
            $attempts,
            'nilai'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | PRAKTIK
    |--------------------------------------------------------------------------
    |
    | Praktik individu:
    | nilai berasal dari student_id.
    |
    | Praktik kelompok:
    | nilai submission kelompok diberikan kepada seluruh anggota kelompok.
    |
    */

    public function practiceScore(Student $student): float
    {
        /*
        |--------------------------------------------------------------------------
        | PRAKTIK INDIVIDU
        |--------------------------------------------------------------------------
        */

        $individualScores = AssignmentSubmission::query()
            ->where(
                'student_id',
                $student->id
            )
            ->whereNull(
                'assignment_group_id'
            )
            ->whereNotNull('nilai')
            ->pluck('nilai')
            ->map(
                fn ($value) =>
                    (float) $value
            )
            ->values();


        /*
        |--------------------------------------------------------------------------
        | PRAKTIK KELOMPOK
        |--------------------------------------------------------------------------
        */

        $groupScores = AssignmentSubmission::query()
            ->whereNotNull(
                'assignment_group_id'
            )
            ->whereNotNull('nilai')
            ->whereHas(
                'group.members',
                function ($query) use ($student) {

                    $query->where(
                        'student_id',
                        $student->id
                    );

                }
            )
            ->pluck('nilai')
            ->map(
                fn ($value) =>
                    (float) $value
            )
            ->values();


        /*
        |--------------------------------------------------------------------------
        | GABUNGKAN
        |--------------------------------------------------------------------------
        */

        $scores = $individualScores
            ->merge(
                $groupScores
            );


        if ($scores->isEmpty()) {
            return 0;
        }


        return round(
            $scores->avg(),
            2
        );
    }


    /*
    |--------------------------------------------------------------------------
    | REFLEKSI
    |--------------------------------------------------------------------------
    */

    public function reflectionScore(Student $student): float
    {
        $answers = ReflectionAnswer::query()
            ->where(
                'student_id',
                $student->id
            )
            ->whereNotNull('nilai')
            ->get();


        return $this->average(
            $answers,
            'nilai'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | RATA-RATA
    |--------------------------------------------------------------------------
    */

    protected function average(
        Collection $items,
        string $column
    ): float {

        if ($items->isEmpty()) {
            return 0;
        }


        return round(
            $items->avg(
                fn ($item) =>
                    (float) $item->{$column}
            ),
            2
        );
    }


    /*
    |--------------------------------------------------------------------------
    | HITUNG BANYAK SISWA
    |--------------------------------------------------------------------------
    */

    public function calculateMany(
        Collection $students
    ): Collection {

        return $students
            ->map(
                function (Student $student) {

                    return [
                        'student' =>
                            $student,

                        'scores' =>
                            $this->calculate(
                                $student
                            ),
                    ];

                }
            );
    }
}