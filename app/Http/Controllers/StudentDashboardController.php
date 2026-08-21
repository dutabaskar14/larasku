<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\AssignmentGroupMember;
use App\Models\AssignmentSubmission;
use App\Models\Attendance;
use App\Models\LKPD;
use App\Models\LKPDAnswer;
use App\Models\Material;
use App\Models\MaterialMeeting;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\Reflection;
use App\Models\ReflectionAnswer;
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

        if (! $studentId) {

            return redirect()
                ->route('attendance.index')
                ->with(
                    'success',
                    'Silakan pilih nama dan lakukan absensi terlebih dahulu.'
                );
        }


        $student = Student::query()
            ->where('id', $studentId)
            ->where('aktif', true)
            ->first();


        if (! $student) {

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
        | TOTAL PERTEMUAN ABSENSI
        |--------------------------------------------------------------------------
        |
        | Mengikuti MaterialMeeting aktif.
        |
        */

        $activeMeetings = MaterialMeeting::query()
            ->where('aktif', true)
            ->orderBy('pertemuan')
            ->get();


        $activeMeetingNumbers = $activeMeetings
            ->pluck('pertemuan')
            ->map(
                fn ($pertemuan) => (int) $pertemuan
            )
            ->values();


        $totalPertemuan =
            $activeMeetingNumbers->count();


        /*
        |--------------------------------------------------------------------------
        | MATERI PEMBELAJARAN
        |--------------------------------------------------------------------------
        |
        | Material berdiri sendiri untuk sementara.
        |
        */

        $materials = Material::query()
            ->where('aktif', true)
            ->orderBy('pertemuan')
            ->orderBy('id')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | PROGRES ABSENSI
        |--------------------------------------------------------------------------
        |
        | Hanya status hadir.
        |
        | Satu siswa hanya dihitung satu kali
        | pada setiap pertemuan.
        |
        */

        $attendanceCompleted = 0;


        if ($totalPertemuan > 0) {

            $attendanceCompleted =
                Attendance::query()
                    ->where(
                        'student_id',
                        $student->id
                    )
                    ->where(
                        'status',
                        'hadir'
                    )
                    ->whereIn(
                        'pertemuan',
                        $activeMeetingNumbers->all()
                    )
                    ->distinct('pertemuan')
                    ->count('pertemuan');
        }


        $attendanceProgress = min(
            $attendanceCompleted,
            $totalPertemuan
        );


        /*
        |--------------------------------------------------------------------------
        | PROGRES QUIZ
        |--------------------------------------------------------------------------
        |
        | Hanya Quiz aktif.
        |
        | Satu Quiz dihitung satu kali.
        |
        */

        $totalQuiz = Quiz::query()
            ->where('aktif', true)
            ->count();


        $quizCompleted = QuizAttempt::query()
            ->where(
                'student_id',
                $student->id
            )
            ->whereHas(
                'quiz',
                function ($query) {

                    $query->where(
                        'aktif',
                        true
                    );
                }
            )
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
        | Hanya Reflection aktif.
        |
        | Satu Reflection selesai jika SEMUA
        | pertanyaannya sudah dijawab siswa.
        |
        */

        $activeReflections = Reflection::query()
            ->where('aktif', true)
            ->withCount('questions')
            ->get();


        $totalReflection =
            $activeReflections->count();


        $reflectionCompleted = 0;


        if ($totalReflection > 0) {

            $reflectionIds =
                $activeReflections
                    ->pluck('id');


            $answeredQuestions =
                ReflectionAnswer::query()
                    ->where(
                        'student_id',
                        $student->id
                    )
                    ->whereIn(
                        'reflection_id',
                        $reflectionIds
                    )
                    ->selectRaw(
                        'reflection_id, COUNT(DISTINCT reflection_question_id) as total_answered'
                    )
                    ->groupBy('reflection_id')
                    ->get()
                    ->keyBy('reflection_id');


            foreach (
                $activeReflections as $reflection
            ) {

                $totalQuestions =
                    (int) $reflection->questions_count;


                $totalAnswered =
                    isset(
                        $answeredQuestions[
                            $reflection->id
                        ]
                    )
                        ? (int)
                            $answeredQuestions[
                                $reflection->id
                            ]->total_answered
                        : 0;


                /*
                |--------------------------------------------------------------------------
                | REFLEKSI TANPA SOAL TIDAK SELESAI
                |--------------------------------------------------------------------------
                */

                if (
                    $totalQuestions > 0 &&
                    $totalAnswered >= $totalQuestions
                ) {

                    $reflectionCompleted++;
                }
            }
        }


        $reflectionProgress = min(
            $reflectionCompleted,
            $totalReflection
        );


        /*
        |--------------------------------------------------------------------------
        | PROGRES LKPD
        |--------------------------------------------------------------------------
        |
        | LKPD BERDIRI SENDIRI.
        |
        | Tidak menggunakan:
        |
        | - student_id pada tabel lkpds
        | | hardcode 1-8
        | | foto
        |
        |
        | Struktur:
        |
        | lkpds
        |     ↓
        | lkpd_questions
        |     ↓
        | lkpd_answers
        |
        |
        | Hanya LKPD aktif milik Guru yang dihitung.
        |
        */

        $activeLkpds = LKPD::query()
            ->where('aktif', true)
            ->withCount('questions')
            ->get();


        $totalLKPD =
            $activeLkpds->count();


        $lkpdCompleted = 0;


        if ($totalLKPD > 0) {

            $lkpdIds =
                $activeLkpds
                    ->pluck('id');


            /*
            |--------------------------------------------------------------------------
            | HITUNG SOAL YANG SUDAH DIJAWAB SISWA
            |--------------------------------------------------------------------------
            |
            | Setiap kombinasi:
            |
            | lkpd_id
            | student_id
            | lkpd_question_id
            |
            | hanya boleh satu record karena unique index.
            |
            */

            $answeredLKPDQuestions =
                LKPDAnswer::query()
                    ->where(
                        'student_id',
                        $student->id
                    )
                    ->whereIn(
                        'lkpd_id',
                        $lkpdIds
                    )
                    ->whereNotNull('jawaban')
                    ->where(
                        'jawaban',
                        '!=',
                        ''
                    )
                    ->selectRaw(
                        'lkpd_id, COUNT(DISTINCT lkpd_question_id) as total_answered'
                    )
                    ->groupBy('lkpd_id')
                    ->get()
                    ->keyBy('lkpd_id');


            /*
            |--------------------------------------------------------------------------
            | TENTUKAN LKPD YANG SELESAI
            |--------------------------------------------------------------------------
            */

            foreach (
                $activeLkpds as $lkpd
            ) {

                $totalQuestions =
                    (int) $lkpd->questions_count;


                $totalAnswered =
                    isset(
                        $answeredLKPDQuestions[
                            $lkpd->id
                        ]
                    )
                        ? (int)
                            $answeredLKPDQuestions[
                                $lkpd->id
                            ]->total_answered
                        : 0;


                /*
                |--------------------------------------------------------------------------
                | LKPD TANPA SOAL TIDAK DIHITUNG SELESAI
                |--------------------------------------------------------------------------
                */

                if (
                    $totalQuestions > 0 &&
                    $totalAnswered >= $totalQuestions
                ) {

                    $lkpdCompleted++;
                }
            }
        }


        $lkpdProgress = min(
            $lkpdCompleted,
            $totalLKPD
        );


        /*
        |--------------------------------------------------------------------------
        | PROGRES PRAKTIK
        |--------------------------------------------------------------------------
        |
        | Praktik mengikuti tugas aktif yang dibuat Guru.
        |
        | INDIVIDU:
        | - dihitung selesai jika siswa sudah mengumpulkan link.
        |
        | KELOMPOK:
        | - jika kelompok sudah mengumpulkan, seluruh anggota kelompok
        |   dianggap sudah mengumpulkan tugas tersebut.
        |
        | Satu assignment hanya dihitung satu kali.
        |
        */

        $activeAssignments = Assignment::query()
            ->where('aktif', true)
            ->get();


        $totalPraktik =
            $activeAssignments->count();


        $praktikCompleted = 0;


        if (
            $student->id &&
            $activeAssignments->isNotEmpty()
        ) {

            $assignmentIds =
                $activeAssignments
                    ->pluck('id');


            /*
            |--------------------------------------------------------------------------
            | PENGUMPULAN INDIVIDU
            |--------------------------------------------------------------------------
            */

            $individualAssignmentIds =
                AssignmentSubmission::query()
                    ->where(
                        'student_id',
                        $student->id
                    )
                    ->whereIn(
                        'assignment_id',
                        $assignmentIds
                    )
                    ->whereNull('assignment_group_id')
                    ->whereNotNull('submitted_at')
                    ->pluck('assignment_id');


            /*
            |--------------------------------------------------------------------------
            | KELOMPOK SISWA
            |--------------------------------------------------------------------------
            */

            $groupIds =
                AssignmentGroupMember::query()
                    ->where(
                        'student_id',
                        $student->id
                    )
                    ->pluck('assignment_group_id');


            /*
            |--------------------------------------------------------------------------
            | PENGUMPULAN KELOMPOK
            |--------------------------------------------------------------------------
            */

            $groupAssignmentIds =
                collect();


            if ($groupIds->isNotEmpty()) {

                $groupAssignmentIds =
                    AssignmentSubmission::query()
                        ->whereIn(
                            'assignment_group_id',
                            $groupIds
                        )
                        ->whereIn(
                            'assignment_id',
                            $assignmentIds
                        )
                        ->whereNotNull('submitted_at')
                        ->pluck('assignment_id');
            }


            /*
            |--------------------------------------------------------------------------
            | GABUNG INDIVIDU + KELOMPOK
            |--------------------------------------------------------------------------
            */

            $praktikCompleted =
                $individualAssignmentIds
                    ->merge(
                        $groupAssignmentIds
                    )
                    ->unique()
                    ->count();


            $praktikCompleted =
                min(
                    $praktikCompleted,
                    $totalPraktik
                );
        }


        $praktikProgress =
            $praktikCompleted;


        /*
        |--------------------------------------------------------------------------
        | PERSENTASE PRAKTIK
        |--------------------------------------------------------------------------
        */

        $praktikPercentage =
            $totalPraktik > 0
                ? round(
                    (
                        $praktikProgress /
                        $totalPraktik
                    ) * 100
                )
                : 0;


        /*
        |--------------------------------------------------------------------------
        | PERSENTASE ABSENSI
        |--------------------------------------------------------------------------
        */

        $attendancePercentage =
            $totalPertemuan > 0
                ? round(
                    (
                        $attendanceProgress /
                        $totalPertemuan
                    ) * 100
                )
                : 0;


        /*
        |--------------------------------------------------------------------------
        | PERSENTASE QUIZ
        |--------------------------------------------------------------------------
        */

        $quizPercentage =
            $totalQuiz > 0
                ? round(
                    (
                        $quizCompleted /
                        $totalQuiz
                    ) * 100
                )
                : 0;


        /*
        |--------------------------------------------------------------------------
        | PERSENTASE REFLEKSI
        |--------------------------------------------------------------------------
        */

        $reflectionPercentage =
            $totalReflection > 0
                ? round(
                    (
                        $reflectionProgress /
                        $totalReflection
                    ) * 100
                )
                : 0;


        /*
        |--------------------------------------------------------------------------
        | PERSENTASE LKPD
        |--------------------------------------------------------------------------
        */

        $lkpdPercentage =
            $totalLKPD > 0
                ? round(
                    (
                        $lkpdProgress /
                        $totalLKPD
                    ) * 100
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

                'totalReflection',
                'reflectionProgress',
                'reflectionPercentage',

                'totalLKPD',
                'lkpdProgress',
                'lkpdPercentage',

                'totalPraktik',
                'praktikProgress',
                'praktikPercentage'
            )
        );
    }
}