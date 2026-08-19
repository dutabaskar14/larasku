<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\Student;
use App\Models\LKPD;
use App\Models\Reflection;
use Illuminate\Http\Request;

class QuizRankingController extends Controller
{
    /**
     * ============================================================
     * RANKING 4 ASPEK
     * ============================================================
     *
     * 1. Absensi
     * 2. Quiz
     * 3. LKPD
     * 4. Refleksi
     *
     * Bobot penilaian:
     *
     * Absensi  = 20%
     * Quiz     = 35%
     * LKPD     = 25%
     * Refleksi = 20%
     *
     * Nilai akhir:
     *
     * (Absensi x 20%) + (Quiz x 35%) +
     * (LKPD x 25%) + (Refleksi x 20%)
     *
     * Siswa tetap ditampilkan walaupun belum lengkap.
     * Nilai akhir hanya dihitung apabila seluruh aspek lengkap.
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
        | JUMLAH PERTEMUAN
        |--------------------------------------------------------------------------
        |
        | Absensi tetap mengikuti pertemuan yang benar-benar ada
        | pada Material.
        |
        */

        $pertemuans = Material::query()
            ->whereNotNull('pertemuan')
            ->where('pertemuan', '>=', 1)
            ->distinct()
            ->orderBy('pertemuan')
            ->pluck('pertemuan');

        $totalPertemuan = $pertemuans->count();


        /*
        |--------------------------------------------------------------------------
        | AMBIL DATA LKPD
        |--------------------------------------------------------------------------
        |
        | LKPD berdiri sendiri berdasarkan pertemuan.
        |
        */

        $lkpds = LKPD::with([
            'questions',
            'answers.question',
        ])
            ->get();


        /*
        |--------------------------------------------------------------------------
        | AMBIL DATA REFLEKSI
        |--------------------------------------------------------------------------
        |
        | Refleksi juga berdiri sendiri.
        |
        */

        $reflections = Reflection::with([
            'questions',
            'answers',
        ])
            ->get();


        /*
        |--------------------------------------------------------------------------
        | AMBIL SISWA
        |--------------------------------------------------------------------------
        |
        | Semua siswa aktif tetap dimunculkan.
        |
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

                $query
                    ->where('kelas', $kelas)
                    ->orWhere(
                        'kelas',
                        str_replace('-', ' ', $kelas)
                    );

            });

        }


        /*
        |--------------------------------------------------------------------------
        | AMBIL SISWA
        |--------------------------------------------------------------------------
        */

        $students = $studentsQuery->get();


        /*
        |--------------------------------------------------------------------------
        | HITUNG RANKING
        |--------------------------------------------------------------------------
        */

