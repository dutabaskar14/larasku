<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
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
        | SISWA DENGAN NILAI QUIZ TERTINGGI
        |--------------------------------------------------------------------------
        */

        $topStudents = QuizAttempt::query()
            ->select(
                'student_id',
                DB::raw('AVG(nilai) as rata_nilai'),
                DB::raw('COUNT(*) as jumlah_quiz')
            )
            ->with('student')
            ->groupBy('student_id')
            ->orderByDesc('rata_nilai')
            ->limit(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | AKTIVITAS QUIZ TERBARU
        |--------------------------------------------------------------------------
        */

        $recentQuizAttempts = QuizAttempt::query()
            ->with([
                'student',
                'quiz',
            ])
            ->latest('dikerjakan_at')
            ->limit(8)
            ->get();


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
                'reflectionCount',
                'videoCount',
                'materialCount',
                'topStudents',
                'recentQuizAttempts',
                'attendanceSummary'
            )
        );
    }
}