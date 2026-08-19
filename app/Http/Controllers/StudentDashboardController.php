<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\LKPD;
use App\Models\Material;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\Reflection;
use App\Models\Student;

class StudentDashboardController extends Controller
{
    /**
     * Dashboard siswa.
     */
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | IDENTITAS SISWA
        |--------------------------------------------------------------------------
        */

        $studentId = session('student_id');

        if (!$studentId) {
            return redirect()
                ->route('attendance.index')
                ->with(
                    'success',
                    'Silakan pilih nama dan lakukan absensi terlebih dahulu.'
                );
        }

        $student = Student::where('id', $studentId)
            ->where('aktif', true)
            ->first();

        if (!$student) {
            session()->forget('student_id');

            return redirect()
                ->route('attendance.index')
                ->with(
                    'success',
                    'Data siswa tidak ditemukan. Silakan pilih kembali.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | TOTAL PERTEMUAN
        |--------------------------------------------------------------------------
        */

        $totalPertemuan = 8;

        /*
        |--------------------------------------------------------------------------
        | MATERI PEMBELAJARAN
        |--------------------------------------------------------------------------
        |
        | Hanya materi aktif yang ditampilkan di dashboard siswa.
        |
        */

        $materials = Material::where('aktif', true)
            ->orderBy('pertemuan')
            ->orderBy('id')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | PROGRES ABSENSI
        |--------------------------------------------------------------------------
        |
        | Hanya status hadir yang dihitung sebagai kehadiran.
        |
        */

        $attendanceCompleted = Attendance::where(
            'student_id',
            $student->id
        )
            ->where('status', 'hadir')
            ->whereBetween('pertemuan', [1, $totalPertemuan])
            ->distinct('pertemuan')
            ->count('pertemuan');

        $attendanceProgress = min(
            $attendanceCompleted,
            $totalPertemuan
        );

        /*
        |--------------------------------------------------------------------------
        | PROGRES QUIZ
        |--------------------------------------------------------------------------
        |
        | Setiap quiz yang sudah dikerjakan dihitung satu kali.
        |
        */

        $totalQuiz = Quiz::count();

        $quizCompleted = QuizAttempt::where(
            'student_id',
            $student->id
        )
            ->whereHas('quiz')
            ->distinct('quiz_id')
            ->count('quiz_id');

        $quizCompleted = min(
            $quizCompleted,
            $totalQuiz
        );

        /*
        |--------------------------------------------------------------------------
        | PROGRES REFLEKSI
        |--------------------------------------------------------------------------
        |
        | Satu refleksi per pertemuan dihitung satu kali.
        |
        */

        $reflectionCompleted = Reflection::where(
            'student_id',
            $student->id
        )
            ->whereBetween('pertemuan', [1, $totalPertemuan])
            ->distinct('pertemuan')
            ->count('pertemuan');

        $reflectionProgress = min(
            $reflectionCompleted,
            $totalPertemuan
        );

        /*
        |--------------------------------------------------------------------------
        | PROGRES LKPD
        |--------------------------------------------------------------------------
        |
        | Satu LKPD per pertemuan dihitung satu kali.
        |
        */

        $lkpdCompleted = LKPD::where(
            'student_id',
            $student->id
        )
            ->whereBetween('pertemuan', [1, $totalPertemuan])
            ->distinct('pertemuan')
            ->count('pertemuan');

        $lkpdProgress = min(
            $lkpdCompleted,
            $totalPertemuan
        );

        /*
        |--------------------------------------------------------------------------
        | PERSENTASE PROGRES
        |--------------------------------------------------------------------------
        */

        $attendancePercentage = round(
            ($attendanceProgress / $totalPertemuan) * 100
        );

        $reflectionPercentage = round(
            ($reflectionProgress / $totalPertemuan) * 100
        );

        $lkpdPercentage = round(
            ($lkpdProgress / $totalPertemuan) * 100
        );

        $quizPercentage = $totalQuiz > 0
            ? round(
                ($quizCompleted / $totalQuiz) * 100
            )
            : 0;

        /*
        |--------------------------------------------------------------------------
        | DATA DASHBOARD
        |--------------------------------------------------------------------------
        */

        return view(
            'student.dashboard',
            compact(
                'student',

                'totalPertemuan',

                'materials',

                'attendanceProgress',
                'attendancePercentage',

                'totalQuiz',
                'quizCompleted',
                'quizPercentage',

                'reflectionProgress',
                'reflectionPercentage',

                'lkpdProgress',
                'lkpdPercentage'
            )
        );
    }
}