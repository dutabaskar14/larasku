<?php

namespace App\Http\Controllers;

use App\Models\LKPD;
use App\Models\LKPDAnswer;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LKPDControllerSiswa extends Controller
{
    /**
     * ============================================================
     * HALAMAN LKPD SISWA
     * ============================================================
     *
     * LKPD berdiri sendiri.
     *
     * Tidak bergantung pada:
     * - Material
     * - MaterialMeeting
     *
     * Struktur:
     *
     * lkpds
     *     ↓
     * lkpd_questions
     *     ↓
     * lkpd_answers
     *     ↓
     * students
     */
    public function index(Request $request)
    {
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
        | KELAS TERPILIH
        |--------------------------------------------------------------------------
        */

        $kelas = trim(
            (string) $request->get('kelas', '')
        );


        /*
        |--------------------------------------------------------------------------
        | DAFTAR SISWA
        |--------------------------------------------------------------------------
        */

        $students = collect();

        if ($kelas !== '') {

            $students = Student::query()
                ->where('aktif', true)
                ->where('kelas', $kelas)
                ->orderByRaw(
                    'CAST(nomor_absen AS INTEGER) ASC'
                )
                ->orderBy('nama')
                ->get();
        }


        /*
        |--------------------------------------------------------------------------
        | SISWA TERPILIH
        |--------------------------------------------------------------------------
        */

        $studentId = $request->get('student_id');

        $selectedStudent = null;

        if ($studentId) {

            $selectedStudent = $students->firstWhere(
                'id',
                (int) $studentId
            );
        }


        /*
        |--------------------------------------------------------------------------
        | DAFTAR LKPD AKTIF
        |--------------------------------------------------------------------------
        |
        | LKPD sepenuhnya dikelola guru.
        |
        | Tidak menggunakan Material.
        | Tidak menggunakan MaterialMeeting.
        | Tidak menggunakan hardcode 1-8.
        |
        */

        $lkpds = LKPD::query()
            ->where('aktif', true)
            ->with([
                'questions' => function ($query) {
                    $query->orderBy('urutan');
                },
            ])
            ->orderBy('pertemuan')
            ->orderBy('id')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | PERTEMUAN TERPILIH
        |--------------------------------------------------------------------------
        */

        $pertemuan = $request->get('pertemuan');

        if (
            $pertemuan !== null &&
            $pertemuan !== ''
        ) {

            $pertemuan = (int) $pertemuan;

        } else {

            $pertemuan = $lkpds
                ->pluck('pertemuan')
                ->map(
                    fn ($item) => (int) $item
                )
                ->first();
        }


        /*
        |--------------------------------------------------------------------------
        | LKPD TERPILIH
        |--------------------------------------------------------------------------
        */

        $lkpd = null;

        if ($pertemuan !== null) {

            $lkpd = $lkpds->firstWhere(
                'pertemuan',
                (int) $pertemuan
            );
        }


        /*
        |--------------------------------------------------------------------------
        | STATUS SISWA
        |--------------------------------------------------------------------------
        |
        | Status:
        |
        | 1. Belum mengerjakan
        | 2. Sudah mengerjakan, menunggu nilai
        | 3. Sudah dinilai
        |
        | Jawaban siswa TIDAK dikirim untuk ditampilkan
        | sebagai isi jawaban di halaman siswa.
        |--------------------------------------------------------------------------
        */

        $lkpdSubmitted = false;

        $lkpdScore = null;

        $lkpdGraded = false;

        $totalQuestions = $lkpd
            ? $lkpd->questions->count()
            : 0;

        $answeredQuestions = 0;


        /*
        |--------------------------------------------------------------------------
        | CEK SUBMISSION
        |--------------------------------------------------------------------------
        */

        if (
            $selectedStudent &&
            $lkpd
        ) {

            $existingAnswers = LKPDAnswer::query()
                ->where(
                    'lkpd_id',
                    $lkpd->id
                )
                ->where(
                    'student_id',
                    $selectedStudent->id
                )
                ->get();


            /*
            |--------------------------------------------------------------------------
            | SUDAH SUBMIT
            |--------------------------------------------------------------------------
            |
            | Satu record saja sudah cukup untuk menganggap
            | siswa pernah mengirim LKPD.
            |
            */

            $lkpdSubmitted =
                $existingAnswers->isNotEmpty();


            /*
            |--------------------------------------------------------------------------
            | JUMLAH JAWABAN
            |--------------------------------------------------------------------------
            */

            $answeredQuestions =
                $existingAnswers
                    ->filter(
                        function ($answer) {

                            return $answer->jawaban !== null
                                && trim(
                                    (string) $answer->jawaban
                                ) !== '';
                        }
                    )
                    ->count();


            /*
            |--------------------------------------------------------------------------
            | CEK PENILAIAN
            |--------------------------------------------------------------------------
            |
            | Semua soal harus memiliki nilai.
            |
            | PG:
            | langsung mempunyai nilai 0 atau 100.
            |
            | Essay:
            | NULL sampai guru memberikan nilai.
            |
            */

            if (
                $lkpdSubmitted &&
                $totalQuestions > 0 &&
                $existingAnswers->count() >= $totalQuestions
            ) {

                $allGraded =
                    $existingAnswers
                        ->filter(
                            fn ($answer) =>
                                $answer->nilai !== null
                        )
                        ->count() >= $totalQuestions;


                if ($allGraded) {

                    $totalScore =
                        $existingAnswers->sum(
                            fn ($answer) =>
                                (float) $answer->nilai
                        );


                    /*
                    |--------------------------------------------------------------------------
                    | NILAI AKHIR
                    |--------------------------------------------------------------------------
                    |
                    | Rata-rata nilai seluruh soal.
                    |
                    */

                    $lkpdScore = round(
                        $totalScore / $totalQuestions
                    );


                    $lkpdGraded = true;
                }
            }
        }


        /*
        |--------------------------------------------------------------------------
        | STATUS SELESAI
        |--------------------------------------------------------------------------
        */

        $lkpdCompleted =
            $totalQuestions > 0 &&
            $answeredQuestions >= $totalQuestions;


        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        |
        | existingAnswers sengaja TIDAK dikirim.
        |
        | Ini penting agar Blade siswa tidak mempunyai
        | data jawaban lama yang dapat ditampilkan.
        |
        */

        return view(
            'lkpd.index',
            compact(
                'classes',
                'kelas',
                'students',
                'studentId',
                'selectedStudent',
                'lkpds',
                'pertemuan',
                'lkpd',
                'totalQuestions',
                'answeredQuestions',
                'lkpdCompleted',
                'lkpdSubmitted',
                'lkpdScore',
                'lkpdGraded'
            )
        );
    }


    /**
     * ============================================================
     * SIMPAN JAWABAN LKPD
     * ============================================================
     *
     * Satu siswa hanya boleh mengirim SATU KALI
     * untuk SATU LKPD.
     */
    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI INPUT
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'student_id' => [
                'required',
                'integer',
                'exists:students,id',
            ],

            'pertemuan' => [
                'required',
                'integer',
                'min:1',
                'max:255',
            ],

            'jawaban' => [
                'required',
                'array',
                'min:1',
            ],

            'jawaban.*' => [
                'nullable',
                'string',
                'max:5000',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | CEK SISWA
        |--------------------------------------------------------------------------
        */

        $student = Student::query()
            ->where(
                'id',
                $validated['student_id']
            )
            ->where(
                'aktif',
                true
            )
            ->first();


        if (! $student) {

            return back()
                ->withInput()
                ->withErrors([
                    'student_id' =>
                        'Siswa tidak ditemukan atau sudah tidak aktif.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | CEK LKPD AKTIF
        |--------------------------------------------------------------------------
        */

        $lkpd = LKPD::query()
            ->where(
                'pertemuan',
                $validated['pertemuan']
            )
            ->where(
                'aktif',
                true
            )
            ->with([
                'questions' => function ($query) {
                    $query->orderBy('urutan');
                },
            ])
            ->first();


        if (! $lkpd) {

            return back()
                ->withInput()
                ->withErrors([
                    'pertemuan' =>
                        'LKPD untuk pertemuan tersebut belum tersedia atau belum diaktifkan oleh guru.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | CEK SUBMISSION LAMA
        |--------------------------------------------------------------------------
        |
        | INI ADALAH PENGUNCI UTAMA.
        |
        | Begitu siswa mempunyai SATU jawaban saja
        | pada LKPD tersebut, siswa dianggap sudah
        | pernah mengirim.
        |
        | Tidak boleh:
        |
        | - submit ulang
        | - mengganti jawaban
        | - mengulang pengerjaan
        |
        */

        $alreadySubmitted = LKPDAnswer::query()
            ->where(
                'lkpd_id',
                $lkpd->id
            )
            ->where(
                'student_id',
                $student->id
            )
            ->exists();


        if ($alreadySubmitted) {

            return redirect()
                ->route(
                    'lkpd.index',
                    [
                        'kelas' =>
                            $student->kelas,

                        'student_id' =>
                            $student->id,

                        'pertemuan' =>
                            $lkpd->pertemuan,
                    ]
                )
                ->with(
                    'success',
                    'LKPD ini sudah pernah dikirim. Jawaban tidak dapat diubah atau dikirim ulang.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | CEK SOAL
        |--------------------------------------------------------------------------
        */

        $questions = $lkpd->questions;


        if ($questions->isEmpty()) {

            return back()
                ->withInput()
                ->withErrors([
                    'jawaban' =>
                        'LKPD ini belum memiliki soal.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | ID SOAL YANG VALID
        |--------------------------------------------------------------------------
        */

        $questionIds = $questions
            ->pluck('id')
            ->map(
                fn ($id) => (string) $id
            )
            ->values();


        /*
        |--------------------------------------------------------------------------
        | ID SOAL YANG DIKIRIM
        |--------------------------------------------------------------------------
        */

        $submittedQuestionIds = collect(
            array_keys(
                $validated['jawaban']
            )
        )
            ->map(
                fn ($id) => (string) $id
            )
            ->values();


        /*
        |--------------------------------------------------------------------------
        | CEK SOAL ILEGAL
        |--------------------------------------------------------------------------
        */

        $invalidQuestionIds =
            $submittedQuestionIds->diff(
                $questionIds
            );


        if (
            $invalidQuestionIds->isNotEmpty()
        ) {

            return back()
                ->withInput()
                ->withErrors([
                    'jawaban' =>
                        'Terdapat soal yang tidak sesuai dengan LKPD ini.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | SEMUA SOAL WAJIB DIJAWAB
        |--------------------------------------------------------------------------
        */

        $missingQuestionIds =
            $questionIds->diff(
                $submittedQuestionIds
            );


        if (
            $missingQuestionIds->isNotEmpty()
        ) {

            return back()
                ->withInput()
                ->withErrors([
                    'jawaban' =>
                        'Semua soal LKPD wajib dijawab.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN SEMUA JAWABAN
        |--------------------------------------------------------------------------
        |
        | Transaction memastikan seluruh jawaban masuk
        | sebagai satu proses.
        |
        */

        DB::transaction(
            function () use (
                $validated,
                $lkpd,
                $student,
                $questions
            ) {

                /*
                |--------------------------------------------------------------------------
                | CEK ULANG DI DALAM TRANSACTION
                |--------------------------------------------------------------------------
                |
                | Untuk mencegah submit ganda ketika ada
                | request yang masuk hampir bersamaan.
                |
                */

                $alreadySubmitted =
                    LKPDAnswer::query()
                        ->where(
                            'lkpd_id',
                            $lkpd->id
                        )
                        ->where(
                            'student_id',
                            $student->id
                        )
                        ->lockForUpdate()
                        ->exists();


                if ($alreadySubmitted) {

                    throw new \RuntimeException(
                        'LKPD ini sudah pernah dikirim.'
                    );
                }


                /*
                |--------------------------------------------------------------------------
                | CREATE JAWABAN
                |--------------------------------------------------------------------------
                |
                | TIDAK menggunakan updateOrCreate().
                |
                | Jawaban hanya boleh dibuat sekali.
                |
                */

                foreach ($questions as $question) {

                    $questionId =
                        (string) $question->id;


                    $jawaban =
                        $validated['jawaban'][
                            $questionId
                        ] ?? null;


                    /*
                    |--------------------------------------------------------------------------
                    | NORMALISASI
                    |--------------------------------------------------------------------------
                    */

                    if (
                        is_string($jawaban)
                    ) {

                        $jawaban =
                            trim($jawaban);
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | JAWABAN WAJIB
                    |--------------------------------------------------------------------------
                    */

                    if (
                        $jawaban === null ||
                        $jawaban === ''
                    ) {

                        throw new \RuntimeException(
                            'Semua soal LKPD wajib dijawab.'
                        );
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | NILAI AWAL
                    |--------------------------------------------------------------------------
                    */

                    $nilai = null;

                    $dinilaiAt = null;


                    /*
                    |--------------------------------------------------------------------------
                    | PILIHAN GANDA
                    |--------------------------------------------------------------------------
                    |
                    | Benar = 100
                    | Salah = 0
                    |
                    */

                    if (
                        $question->jenis ===
                        'pilihan_ganda'
                    ) {

                        $nilai =
                            strtoupper(
                                $jawaban
                            ) ===
                            strtoupper(
                                (string)
                                $question->jawaban_benar
                            )
                                ? 100
                                : 0;


                        $dinilaiAt = now();
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | ESSAY
                    |--------------------------------------------------------------------------
                    |
                    | Nilai tetap NULL.
                    |
                    | Guru akan memberikan nilai
                    | melalui halaman admin/guru.
                    |
                    */

                    $lkpd->answers()->create([
                        'student_id' =>
                            $student->id,

                        'lkpd_question_id' =>
                            $question->id,

                        'jawaban' =>
                            $jawaban,

                        'nilai' =>
                            $nilai,

                        'dinilai_at' =>
                            $dinilaiAt,
                    ]);
                }
            }
        );


        /*
        |--------------------------------------------------------------------------
        | SELESAI
        |--------------------------------------------------------------------------
        |
        | Redirect penuh ke server.
        |
        | Halaman berikutnya akan membaca database
        | dan otomatis menampilkan status:
        |
        | - Menunggu penilaian
        | atau
        | - Nilai akhir
        |
        */

        return redirect()
            ->route(
                'lkpd.index',
                [
                    'kelas' =>
                        $student->kelas,

                    'student_id' =>
                        $student->id,

                    'pertemuan' =>
                        $lkpd->pertemuan,
                ]
            )
            ->with(
                'success',
                'LKPD berhasil dikirim. Jawaban tidak dapat diubah atau dikirim ulang.'
            );
    }
}