        $ranking = $students
            ->map(function ($student) use (
                $totalPertemuan,
                $lkpds,
                $reflections
            ) {

                /*
                |--------------------------------------------------------------------------
                | 1. ABSENSI
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


                $attendancePercentage = $totalPertemuan > 0
                    ? ($hadir / $totalPertemuan) * 100
                    : 0;


                /*
                |--------------------------------------------------------------------------
                | 2. QUIZ
                |--------------------------------------------------------------------------
                */

                $attempts = $student->quizAttempts;

                $quizCount = $attempts->count();

                $quizAverage = $quizCount > 0
                    ? (float) $attempts->avg('nilai')
                    : null;


                /*
                |--------------------------------------------------------------------------
                | 3. LKPD
                |--------------------------------------------------------------------------
                |
                | Logika:
                |
                | - Tidak ada LKPD aktif/tersedia:
                |     tidak dianggap sebagai tugas yang belum selesai.
                |
                | - Ada LKPD tetapi siswa belum menjawab:
                |     belum dikerjakan.
                |
                | - Ada essay yang belum dinilai:
                |     menunggu penilaian guru.
                |
                | - Semua selesai dan sudah dinilai:
                |     nilai LKPD dihitung.
                |
                */

                $lkpdResult = $this->calculateLkpdScore(
                    $student,
                    $lkpds
                );


                /*
                |--------------------------------------------------------------------------
                | 4. REFLEKSI
                |--------------------------------------------------------------------------
                */

                $reflectionResult = $this->calculateReflectionScore(
                    $student,
                    $reflections
                );


                /*
                |--------------------------------------------------------------------------
                | STATUS KELENGKAPAN
                |--------------------------------------------------------------------------
                */

                $missing = [];


                /*
                |--------------------------------------------------------------------------
                | QUIZ
                |--------------------------------------------------------------------------
                */

                if ($quizCount === 0) {

                    $missing[] = 'Quiz belum dikerjakan';

                }


                /*
                |--------------------------------------------------------------------------
                | LKPD
                |--------------------------------------------------------------------------
                */

                foreach ($lkpdResult['status_items'] as $status) {

                    if (!in_array(
                        $status['status'],
                        ['complete', 'not_required']
                    )) {

                        $missing[] = $status['message'];

                    }

                }


                /*
                |--------------------------------------------------------------------------
                | REFLEKSI
                |--------------------------------------------------------------------------
                */

                foreach ($reflectionResult['status_items'] as $status) {

                    if (!in_array(
                        $status['status'],
                        ['complete', 'not_required']
                    )) {

                        $missing[] = $status['message'];

                    }

                }


                /*
                |--------------------------------------------------------------------------
                | CEK SEMUA ASPEK
                |--------------------------------------------------------------------------
                */

                $attendanceComplete =
                    $totalPertemuan === 0
                    || $attendancePercentage >= 0;

                $quizComplete =
                    $quizCount > 0;

                $lkpdComplete =
                    $lkpdResult['complete'];

                $reflectionComplete =
                    $reflectionResult['complete'];


                $isComplete =
                    $attendanceComplete
                    && $quizComplete
                    && $lkpdComplete
                    && $reflectionComplete;


                /*
                |--------------------------------------------------------------------------
                | NILAI AKHIR
                |--------------------------------------------------------------------------
                |
                | Nilai akhir hanya dihitung kalau seluruh aspek
                | sudah lengkap.
                |
                | Bobot:
                | Absensi  = 20%
                | Quiz     = 35%
                | LKPD     = 25%
                | Refleksi = 20%
                |
                */

                $finalScore = null;

                if ($isComplete) {

                    $finalScore =
                        ($attendancePercentage * 0.20)
                        + ($quizAverage * 0.35)
                        + ($lkpdResult['score'] * 0.25)
                        + ($reflectionResult['score'] * 0.20);

                }


                /*
                |--------------------------------------------------------------------------
                | STATUS
                |--------------------------------------------------------------------------
                */

                if ($isComplete) {

                    $statusText =
                        'Semua aspek penilaian sudah lengkap';

                } else {

                    $statusText =
                        implode(', ', array_unique($missing));

                }


                /*
                |--------------------------------------------------------------------------
                | RETURN DATA
                |--------------------------------------------------------------------------
                */

                return [

                    'student' => $student,

                    /*
                    |--------------------------------------------------------------------------
                    | ABSENSI
                    |--------------------------------------------------------------------------
                    */

                    'hadir' => $hadir,

                    'sakit' => $sakit,

                    'izin' => $izin,

                    'alfa' => $alfa,

                    'dispensasi' => $dispensasi,

                    'attendance_percentage' => round(
                        $attendancePercentage,
                        2
                    ),


                    /*
                    |--------------------------------------------------------------------------
                    | QUIZ
                    |--------------------------------------------------------------------------
                    */

                    'quiz_count' => $quizCount,

                    'quiz_average' => $quizAverage !== null
                        ? round($quizAverage, 2)
                        : null,


                    /*
                    |--------------------------------------------------------------------------
                    | LKPD
                    |--------------------------------------------------------------------------
                    */

                    'lkpd_score' => $lkpdResult['score'] !== null
                        ? round($lkpdResult['score'], 2)
                        : null,

                    'lkpd_complete' =>
                        $lkpdResult['complete'],

                    'lkpd_status' =>
                        $lkpdResult['status'],


                    /*
                    |--------------------------------------------------------------------------
                    | REFLEKSI
                    |--------------------------------------------------------------------------
                    */

                    'reflection_score' =>
                        $reflectionResult['score'] !== null
                            ? round(
                                $reflectionResult['score'],
                                2
                            )
                            : null,

                    'reflection_complete' =>
                        $reflectionResult['complete'],

                    'reflection_status' =>
                        $reflectionResult['status'],


                    /*
                    |--------------------------------------------------------------------------
                    | FINAL
                    |--------------------------------------------------------------------------
                    */

                    'is_complete' =>
                        $isComplete,

                    'missing' =>
                        array_values(
                            array_unique($missing)
                        ),

                    'status_text' =>
                        $statusText,

                    'final_score' =>
                        $finalScore !== null
                            ? round($finalScore, 2)
                            : null,

                ];

            })


            /*
            |--------------------------------------------------------------------------
            | URUTKAN
            |--------------------------------------------------------------------------
            |
            | Siswa lengkap berada di atas.
            | Setelah itu berdasarkan nilai akhir.
            | Siswa belum lengkap tetap tampil di bawah.
            |
            */

