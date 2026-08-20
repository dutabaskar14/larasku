<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Attendance;
use App\Models\QuizAttempt;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | SISWA
        |--------------------------------------------------------------------------
        */

        $totalStudents = Student::count();

        $activeStudents = Student::where('aktif', true)
            ->count();


        /*
        |--------------------------------------------------------------------------
        | ABSENSI
        |--------------------------------------------------------------------------
        */

        $attendanceToday = Attendance::whereDate(
            'tanggal',
            today()
        )->count();

        $totalHadir = Attendance::where(
            'status',
            'hadir'
        )->count();

        $totalAttendance = Attendance::count();

        $attendancePercentage = $totalAttendance > 0
            ? round(
                ($totalHadir / $totalAttendance) * 100,
                1
            )
            : 0;


        /*
        |--------------------------------------------------------------------------
        | QUIZ
        |--------------------------------------------------------------------------
        */

        $quizCompleted = QuizAttempt::count();

        $quizAverage = $quizCompleted > 0
            ? round(
                QuizAttempt::avg('nilai'),
                1
            )
            : 0;

        $quizStudents = QuizAttempt::query()
            ->distinct()
            ->count('student_id');


        /*
        |--------------------------------------------------------------------------
        | PROGRESS QUIZ
        |--------------------------------------------------------------------------
        */

        $quizProgressPercentage = $activeStudents > 0
            ? round(
                ($quizStudents / $activeStudents) * 100,
                1
            )
            : 0;


        /*
        |--------------------------------------------------------------------------
        | LKPD
        |--------------------------------------------------------------------------
        */

        $lkpdCount = 0;

        if (Schema::hasTable('lkpds')) {
            $lkpdCount = DB::table('lkpds')->count();
        }


        /*
        |--------------------------------------------------------------------------
        | PRAKTIK
        |--------------------------------------------------------------------------
        |
        | Fitur Praktik menggunakan tabel assignments.
        |
        */

        $practiceCount = 0;

        if (Schema::hasTable('assignments')) {
            $practiceCount = Assignment::count();
        }


        /*
        |--------------------------------------------------------------------------
        | REFLEKSI
        |--------------------------------------------------------------------------
        */

        $reflectionCount = 0;

        if (Schema::hasTable('reflections')) {
            $reflectionCount = DB::table('reflections')->count();
        }


        /*
        |--------------------------------------------------------------------------
        | VIDEO
        |--------------------------------------------------------------------------
        */

        $videoCount = 0;

        if (Schema::hasTable('videos')) {
            $videoCount = DB::table('videos')->count();
        }


        /*
        |--------------------------------------------------------------------------
        | MATERI
        |--------------------------------------------------------------------------
        */

        $materialCount = 0;

        if (Schema::hasTable('materials')) {
            $materialCount = DB::table('materials')->count();
        }


        /*
        |--------------------------------------------------------------------------
        | AKTIVITAS SISWA
        |--------------------------------------------------------------------------
        |
        | Menggabungkan aktivitas absensi dan quiz terbaru.
        | Tidak mengubah data atau alur fitur yang sudah ada.
        |
        */

        $studentActivities = collect();


        /*
        |--------------------------------------------------------------------------
        | AKTIVITAS QUIZ
        |--------------------------------------------------------------------------
        */

        $quizActivities = QuizAttempt::query()
            ->with([
                'student',
                'quiz',
            ])
            ->latest('dikerjakan_at')
            ->limit(8)
            ->get()
            ->map(function ($attempt) {

                return [
                    'student' => $attempt->student?->nama ?? 'Siswa',
                    'description' =>
                        'Mengerjakan Quiz: ' .
                        ($attempt->quiz?->judul ?? 'Quiz'),
                    'icon' => 'clipboard-check',
                    'value' => $attempt->nilai !== null
                        ? number_format($attempt->nilai, 0)
                        : null,
                    'time' => $attempt->dikerjakan_at
                        ? $attempt->dikerjakan_at->format('d/m/Y H:i')
                        : null,
                    'timestamp' => $attempt->dikerjakan_at,
                ];
            });


        $studentActivities = $studentActivities
            ->merge($quizActivities);


        /*
        |--------------------------------------------------------------------------
        | AKTIVITAS ABSENSI
        |--------------------------------------------------------------------------
        */

        $attendanceActivities = Attendance::query()
            ->with('student')
            ->latest('created_at')
            ->limit(8)
            ->get()
            ->map(function ($attendance) {

                return [
                    'student' => $attendance->student?->nama ?? 'Siswa',
                    'description' =>
                        'Absensi: ' .
                        ucfirst($attendance->status) .
                        ' — Pertemuan ' .
                        $attendance->pertemuan,
                    'icon' => 'calendar-check',
                    'value' => null,
                    'time' => $attendance->created_at
                        ? $attendance->created_at->format('d/m/Y H:i')
                        : null,
                    'timestamp' => $attendance->created_at,
                ];
            });


        $studentActivities = $studentActivities
            ->merge($attendanceActivities)
            ->sortByDesc(
                fn ($activity) => $activity['timestamp']
            )
            ->take(12)
            ->values();


        /*
        |--------------------------------------------------------------------------
        | REKAP STATUS KEHADIRAN
        |--------------------------------------------------------------------------
        */

        $attendanceSummary = [
            'hadir' => Attendance::where(
                'status',
                'hadir'
            )->count(),

            'sakit' => Attendance::where(
                'status',
                'sakit'
            )->count(),

            'izin' => Attendance::where(
                'status',
                'izin'
            )->count(),

            'alfa' => Attendance::where(
                'status',
                'alfa'
            )->count(),

            'dispensasi' => Attendance::where(
                'status',
                'dispensasi'
            )->count(),
        ];


        /*
        |--------------------------------------------------------------------------
        | DATA DASHBOARD
        |--------------------------------------------------------------------------
        */

        return view(
            'guru.dashboard',
            compact(
                'totalStudents',
                'activeStudents',
                'attendanceToday',
                'totalHadir',
                'totalAttendance',
                'attendancePercentage',
                'quizCompleted',
                'quizAverage',
                'quizStudents',
                'quizProgressPercentage',
                'lkpdCount',
                'practiceCount',
                'reflectionCount',
                'videoCount',
                'materialCount',
                'studentActivities',
                'attendanceSummary'
            )
        );
    }
}
