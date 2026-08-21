<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Material;
use App\Models\Student;
use App\Models\LKPD;
use App\Models\Quiz;
use App\Models\Reflection;
use Illuminate\Http\Request;

class QuizRankingController extends Controller
{
    /**
     * ============================================================
     * RANKING 5 ASPEK
     * ============================================================
     *
     * Absensi  = 10%
     * Quiz     = 25%
     * LKPD     = 30%
     * Refleksi = 10%
     * Praktik  = 25%
     *
     * Total = 100%
     *
     * Nilai aspek yang sudah tersedia tetap ditampilkan.
     *
     * Nilai akhir hanya dihitung apabila seluruh aspek lengkap.
     */
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | KELAS
        |--------------------------------------------------------------------------
        */

        $kelas = trim(
            (string) $request->get('kelas', '')
        );


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
        | PERTEMUAN ABSENSI
        |--------------------------------------------------------------------------
        |
        | Tetap mengikuti pertemuan yang tersedia pada Material.
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
        | QUIZ
        |--------------------------------------------------------------------------
        |
        | PENTING:
        |
        | Status Quiz tidak lagi berdasarkan jumlah attempt.
        |
        | Kita ambil semua Quiz aktif dari database kemudian
        | mencocokkannya dengan quiz_attempts milik siswa.
        |
        */

        $quizzes = Quiz::query()
            ->where('aktif', true)
            ->orderBy('pertemuan')
            ->orderBy('id')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | LKPD
        |--------------------------------------------------------------------------
        */

        $lkpds = LKPD::query()
            ->with([
                'questions',
                'answers.question',
            ])
            ->orderBy('pertemuan')
            ->orderBy('id')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | REFLEKSI
        |--------------------------------------------------------------------------
        */

        $reflections = Reflection::query()
            ->with([
                'questions',
                'answers',
            ])
            ->orderBy('pertemuan')
            ->orderBy('id')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | PRAKTIK
        |--------------------------------------------------------------------------
        */

        $assignmentsQuery = Assignment::query()
            ->where('aktif', true)
            ->with([
                'submissions.student',
                'submissions.group.members.student',
            ])
            ->orderBy('pertemuan')
            ->orderBy('id');


        /*
        |--------------------------------------------------------------------------
        | FILTER PRAKTIK BERDASARKAN KELAS
        |--------------------------------------------------------------------------
        */

        if ($kelas !== '') {

            $kelasNormalized =
                str_replace('-', ' ', $kelas);

            $assignmentsQuery->where(
                function ($query) use (
                    $kelas,
                    $kelasNormalized
                ) {

                    $query
                        ->where(
                            'kelas',
                            $kelas
                        )
                        ->orWhere(
                            'kelas',
                            $kelasNormalized
                        );
                }
            );
        }


        $assignments =
            $assignmentsQuery->get();


        /*
        |--------------------------------------------------------------------------
        | SISWA
        |--------------------------------------------------------------------------
        */

        $studentsQuery = Student::query()
            ->where('aktif', true)
            ->with([
                'attendances',
                'quizAttempts',
            ])
            ->orderBy('kelas')
            ->orderBy('nomor_absen')
            ->orderBy('nama');


        /*
        |--------------------------------------------------------------------------
        | FILTER KELAS SISWA
        |--------------------------------------------------------------------------
        */

        if ($kelas !== '') {

            $kelasNormalized =
                str_replace('-', ' ', $kelas);

            $studentsQuery->where(
                function ($query) use (
                    $kelas,
                    $kelasNormalized
                ) {

                    $query
                        ->where(
                            'kelas',
                            $kelas
                        )
                        ->orWhere(
                            'kelas',
                            $kelasNormalized
                        );
                }
            );
        }


        $students =
            $studentsQuery->get();


        /*
        |--------------------------------------------------------------------------
        | HITUNG RANKING
        |--------------------------------------------------------------------------
        */