            ->sort(function ($a, $b) {

                /*
                |--------------------------------------------------------------------------
                | 1. YANG SUDAH LENGKAP DI ATAS
                |--------------------------------------------------------------------------
                */

                if (
                    $a['is_complete']
                    !==
                    $b['is_complete']
                ) {

                    return $a['is_complete']
                        ? -1
                        : 1;

                }


                /*
                |--------------------------------------------------------------------------
                | 2. NILAI AKHIR
                |--------------------------------------------------------------------------
                */

                if (
                    $a['final_score']
                    !==
                    $b['final_score']
                ) {

                    if (
                        $a['final_score'] === null
                    ) {

                        return 1;

                    }

                    if (
                        $b['final_score'] === null
                    ) {

                        return -1;

                    }

                    return $b['final_score']
                        <=>
                        $a['final_score'];

                }


                /*
                |--------------------------------------------------------------------------
                | 3. QUIZ
                |--------------------------------------------------------------------------
                */

                $aQuiz =
                    $a['quiz_average'] ?? -1;

                $bQuiz =
                    $b['quiz_average'] ?? -1;


                if ($aQuiz != $bQuiz) {

                    return $bQuiz <=> $aQuiz;

                }


                /*
                |--------------------------------------------------------------------------
                | 4. ABSENSI
                |--------------------------------------------------------------------------
                */

                return $b['attendance_percentage']
                    <=>
                    $a['attendance_percentage'];

            })


            ->values();


        /*
        |--------------------------------------------------------------------------
        | NOMOR RANKING
        |--------------------------------------------------------------------------
        |
        | Hanya siswa lengkap yang mendapatkan ranking.
        | Siswa belum lengkap tetap ditampilkan tetapi rank = null.
        |
        */

        $ranking = $ranking
            ->map(function ($item) {

                return $item;

            });


        $rank = 0;

        $ranking = $ranking
            ->map(function ($item) use (&$rank) {

                if ($item['is_complete']) {

                    $rank++;

                    $item['rank'] = $rank;

                } else {

                    $item['rank'] = null;

                }

                return $item;

            });


        /*
        |--------------------------------------------------------------------------
        | STATISTIK
        |--------------------------------------------------------------------------
        */

        $totalRanked = $ranking
            ->where('is_complete', true)
            ->count();


        $averageFinalScore = $totalRanked > 0
            ? round(
                $ranking
                    ->where('is_complete', true)
                    ->avg('final_score'),
                2
            )
            : 0;


        $highestFinalScore = $totalRanked > 0
            ? round(
                $ranking
                    ->where('is_complete', true)
                    ->max('final_score'),
                2
            )
            : 0;


        /*
        |--------------------------------------------------------------------------
        | TOTAL SISWA
        |--------------------------------------------------------------------------
        */

        $totalStudents = $ranking->count();


        /*
        |--------------------------------------------------------------------------
        | HALAMAN RANKING
        |--------------------------------------------------------------------------
        */

