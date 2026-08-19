<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class QuizRankingController extends Controller
{
    /**
     * Menampilkan peringkat siswa berdasarkan:
     *
     * Quiz       = 80%
     * Kehadiran  = 20%
     */
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | KELAS YANG DIPILIH
        |--------------------------------------------------------------------------
        */

        $kelas = $request->get('kelas', '');


        /*
        |--------------------------------------------------------------------------
        | DAFTAR KELAS
        |--------------------------------------------------------------------------
        */

        $classes = Student::query()
            ->where('aktif', true)
            ->whereNotNull('kelas')
            ->where('kelas', '!=', '')
            ->select('kelas')
            ->distinct()
            ->orderBy('kelas')
            ->pluck('kelas');


        /*
        |--------------------------------------------------------------------------
        | AMBIL SISWA AKTIF
        |--------------------------------------------------------------------------
        */

        $studentsQuery = Student::query()
            ->where('aktif', true)
            ->with([
                'attendances',
                'quizAttempts',
            ])
            ->orderBy('kelas')
            ->orderBy('nomor_absen');


        /*
        |--------------------------------------------------------------------------
        | FILTER KELAS
        |--------------------------------------------------------------------------
        */

        if ($kelas !== '') {

            $studentsQuery->where(function ($query) use ($kelas) {

                $query->where('kelas', $kelas)
                    ->orWhere(
                        'kelas',
                        str_replace('-', ' ', $kelas)
                    );

            });
        }


        /*
        |--------------------------------------------------------------------------
        | AMBIL DATA SISWA
        |--------------------------------------------------------------------------
        */

        $students = $studentsQuery->get();


        /*
        |--------------------------------------------------------------------------
        | HITUNG NILAI DAN RANKING
        |--------------------------------------------------------------------------
        */

        $ranking = $students
            ->map(function ($student) {

                /*
                |--------------------------------------------------------------------------
                | TOTAL PERTEMUAN
                |--------------------------------------------------------------------------
                */

                $totalPertemuan = 8;


                /*
                |--------------------------------------------------------------------------
                | NILAI QUIZ
                |--------------------------------------------------------------------------
                */

                $attempts = $student->quizAttempts;

                $quizCount = $attempts->count();

                $quizAverage = $quizCount > 0
                    ? (float) $attempts->avg('nilai')
                    : 0;


                /*
                |--------------------------------------------------------------------------
                | DATA KEHADIRAN
                |--------------------------------------------------------------------------
                */

                $hadir = $student->attendances
                    ->where('status', 'hadir')
                    ->count();

                $sakit = $student->attendances
                    ->where('status', 'sakit')
                    ->count();

                $izin = $student->attendances
                    ->where('status', 'izin')
                    ->count();

                $alfa = $student->attendances
                    ->where('status', 'alfa')
                    ->count();

                $dispensasi = $student->attendances
                    ->where('status', 'dispensasi')
                    ->count();


                /*
                |--------------------------------------------------------------------------
                | PERSENTASE KEHADIRAN
                |--------------------------------------------------------------------------
                */

                $attendancePercentage = $totalPertemuan > 0
                    ? ($hadir / $totalPertemuan) * 100
                    : 0;


                /*
                |--------------------------------------------------------------------------
                | BOBOT NILAI
                |--------------------------------------------------------------------------
                */

                $quizWeight =
                    $quizAverage * 0.80;

                $attendanceWeight =
                    $attendancePercentage * 0.20;


                /*
                |--------------------------------------------------------------------------
                | NILAI AKHIR
                |--------------------------------------------------------------------------
                */

                $finalScore =
                    $quizWeight +
                    $attendanceWeight;


                return [

                    'student' => $student,

                    'quiz_count' => $quizCount,

                    'quiz_average' => round(
                        $quizAverage,
                        2
                    ),

                    'hadir' => $hadir,

                    'sakit' => $sakit,

                    'izin' => $izin,

                    'alfa' => $alfa,

                    'dispensasi' => $dispensasi,

                    'attendance_percentage' => round(
                        $attendancePercentage,
                        2
                    ),

                    'final_score' => round(
                        $finalScore,
                        2
                    ),

                ];

            })


            /*
            |--------------------------------------------------------------------------
            | HANYA SISWA YANG SUDAH MENGERJAKAN QUIZ
            |--------------------------------------------------------------------------
            */

            ->filter(function ($item) {

                return $item['quiz_count'] > 0;

            })


            /*
            |--------------------------------------------------------------------------
            | URUTKAN RANKING
            |--------------------------------------------------------------------------
            */

            ->sort(function ($a, $b) {

                /*
                |--------------------------------------------------------------------------
                | 1. NILAI AKHIR
                |--------------------------------------------------------------------------
                */

                if (
                    $a['final_score']
                    !=
                    $b['final_score']
                ) {

                    return $b['final_score']
                        <=> $a['final_score'];

                }


                /*
                |--------------------------------------------------------------------------
                | 2. RATA-RATA QUIZ
                |--------------------------------------------------------------------------
                */

                if (
                    $a['quiz_average']
                    !=
                    $b['quiz_average']
                ) {

                    return $b['quiz_average']
                        <=> $a['quiz_average'];

                }


                /*
                |--------------------------------------------------------------------------
                | 3. JUMLAH QUIZ
                |--------------------------------------------------------------------------
                */

                return $b['quiz_count']
                    <=> $a['quiz_count'];

            })


            /*
            |--------------------------------------------------------------------------
            | RESET INDEX
            |--------------------------------------------------------------------------
            */

            ->values();


        /*
        |--------------------------------------------------------------------------
        | TAMBAHKAN NOMOR PERINGKAT
        |--------------------------------------------------------------------------
        */

        $ranking = $ranking
            ->map(function ($item, $index) {

                $item['rank'] = $index + 1;

                return $item;

            });


        /*
        |--------------------------------------------------------------------------
        | STATISTIK RANKING
        |--------------------------------------------------------------------------
        */

        $totalRanked =
            $ranking->count();


        $averageFinalScore =
            $totalRanked > 0
                ? round(
                    $ranking->avg('final_score'),
                    2
                )
                : 0;


        $highestFinalScore =
            $totalRanked > 0
                ? round(
                    $ranking->max('final_score'),
                    2
                )
                : 0;


        /*
        |--------------------------------------------------------------------------
        | HALAMAN RANKING
        |--------------------------------------------------------------------------
        |
        | Folder Blade:
        |
        | resources/views/guru/quiz-ranking/index.blade.php
        |
        */

        return view(
            'guru.quiz-ranking.index',
            compact(
                'classes',
                'kelas',
                'ranking',
                'totalRanked',
                'averageFinalScore',
                'highestFinalScore'
            )
        );
    }
}