        $ranking = $students
            ->map(
                function ($student) use (
                    $totalPertemuan,
                    $quizzes,
                    $lkpds,
                    $reflections,
                    $assignments
                ) {

                    /*
                    |--------------------------------------------------------------------------
                    | ABSENSI
                    |--------------------------------------------------------------------------
                    */

                    $hadir = $student
                        ->attendances
                        ->where('status', 'hadir')
                        ->count();

                    $sakit = $student
                        ->attendances
                        ->where('status', 'sakit')
                        ->count();

                    $izin = $student
                        ->attendances
                        ->where('status', 'izin')
                        ->count();

                    $alfa = $student
                        ->attendances
                        ->where('status', 'alfa')
                        ->count();

                    $dispensasi = $student
                        ->attendances
                        ->where('status', 'dispensasi')
                        ->count();


                    $attendancePercentage =
                        $totalPertemuan > 0
                            ? (
                                $hadir
                                /
                                $totalPertemuan
                            ) * 100
                            : 0;


                    /*
                    |--------------------------------------------------------------------------
                    | QUIZ
                    |--------------------------------------------------------------------------
                    */

                    $quizResult =
                        $this->calculateQuizScore(
                            $student,
                            $quizzes
                        );


                    $quizCount =
                        $quizResult['completed_count'];

                    $quizTotal =
                        $quizResult['total_count'];


                    $quizAverage =
                        $quizResult['score'];


                    /*
                    |--------------------------------------------------------------------------
                    | LKPD
                    |--------------------------------------------------------------------------
                    */

                    $lkpdResult =
                        $this->calculateLkpdScore(
                            $student,
                            $lkpds
                        );


                    /*
                    |--------------------------------------------------------------------------
                    | REFLEKSI
                    |--------------------------------------------------------------------------
                    */

                    $reflectionResult =
                        $this->calculateReflectionScore(
                            $student,
                            $reflections
                        );


                    /*
                    |--------------------------------------------------------------------------
                    | PRAKTIK
                    |--------------------------------------------------------------------------
                    */

                    $practiceResult =
                        $this->calculatePracticeScore(
                            $student,
                            $assignments
                        );


                    /*
                    |--------------------------------------------------------------------------
                    | STATUS
                    |--------------------------------------------------------------------------
                    */

                    $missing = [];


                    /*
                    |--------------------------------------------------------------------------
                    | QUIZ
                    |--------------------------------------------------------------------------
                    */

                    foreach (
                        $quizResult['status_items']
                        as $status
                    ) {

                        if (
                            !in_array(
                                $status['status'],
                                [
                                    'complete',
                                    'not_required',
                                ],
                                true
                            )
                        ) {

                            $missing[] =
                                $status['message'];
                        }
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | LKPD
                    |--------------------------------------------------------------------------
                    */

                    foreach (
                        $lkpdResult['status_items']
                        as $status
                    ) {

                        if (
                            !in_array(
                                $status['status'],
                                [
                                    'complete',
                                    'not_required',
                                ],
                                true
                            )
                        ) {

                            $missing[] =
                                $status['message'];
                        }
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | REFLEKSI
                    |--------------------------------------------------------------------------
                    */

                    foreach (
                        $reflectionResult['status_items']
                        as $status
                    ) {

                        if (
                            !in_array(
                                $status['status'],
                                [
                                    'complete',
                                    'not_required',
                                ],
                                true
                            )
                        ) {

                            $missing[] =
                                $status['message'];
                        }
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | PRAKTIK
                    |--------------------------------------------------------------------------
                    */

                    foreach (
                        $practiceResult['status_items']
                        as $status
                    ) {

                        if (
                            !in_array(
                                $status['status'],
                                [
                                    'complete',
                                    'not_required',
                                ],
                                true
                            )
                        ) {

                            $missing[] =
                                $status['message'];
                        }
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | KELENGKAPAN
                    |--------------------------------------------------------------------------
                    */

                    $attendanceComplete =
                        $totalPertemuan === 0
                        ||
                        $attendancePercentage >= 0;


                    $quizComplete =
                        $quizResult['complete'];


                    $lkpdComplete =
                        $lkpdResult['complete'];


                    $reflectionComplete =
                        $reflectionResult['complete'];


                    $practiceComplete =
                        $practiceResult['complete'];


                    $isComplete =
                        $attendanceComplete
                        &&
                        $quizComplete
                        &&
                        $lkpdComplete
                        &&
                        $reflectionComplete
                        &&
                        $practiceComplete;


                    /*
                    |--------------------------------------------------------------------------
                    | NILAI AKHIR
                    |--------------------------------------------------------------------------
                    */

                    $finalScore = null;


                    if (
                        $isComplete
                        &&
                        $quizAverage !== null
                        &&
                        $lkpdResult['score'] !== null
                        &&
                        $reflectionResult['score'] !== null
                        &&
                        $practiceResult['score'] !== null
                    ) {

                        $finalScore =
                            ($attendancePercentage * 0.10)
                            +
                            ($quizAverage * 0.25)
                            +
                            ($lkpdResult['score'] * 0.30)
                            +
                            ($reflectionResult['score'] * 0.10)
                            +
                            ($practiceResult['score'] * 0.25);
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | STATUS UTAMA
                    |--------------------------------------------------------------------------
                    */

                    if ($isComplete) {

                        $statusText =
                            'Semua aspek penilaian sudah lengkap';

                    } else {

                        $statusText =
                            count($missing) > 0
                                ? implode(
                                    ', ',
                                    array_unique(
                                        $missing
                                    )
                                )
                                : 'Penilaian belum lengkap';
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | DATA RANKING
                    |--------------------------------------------------------------------------
                    */

                    return [

                        'student' =>
                            $student,


                        /*
                        |--------------------------------------------------------------------------
                        | ABSENSI
                        |--------------------------------------------------------------------------
                        */

                        'hadir' =>
                            $hadir,

                        'sakit' =>
                            $sakit,

                        'izin' =>
                            $izin,

                        'alfa' =>
                            $alfa,

                        'dispensasi' =>
                            $dispensasi,

                        'attendance_percentage' =>
                            round(
                                $attendancePercentage,
                                2
                            ),


                        /*
                        |--------------------------------------------------------------------------
                        | QUIZ
                        |--------------------------------------------------------------------------
                        */

                        'quiz_count' =>
                            $quizCount,

                        'quiz_total' =>
                            $quizTotal,

                        'quiz_average' =>
                            $quizAverage !== null
                                ? round(
                                    $quizAverage,
                                    2
                                )
                                : null,

                        'quiz_complete' =>
                            $quizResult['complete'],

                        'quiz_status' =>
                            $quizResult['status'],


                        /*
                        |--------------------------------------------------------------------------
                        | LKPD
                        |--------------------------------------------------------------------------
                        */

                        'lkpd_count' =>
                            $lkpdResult['completed_count'],

                        'lkpd_total' =>
                            $lkpdResult['total_count'],

                        'lkpd_score' =>
                            $lkpdResult['score'] !== null
                                ? round(
                                    $lkpdResult['score'],
                                    2
                                )
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

                        'reflection_count' =>
                            $reflectionResult['completed_count'],

                        'reflection_total' =>
                            $reflectionResult['total_count'],

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
                        | PRAKTIK
                        |--------------------------------------------------------------------------
                        */

                        'practice_count' =>
                            $practiceResult['completed_count'],

                        'practice_total' =>
                            $practiceResult['total_count'],

                        'practice_score' =>
                            $practiceResult['score'] !== null
                                ? round(
                                    $practiceResult['score'],
                                    2
                                )
                                : null,

                        'practice_complete' =>
                            $practiceResult['complete'],

                        'practice_status' =>
                            $practiceResult['status'],


                        /*
                        |--------------------------------------------------------------------------
                        | FINAL
                        |--------------------------------------------------------------------------
                        */

                        'is_complete' =>
                            $isComplete,

                        'missing' =>
                            array_values(
                                array_unique(
                                    $missing
                                )
                            ),

                        'status_text' =>
                            $statusText,

                        'final_score' =>
                            $finalScore !== null
                                ? round(
                                    $finalScore,
                                    2
                                )
                                : null,
                    ];
                }
            )
            ->sort(
                function ($a, $b) {

                    /*
                    |--------------------------------------------------------------------------
                    | SISWA LENGKAP DI ATAS
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
                    | NILAI AKHIR
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


                        return
                            $b['final_score']
                            <=>
                            $a['final_score'];
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | QUIZ
                    |--------------------------------------------------------------------------
                    */

                    $aQuiz =
                        $a['quiz_average'] ?? -1;

                    $bQuiz =
                        $b['quiz_average'] ?? -1;


                    if (
                        $aQuiz != $bQuiz
                    ) {

                        return
                            $bQuiz
                            <=>
                            $aQuiz;
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | ABSENSI
                    |--------------------------------------------------------------------------
                    */

                    return
                        $b['attendance_percentage']
                        <=>
                        $a['attendance_percentage'];
                }
            )
            ->values();


        /*
        |--------------------------------------------------------------------------
        | RANK
        |--------------------------------------------------------------------------
        */

        $rank = 0;


        $ranking =
            $ranking->map(
                function ($item) use (
                    &$rank
                ) {

                    if (
                        $item['is_complete']
                    ) {

                        $rank++;

                        $item['rank'] =
                            $rank;

                    } else {

                        $item['rank'] =
                            null;
                    }


                    return $item;
                }
            );


        /*
        |--------------------------------------------------------------------------
        | STATISTIK
        |--------------------------------------------------------------------------
        */

        $totalRanked =
            $ranking
                ->where(
                    'is_complete',
                    true
                )
                ->count();


        $averageFinalScore =
            $totalRanked > 0
                ? round(
                    $ranking
                        ->where(
                            'is_complete',
                            true
                        )
                        ->avg(
                            'final_score'
                        ),
                    2
                )
                : 0;


        $highestFinalScore =
            $totalRanked > 0
                ? round(
                    $ranking
                        ->where(
                            'is_complete',
                            true
                        )
                        ->max(
                            'final_score'
                        ),
                    2
                )
                : 0;


        $totalStudents =
            $ranking->count();


        /*
        |--------------------------------------------------------------------------
        | VIEW
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
    | HITUNG NILAI QUIZ
    |--------------------------------------------------------------------------
    */

    private function calculateQuizScore(
        Student $student,
        $quizzes
    ): array {

        /*
        |--------------------------------------------------------------------------
        | TIDAK ADA QUIZ
        |--------------------------------------------------------------------------
        */

        if (
            $quizzes->isEmpty()
        ) {

            return [

                'score' =>
                    null,

                'complete' =>
                    true,

                'status' =>
                    'Belum ada Quiz',

                'status_items' => [

                    [
                        'status' =>
                            'not_required',

                        'message' =>
                            'Tidak ada Quiz',
                    ],
                ],

                'completed_count' =>
                    0,

                'total_count' =>
                    0,
            ];
        }


        $scores = [];

        $statusItems = [];

        $completedCount = 0;

        $totalCount = $quizzes->count();


        /*
        |--------------------------------------------------------------------------
        | CEK SETIAP QUIZ
        |--------------------------------------------------------------------------
        */

        foreach (
            $quizzes
            as $quiz
        ) {

            /*
            |--------------------------------------------------------------------------
            | CARI ATTEMPT BERDASARKAN QUIZ ID
            |--------------------------------------------------------------------------
            */

            $attempt =
                $student
                    ->quizAttempts
                    ->firstWhere(
                        'quiz_id',
                        $quiz->id
                    );


            /*
            |--------------------------------------------------------------------------
            | BELUM DIKERJAKAN
            |--------------------------------------------------------------------------
            */

            if (!$attempt) {

                $statusItems[] = [

                    'status' =>
                        'not_done',

                    'message' =>
                        "Quiz Pertemuan {$quiz->pertemuan} belum dikerjakan",
                ];

                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | SUDAH DIKERJAKAN TETAPI NILAI NULL
            |--------------------------------------------------------------------------
            */

            if (
                $attempt->nilai === null
            ) {

                $statusItems[] = [

                    'status' =>
                        'pending',

                    'message' =>
                        "Quiz Pertemuan {$quiz->pertemuan} belum memiliki nilai",
                ];

                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | SUDAH SELESAI
            |--------------------------------------------------------------------------
            */

            $scores[] =
                (float) $attempt->nilai;

            $completedCount++;


            $statusItems[] = [

                'status' =>
                    'complete',

                'message' =>
                    "Quiz Pertemuan {$quiz->pertemuan} selesai",
            ];
        }


        /*
        |--------------------------------------------------------------------------
        | RATA-RATA QUIZ YANG SUDAH ADA
        |--------------------------------------------------------------------------
        */

        $score =
            count($scores) > 0
                ? array_sum($scores)
                /
                count($scores)
                : null;


        /*
        |--------------------------------------------------------------------------
        | CEK BELUM LENGKAP
        |--------------------------------------------------------------------------
        */

        $hasIncomplete =
            collect($statusItems)
                ->contains(
                    function ($item) {

                        return !in_array(
                            $item['status'],
                            [
                                'complete',
                                'not_required',
                            ],
                            true
                        );
                    }
                );


        return [

            'score' =>
                $score,

            'complete' =>
                !$hasIncomplete,

            'status' =>
                $hasIncomplete
                    ? 'Belum lengkap'
                    : 'Semua Quiz selesai',

            'status_items' =>
                $statusItems,

            'completed_count' =>
                $completedCount,

            'total_count' =>
                $totalCount,
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | HITUNG NILAI PRAKTIK
    |--------------------------------------------------------------------------
    */

    private function calculatePracticeScore(
        Student $student,
        $assignments
    ): array {

        if (
            $assignments->isEmpty()
        ) {

            return [

                'score' =>
                    null,

                'complete' =>
                    true,

                'status' =>
                    'Belum ada Praktik',

                'status_items' => [

                    [
                        'status' =>
                            'not_required',

                        'message' =>
                            'Tidak ada Praktik',
                    ],
                ],

                'completed_count' =>
                    0,

                'total_count' =>
                    0,
            ];
        }


        $scores = [];

        $statusItems = [];

        $completedCount = 0;

        $totalCount = $assignments->count();


        foreach (
            $assignments
            as $assignment
        ) {

            /*
            |--------------------------------------------------------------------------
            | CARI SUBMISSION SISWA
            |--------------------------------------------------------------------------
            */

            $submission =
                $assignment
                    ->submissions
                    ->first(
                        function (
                            $submission
                        ) use (
                            $student
                        ) {

                            /*
                            |--------------------------------------------------------------------------
                            | INDIVIDU
                            |--------------------------------------------------------------------------
                            */

                            if (
                                $submission->student_id !== null
                                &&
                                (int)
                                $submission->student_id
                                ===
                                (int)
                                $student->id
                            ) {

                                return true;
                            }


                            /*
                            |--------------------------------------------------------------------------
                            | KELOMPOK
                            |--------------------------------------------------------------------------
                            */

                            if (
                                $submission->assignment_group_id !== null
                                &&
                                $submission->group
                            ) {

                                return
                                    $submission
                                        ->group
                                        ->members
                                        ->contains(
                                            function (
                                                $member
                                            ) use (
                                                $student
                                            ) {

                                                return
                                                    (int)
                                                    $member->student_id
                                                    ===
                                                    (int)
                                                    $student->id;
                                            }
                                        );
                            }


                            return false;
                        }
                    );


            /*
            |--------------------------------------------------------------------------
            | BELUM MENGUMPULKAN
            |--------------------------------------------------------------------------
            */

            if (!$submission) {

                $statusItems[] = [

                    'status' =>
                        'not_done',

                    'message' =>
                        "Praktik Pertemuan {$assignment->pertemuan} belum dikumpulkan",
                ];

                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | BELUM ADA NILAI
            |--------------------------------------------------------------------------
            */

            if (
                $submission->nilai === null
            ) {

                $statusItems[] = [

                    'status' =>
                        'pending',

                    'message' =>
                        "Praktik Pertemuan {$assignment->pertemuan} belum memiliki nilai",
                ];

                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | BELUM SELESAI DINILAI
            |--------------------------------------------------------------------------
            */

            if (
                $submission->status !== 'selesai'
            ) {

                $statusItems[] = [

                    'status' =>
                        'pending',

                    'message' =>
                        "Praktik Pertemuan {$assignment->pertemuan} menunggu penilaian guru",
                ];

                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | NILAI
            |--------------------------------------------------------------------------
            */

            $scores[] =
                (float) $submission->nilai;

            $completedCount++;


            $statusItems[] = [

                'status' =>
                    'complete',

                'message' =>
                    "Praktik Pertemuan {$assignment->pertemuan} selesai",
            ];
        }


        /*
        |--------------------------------------------------------------------------
        | NILAI YANG SUDAH TERSEDIA
        |--------------------------------------------------------------------------
        */

        $score =
            count($scores) > 0
                ? array_sum($scores)
                /
                count($scores)
                : null;


        /*
        |--------------------------------------------------------------------------
        | CEK LENGKAP
        |--------------------------------------------------------------------------
        */

        $hasIncomplete =
            collect($statusItems)
                ->contains(
                    function ($item) {

                        return !in_array(
                            $item['status'],
                            [
                                'complete',
                                'not_required',
                            ],
                            true
                        );
                    }
                );


        return [

            'score' =>
                $score,

            'complete' =>
                !$hasIncomplete,

            'status' =>
                $hasIncomplete
                    ? 'Belum lengkap'
                    : 'Semua Praktik selesai',

            'status_items' =>
                $statusItems,

            'completed_count' =>
                $completedCount,

            'total_count' =>
                $totalCount,
        ];
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

        if (
            $lkpds->isEmpty()
        ) {

            return [

                'score' =>
                    null,

                'complete' =>
                    true,

                'status' =>
                    'Belum ada LKPD',

                'status_items' => [

                    [
                        'status' =>
                            'not_required',

                        'message' =>
                            'Tidak ada LKPD',
                    ],
                ],

                'completed_count' =>
                    0,

                'total_count' =>
                    0,
            ];
        }


        $scores = [];

        $statusItems = [];

        $completedCount = 0;

        $totalCount = $lkpds->count();


        foreach (
            $lkpds
            as $lkpd
        ) {

            /*
            |--------------------------------------------------------------------------
            | JAWABAN SISWA
            |--------------------------------------------------------------------------
            */

            $answers =
                $lkpd
                    ->answers
                    ->where(
                        'student_id',
                        $student->id
                    );


            /*
            |--------------------------------------------------------------------------
            | BELUM DIKERJAKAN
            |--------------------------------------------------------------------------
            */

            if (
                $answers->isEmpty()
            ) {

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
            | SOAL
            |--------------------------------------------------------------------------
            */

            $questions =
                $lkpd->questions;


            $questionCount =
                $questions->count();


            /*
            |--------------------------------------------------------------------------
            | JUMLAH JAWABAN
            |--------------------------------------------------------------------------
            */

            $answeredCount =
                $answers
                    ->filter(
                        function (
                            $answer
                        ) {

                            return
                                $answer->jawaban !== null
                                &&
                                trim(
                                    (string)
                                    $answer->jawaban
                                ) !== '';
                        }
                    )
                    ->count();


            /*
            |--------------------------------------------------------------------------
            | BELUM SELESAI
            |--------------------------------------------------------------------------
            */

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
            | CEK ESSAY
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
                    $answers
                        ->firstWhere(
                            'lkpd_question_id',
                            $essayQuestion->id
                        );


                if (
                    !$answer
                    ||
                    $answer->nilai === null
                ) {

                    $pendingEssay =
                        true;

                    break;
                }
            }


            if (
                $pendingEssay
            ) {

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
            | NILAI SOAL
            |--------------------------------------------------------------------------
            */

            $questionScores = [];


            foreach (
                $questions
                as $question
            ) {

                $answer =
                    $answers
                        ->firstWhere(
                            'lkpd_question_id',
                            $question->id
                        );


                if (!$answer) {

                    continue;
                }


                if (
                    $answer->nilai !== null
                ) {

                    $questionScores[] =
                        (float)
                        $answer->nilai;
                }
            }


            /*
            |--------------------------------------------------------------------------
            | BELUM ADA NILAI
            |--------------------------------------------------------------------------
            */

            if (
                count($questionScores) === 0
            ) {

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
            | NILAI PERTEMUAN
            |--------------------------------------------------------------------------
            */

            $meetingScore =
                array_sum(
                    $questionScores
                )
                /
                count(
                    $questionScores
                );


            $scores[] =
                $meetingScore;

            $completedCount++;


            $statusItems[] = [

                'status' =>
                    'complete',

                'message' =>
                    "LKPD Pertemuan {$lkpd->pertemuan} selesai",
            ];
        }


        /*
        |--------------------------------------------------------------------------
        | RATA-RATA NILAI YANG SUDAH TERSEDIA
        |--------------------------------------------------------------------------
        */

        $score =
            count($scores) > 0
                ? array_sum($scores)
                /
                count($scores)
                : null;


        /*
        |--------------------------------------------------------------------------
        | CEK LENGKAP
        |--------------------------------------------------------------------------
        */

        $hasIncomplete =
            collect($statusItems)
                ->contains(
                    function ($item) {

                        return !in_array(
                            $item['status'],
                            [
                                'complete',
                                'not_required',
                            ],
                            true
                        );
                    }
                );


        return [

            'score' =>
                $score,

            'complete' =>
                !$hasIncomplete,

            'status' =>
                $hasIncomplete
                    ? 'Belum lengkap'
                    : 'Semua LKPD selesai',

            'status_items' =>
                $statusItems,

            'completed_count' =>
                $completedCount,

            'total_count' =>
                $totalCount,
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

        if (
            $reflections->isEmpty()
        ) {

            return [

                'score' =>
                    null,

                'complete' =>
                    true,

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

                'completed_count' =>
                    0,

                'total_count' =>
                    0,
            ];
        }


        $scores = [];

        $statusItems = [];

        $completedCount = 0;

        $totalCount = $reflections->count();


        foreach (
            $reflections
            as $reflection
        ) {

            /*
            |--------------------------------------------------------------------------
            | JAWABAN SISWA
            |--------------------------------------------------------------------------
            */

            $answers =
                $reflection
                    ->answers
                    ->where(
                        'student_id',
                        $student->id
                    );


            /*
            |--------------------------------------------------------------------------
            | BELUM DIKERJAKAN
            |--------------------------------------------------------------------------
            */

            if (
                $answers->isEmpty()
            ) {

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
            | SOAL
            |--------------------------------------------------------------------------
            */

            $questions =
                $reflection->questions;


            $questionCount =
                $questions->count();


            /*
            |--------------------------------------------------------------------------
            | JAWABAN TERISI
            |--------------------------------------------------------------------------
            */

            $answeredCount =
                $answers
                    ->filter(
                        function (
                            $answer
                        ) {

                            return
                                $answer->jawaban !== null
                                &&
                                trim(
                                    (string)
                                    $answer->jawaban
                                ) !== '';
                        }
                    )
                    ->count();


            /*
            |--------------------------------------------------------------------------
            | BELUM SELESAI
            |--------------------------------------------------------------------------
            */

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
            | BELUM DINILAI
            |--------------------------------------------------------------------------
            */

            $pending =
                $answers
                    ->contains(
                        function (
                            $answer
                        ) {

                            return
                                $answer->nilai === null;
                        }
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
                        function (
                            $value
                        ) {

                            return
                                $value !== null;
                        }
                    )
                    ->map(
                        function (
                            $value
                        ) {

                            return
                                (float)
                                $value;
                        }
                    )
                    ->values();


            /*
            |--------------------------------------------------------------------------
            | BELUM ADA NILAI
            |--------------------------------------------------------------------------
            */

            if (
                $answerScores->isEmpty()
            ) {

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
            | NILAI PERTEMUAN
            |--------------------------------------------------------------------------
            */

            $meetingScore =
                $answerScores->avg();


            $scores[] =
                $meetingScore;

            $completedCount++;


            $statusItems[] = [

                'status' =>
                    'complete',

                'message' =>
                    "Refleksi Pertemuan {$reflection->pertemuan} selesai",
            ];
        }


        /*
        |--------------------------------------------------------------------------
        | RATA-RATA NILAI YANG SUDAH ADA
        |--------------------------------------------------------------------------
        */

        $score =
            count($scores) > 0
                ? array_sum($scores)
                /
                count($scores)
                : null;


        /*
        |--------------------------------------------------------------------------
        | CEK LENGKAP
        |--------------------------------------------------------------------------
        */

        $hasIncomplete =
            collect($statusItems)
                ->contains(
                    function ($item) {

                        return !in_array(
                            $item['status'],
                            [
                                'complete',
                                'not_required',
                            ],
                            true
                        );
                    }
                );


        return [

            'score' =>
                $score,

            'complete' =>
                !$hasIncomplete,

            'status' =>
                $hasIncomplete
                    ? 'Belum lengkap'
                    : 'Semua refleksi selesai',

            'status_items' =>
                $statusItems,

            'completed_count' =>
                $completedCount,

            'total_count' =>
                $totalCount,
        ];
    }
}