        return view(
            'guru.quiz-ranking.index',
            compact(
                'classes',
                'kelas',
                'ranking',
                'totalRanked',
                'totalStudents',
                'averageFinalScore',
                'highestFinalScore',
                'pertemuans',
                'totalPertemuan'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | HITUNG NILAI LKPD
    |--------------------------------------------------------------------------
    */

    private function calculateLkpdScore(
        Student $student,
        $lkpds
    ): array {

        /*
        |--------------------------------------------------------------------------
        | Jika belum ada LKPD sama sekali
        |--------------------------------------------------------------------------
        */

        if ($lkpds->isEmpty()) {

            return [

                'score' => null,

                'complete' => true,

                'status' =>
                    'Belum ada LKPD',

                'status_items' => [

                    [
                        'status' => 'not_required',
                        'message' => 'Tidak ada LKPD',
                    ],

                ],

            ];

        }


        $scores = [];

        $statusItems = [];


        foreach ($lkpds as $lkpd) {

            /*
            |--------------------------------------------------------------------------
            | Cari jawaban siswa pada LKPD ini
            |--------------------------------------------------------------------------
            */

            $answers = $lkpd->answers
                ->where(
                    'student_id',
                    $student->id
                );


            /*
            |--------------------------------------------------------------------------
            | Jika belum menjawab
            |--------------------------------------------------------------------------
            */

            if ($answers->isEmpty()) {

                $statusItems[] = [

                    'status' =>
                        'not_done',

                    'message' =>
                        "LKPD Pertemuan {$lkpd->pertemuan} belum dikerjakan",

                ];

                continue;

            }


            /*
            |--------------------------------------------------------------------------
            | Hitung jumlah soal
            |--------------------------------------------------------------------------
            */

            $questions =
                $lkpd->questions;


            $questionCount =
                $questions->count();


            /*
            |--------------------------------------------------------------------------
            | Cek apakah semua soal sudah dijawab
            |--------------------------------------------------------------------------
            */

            $answeredCount =
                $answers
                    ->filter(
                        fn ($answer) =>
                            $answer->jawaban !== null
                            &&
                            trim(
                                (string) $answer->jawaban
                            ) !== ''
                    )
                    ->count();


            if (
                $questionCount > 0
                &&
                $answeredCount < $questionCount
            ) {

                $statusItems[] = [

                    'status' =>
                        'not_done',

                    'message' =>
                        "LKPD Pertemuan {$lkpd->pertemuan} belum selesai",

                ];

                continue;

            }


            /*
            |--------------------------------------------------------------------------
            | Cek essay yang belum dinilai
            |--------------------------------------------------------------------------
            */

            $essayQuestions =
                $questions
                    ->where(
                        'jenis',
                        'essay'
                    );


            $pendingEssay =
                false;


            foreach (
                $essayQuestions
                as $essayQuestion
            ) {

                $answer =
                    $answers->firstWhere(
                        'lkpd_question_id',
                        $essayQuestion->id
                    );


                if (
                    !$answer
                    ||
                    $answer->nilai === null
                ) {

                    $pendingEssay = true;

                    break;

                }

            }


            if ($pendingEssay) {

                $statusItems[] = [

                    'status' =>
                        'pending',

                    'message' =>
                        "LKPD Pertemuan {$lkpd->pertemuan} menunggu penilaian guru",

                ];

                continue;

            }


            /*
            |--------------------------------------------------------------------------
            | HITUNG NILAI LKPD
            |--------------------------------------------------------------------------
            |
            | Kita memakai nilai per jawaban.
            |
            | PG:
            | otomatis sudah memiliki nilai.
            |
            | Essay:
            | memakai nilai manual guru.
            |
            */

            $questionScores = [];


            foreach (
                $questions
                as $question
            ) {

                $answer =
                    $answers->firstWhere(
                        'lkpd_question_id',
                        $question->id
                    );


                if (!$answer) {

                    continue;

                }


                /*
                |--------------------------------------------------------------------------
                | NILAI
                |--------------------------------------------------------------------------
                */

                $nilai = $answer->nilai;


                if ($nilai !== null) {

                    $questionScores[] =
                        (float) $nilai;

                }

            }


            /*
            |--------------------------------------------------------------------------
            | Jika belum ada nilai
            |--------------------------------------------------------------------------
            */

            if (count($questionScores) === 0) {

                $statusItems[] = [

                    'status' =>
                        'pending',

                    'message' =>
                        "LKPD Pertemuan {$lkpd->pertemuan} belum memiliki nilai",

                ];

                continue;

            }


            /*
            |--------------------------------------------------------------------------
            | NILAI LKPD PERTEMUAN
            |--------------------------------------------------------------------------
            */

            $meetingScore =
                array_sum($questionScores)
                /
                count($questionScores);


            $scores[] =
                $meetingScore;


            $statusItems[] = [

                'status' =>
                    'complete',

                'message' =>
                    "LKPD Pertemuan {$lkpd->pertemuan} selesai",

            ];

        }


        /*
        |--------------------------------------------------------------------------
        | Jika ada LKPD yang belum selesai
        |--------------------------------------------------------------------------
        */

        $hasIncomplete =
            collect($statusItems)
                ->contains(
                    fn ($item) =>
                        $item['status'] !== 'complete'
                        &&
                        $item['status'] !== 'not_required'
                );


        if ($hasIncomplete) {

            return [

                'score' => null,

                'complete' => false,

                'status' =>
                    'Belum lengkap',

                'status_items' =>
                    $statusItems,

            ];

        }


        /*
        |--------------------------------------------------------------------------
        | NILAI RATA-RATA SEMUA LKPD
        |--------------------------------------------------------------------------
        */

        $score =
            count($scores) > 0
                ? array_sum($scores)
                    /
                    count($scores)
                : null;


        return [

            'score' => $score,

            'complete' => true,

            'status' =>
                'Semua LKPD selesai',

            'status_items' =>
                $statusItems,

        ];

    }


    /*
    |--------------------------------------------------------------------------
    | HITUNG NILAI REFLEKSI
    |--------------------------------------------------------------------------
    */

    private function calculateReflectionScore(
        Student $student,
        $reflections
    ): array {

        /*
        |--------------------------------------------------------------------------
        | Tidak ada refleksi
        |--------------------------------------------------------------------------
        */

        if ($reflections->isEmpty()) {

            return [

                'score' => null,

                'complete' => true,

                'status' =>
                    'Belum ada refleksi',

                'status_items' => [

                    [
                        'status' =>
                            'not_required',

                        'message' =>
                            'Tidak ada refleksi',

                    ],

                ],

            ];

        }


        $scores = [];

        $statusItems = [];


        foreach (
            $reflections
            as $reflection
        ) {

            /*
            |--------------------------------------------------------------------------
            | Ambil jawaban siswa
            |--------------------------------------------------------------------------
            */

            $answers =
                $reflection->answers
                    ->where(
                        'student_id',
                        $student->id
                    );


            /*
            |--------------------------------------------------------------------------
            | Belum menjawab
            |--------------------------------------------------------------------------
            */

            if ($answers->isEmpty()) {

                $statusItems[] = [

                    'status' =>
                        'not_done',

                    'message' =>
                        "Refleksi Pertemuan {$reflection->pertemuan} belum dikerjakan",

                ];

                continue;

            }


            /*
            |--------------------------------------------------------------------------
            | Cek soal
            |--------------------------------------------------------------------------
            */

            $questions =
                $reflection->questions;


            $questionCount =
                $questions->count();


            $answeredCount =
                $answers
                    ->filter(
                        fn ($answer) =>
                            $answer->jawaban !== null
                            &&
                            trim(
                                (string) $answer->jawaban
                            ) !== ''
                    )
                    ->count();


            if (
                $questionCount > 0
                &&
                $answeredCount < $questionCount
            ) {

                $statusItems[] = [

                    'status' =>
                        'not_done',

                    'message' =>
                        "Refleksi Pertemuan {$reflection->pertemuan} belum selesai",

                ];

                continue;

            }


            /*
            |--------------------------------------------------------------------------
            | REFLEKSI DINILAI MANUAL
            |--------------------------------------------------------------------------
            */

            $pending =
                $answers
                    ->contains(
                        fn ($answer) =>
                            $answer->nilai === null
                    );


            if ($pending) {

                $statusItems[] = [

                    'status' =>
                        'pending',

                    'message' =>
                        "Refleksi Pertemuan {$reflection->pertemuan} menunggu penilaian guru",

                ];

                continue;

            }


            /*
            |--------------------------------------------------------------------------
            | NILAI
            |--------------------------------------------------------------------------
            */

            $answerScores =
                $answers
                    ->pluck('nilai')
                    ->filter(
                        fn ($value) =>
                            $value !== null
                    )
                    ->map(
                        fn ($value) =>
                            (float) $value
                    )
                    ->values();


            if ($answerScores->isEmpty()) {

                $statusItems[] = [

                    'status' =>
                        'pending',

                    'message' =>
                        "Refleksi Pertemuan {$reflection->pertemuan} belum memiliki nilai",

                ];

                continue;

            }


            /*
            |--------------------------------------------------------------------------
            | NILAI REFLEKSI PERTEMUAN
            |--------------------------------------------------------------------------
            */

            $meetingScore =
                $answerScores->avg();


            $scores[] =
                $meetingScore;


            $statusItems[] = [

                'status' =>
                    'complete',

                'message' =>
                    "Refleksi Pertemuan {$reflection->pertemuan} selesai",

            ];

        }


        /*
        |--------------------------------------------------------------------------
        | CEK KELENGKAPAN
        |--------------------------------------------------------------------------
        */

        $hasIncomplete =
            collect($statusItems)
                ->contains(
                    fn ($item) =>
                        $item['status'] !== 'complete'
                        &&
                        $item['status'] !== 'not_required'
                );


        if ($hasIncomplete) {

            return [

                'score' => null,

                'complete' => false,

                'status' =>
                    'Belum lengkap',

                'status_items' =>
                    $statusItems,

            ];

        }


        /*
        |--------------------------------------------------------------------------
        | NILAI RATA-RATA REFLEKSI
        |--------------------------------------------------------------------------
        */

        $score =
            count($scores) > 0
                ? array_sum($scores)
                    /
                    count($scores)
                : null;


        return [

            'score' => $score,

            'complete' => true,

            'status' =>
                'Semua refleksi selesai',

            'status_items' =>
                $statusItems,

        ];

    }
}