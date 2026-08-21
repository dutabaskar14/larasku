<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\QuizMeetingAdmin;
use App\Models\Student;
use Illuminate\Http\Request;

class QuizControllerSiswa extends Controller
{
    /**
     * ============================================================
     * HALAMAN QUIZ SISWA
     * ============================================================
     *
     * Pertemuan Quiz berdiri sendiri.
     *
     * Sumber pertemuan:
     * quiz_meetings
     *
     * Tidak menggunakan:
     * - Material
     * - material_meetings
     * - hardcode 1-8
     *
     * Semua pertemuan mengikuti data yang dibuat
     * oleh admin/guru pada tabel quiz_meetings.
     */
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | DAFTAR PERTEMUAN QUIZ
        |--------------------------------------------------------------------------
        |
        | Hanya mengambil pertemuan yang benar-benar tersedia
        | pada tabel quiz_meetings.
        |
        */

        $pertemuans = QuizMeetingAdmin::query()
            ->orderBy('pertemuan')
            ->pluck('pertemuan')
            ->map(function ($item) {
                return (int) $item;
            })
            ->values();


        /*
        |--------------------------------------------------------------------------
        | PERTEMUAN YANG DIPILIH
        |--------------------------------------------------------------------------
        |
        | Jika user memilih pertemuan tertentu, gunakan pertemuan tersebut.
        |
        | Jika belum memilih:
        | gunakan pertemuan pertama yang tersedia.
        |
        */

        $pertemuan = $request->get('pertemuan');


        if ($pertemuan !== null && $pertemuan !== '') {

            $pertemuan = (int) $pertemuan;

        } else {

            $pertemuan = $pertemuans->first();

        }


        /*
        |--------------------------------------------------------------------------
        | PASTIKAN PERTEMUAN TERDAFTAR
        |--------------------------------------------------------------------------
        |
        | Tidak ada lagi batas:
        |
        | min:1
        | max:8
        | max:255
        |
        | Pertemuan sepenuhnya mengikuti quiz_meetings.
        |
        */

        if (
            $pertemuan !== null &&
            ! $pertemuans->contains($pertemuan)
        ) {

            $pertemuan = $pertemuans->first();

        }


        /*
        |--------------------------------------------------------------------------
        | KELAS
        |--------------------------------------------------------------------------
        */

        $kelas = $request->get(
            'kelas',
            ''
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
        | DAFTAR SISWA
        |--------------------------------------------------------------------------
        */

        $students = collect();


        if ($kelas !== '') {

            $students = Student::query()
                ->where('aktif', true)
                ->where('kelas', $kelas)
                ->orderBy('nomor_absen')
                ->orderBy('nama')
                ->get();

        }


        /*
        |--------------------------------------------------------------------------
        | SISWA YANG DIPILIH
        |--------------------------------------------------------------------------
        */

        $studentId = $request->get(
            'student_id'
        );


        $selectedStudent = null;


        if ($studentId) {

            $selectedStudent = $students
                ->firstWhere(
                    'id',
                    (int) $studentId
                );

        }


        /*
        |--------------------------------------------------------------------------
        | QUIZ
        |--------------------------------------------------------------------------
        |
        | Quiz hanya dicari berdasarkan pertemuan yang
        | tersedia di quiz_meetings.
        |
        | Quiz harus aktif.
        |
        */

        $quiz = null;


        if ($pertemuan !== null) {

            $quiz = Quiz::query()
                ->with([
                    'questions' => function ($query) {

                        $query->orderBy(
                            'urutan'
                        );

                    },
                ])
                ->where(
                    'pertemuan',
                    $pertemuan
                )
                ->where(
                    'aktif',
                    true
                )
                ->first();

        }


        /*
        |--------------------------------------------------------------------------
        | HASIL PENGERJAAN SISWA
        |--------------------------------------------------------------------------
        |
        | Jika siswa sudah mengerjakan:
        |
        | - Quiz tidak boleh dikerjakan ulang.
        | - Soal tidak perlu ditampilkan.
        | - Blade menerima attempt untuk status dan nilai.
        |
        */

        $existingAttempt = null;


        if (
            $selectedStudent &&
            $quiz
        ) {

            $existingAttempt = QuizAttempt::query()
                ->where(
                    'student_id',
                    $selectedStudent->id
                )
                ->where(
                    'quiz_id',
                    $quiz->id
                )
                ->first();

        }


        /*
        |--------------------------------------------------------------------------
        | STATUS QUIZ
        |--------------------------------------------------------------------------
        */

        $quizCompleted =
            $existingAttempt !== null;


        $quizScore =
            $existingAttempt
                ? $existingAttempt->nilai
                : null;


        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'quiz.index',
            compact(
                'classes',
                'kelas',
                'students',
                'studentId',
                'selectedStudent',

                'pertemuans',
                'pertemuan',

                'quiz',

                'existingAttempt',
                'quizCompleted',
                'quizScore'
            )
        );
    }


    /**
     * ============================================================
     * SUBMIT QUIZ
     * ============================================================
     *
     * Quiz hanya boleh dikerjakan SATU KALI
     * oleh satu siswa pada satu Quiz.
     */
    public function submit(
        Request $request,
        Quiz $quiz
    ) {

        /*
        |--------------------------------------------------------------------------
        | PASTIKAN QUIZ AKTIF
        |--------------------------------------------------------------------------
        */

        if (! $quiz->aktif) {

            abort(404);

        }


        /*
        |--------------------------------------------------------------------------
        | VALIDASI SISWA DAN JAWABAN
        |--------------------------------------------------------------------------
        |
        | Pertemuan tidak divalidasi dengan max:8.
        |
        | Nilai pertemuan harus sama dengan Quiz yang dikirim
        | dan Quiz tersebut harus berasal dari pertemuan yang
        | terdaftar pada quiz_meetings.
        |
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
            ],

            'jawaban' => [
                'required',
                'array',
            ],

            'jawaban.*' => [
                'nullable',
                'in:A,B,C,D',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | PASTIKAN SISWA AKTIF
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
                ->withErrors([
                    'student_id' =>
                        'Siswa tidak ditemukan atau sudah tidak aktif.',
                ])
                ->withInput();

        }


        /*
        |--------------------------------------------------------------------------
        | PASTIKAN PERTEMUAN SESUAI QUIZ
        |--------------------------------------------------------------------------
        */

        if (
            (int) $quiz->pertemuan !==
            (int) $validated['pertemuan']
        ) {

            return back()
                ->withErrors([
                    'pertemuan' =>
                        'Pertemuan Quiz tidak sesuai dengan Quiz yang dikirim.',
                ])
                ->withInput();

        }


        /*
        |--------------------------------------------------------------------------
        | PASTIKAN PERTEMUAN MEMANG TERDAFTAR
        |--------------------------------------------------------------------------
        |
        | Ini yang membuat Quiz benar-benar mengikuti
        | quiz_meetings.
        |
        */

        $meetingExists = QuizMeetingAdmin::query()
            ->where(
                'pertemuan',
                $quiz->pertemuan
            )
            ->exists();


        if (! $meetingExists) {

            return back()
                ->withErrors([
                    'pertemuan' =>
                        'Pertemuan Quiz tidak tersedia.',
                ])
                ->withInput();

        }


        /*
        |--------------------------------------------------------------------------
        | CEK SUDAH PERNAH MENGERJAKAN
        |--------------------------------------------------------------------------
        |
        | Jika sudah ada attempt:
        |
        | - jangan update
        | - jangan overwrite
        | - jangan hitung ulang
        | - jangan membuat attempt baru
        |
        */

        $existingAttempt = QuizAttempt::query()
            ->where(
                'quiz_id',
                $quiz->id
            )
            ->where(
                'student_id',
                $student->id
            )
            ->first();


        if ($existingAttempt) {

            return redirect()
                ->route(
                    'quiz.index',
                    [
                        'kelas' =>
                            $student->kelas,

                        'student_id' =>
                            $student->id,

                        'pertemuan' =>
                            $quiz->pertemuan,
                    ]
                )
                ->with(
                    'info',
                    'Quiz ini sudah pernah dikerjakan. Siswa tidak dapat mengerjakan ulang.'
                );

        }


        /*
        |--------------------------------------------------------------------------
        | AMBIL SEMUA SOAL
        |--------------------------------------------------------------------------
        */

        $quiz->load([
            'questions' => function ($query) {

                $query->orderBy(
                    'urutan'
                );

            },
        ]);


        /*
        |--------------------------------------------------------------------------
        | JAWABAN
        |--------------------------------------------------------------------------
        */

        $jawaban =
            $validated['jawaban'];


        $jumlahSoal =
            $quiz->questions->count();


        $jumlahBenar = 0;


        /*
        |--------------------------------------------------------------------------
        | PENILAIAN OTOMATIS
        |--------------------------------------------------------------------------
        */

        foreach (
            $quiz->questions as $question
        ) {

            $jawabanSiswa =
                $jawaban[$question->id]
                ?? null;


            if (
                $jawabanSiswa &&
                strtoupper(
                    $jawabanSiswa
                ) ===
                strtoupper(
                    $question->jawaban_benar
                )
            ) {

                $jumlahBenar++;

            }

        }


        /*
        |--------------------------------------------------------------------------
        | HITUNG NILAI
        |--------------------------------------------------------------------------
        */

        $nilai =
            $jumlahSoal > 0
                ? round(
                    (
                        $jumlahBenar /
                        $jumlahSoal
                    ) * 100,
                    2
                )
                : 0;


        /*
        |--------------------------------------------------------------------------
        | SIMPAN HASIL
        |--------------------------------------------------------------------------
        |
        | create() digunakan agar attempt yang sudah ada
        | tidak ditimpa.
        |
        */

        QuizAttempt::create([

            'quiz_id' =>
                $quiz->id,

            'student_id' =>
                $student->id,

            'jawaban' =>
                $jawaban,

            'jumlah_benar' =>
                $jumlahBenar,

            'jumlah_soal' =>
                $jumlahSoal,

            'nilai' =>
                $nilai,

            'dikerjakan_at' =>
                now(),

        ]);


        /*
        |--------------------------------------------------------------------------
        | KEMBALI KE QUIZ
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'quiz.index',
                [
                    'kelas' =>
                        $student->kelas,

                    'student_id' =>
                        $student->id,

                    'pertemuan' =>
                        $quiz->pertemuan,
                ]
            )
            ->with([
                'success' =>
                    'Quiz berhasil dikerjakan dan dinilai otomatis.',

                'jumlah_benar' =>
                    $jumlahBenar,

                'jumlah_soal' =>
                    $jumlahSoal,

                'nilai' =>
                    $nilai,
            ]);

    }


    /**
     * ============================================================
     * HASIL QUIZ
     * ============================================================
     */
    public function result(
        Request $request,
        Quiz $quiz
    ) {

        /*
        |--------------------------------------------------------------------------
        | BELUM ADA SISWA
        |--------------------------------------------------------------------------
        */

        $studentId =
            $request->get(
                'student_id'
            );


        if (! $studentId) {

            return redirect()
                ->route(
                    'quiz.index',
                    [
                        'pertemuan' =>
                            $quiz->pertemuan,
                    ]
                );

        }


        /*
        |--------------------------------------------------------------------------
        | CARI SISWA AKTIF
        |--------------------------------------------------------------------------
        */

        $student = Student::query()
            ->where(
                'id',
                $studentId
            )
            ->where(
                'aktif',
                true
            )
            ->first();


        if (! $student) {

            abort(404);

        }


        /*
        |--------------------------------------------------------------------------
        | AMBIL ATTEMPT
        |--------------------------------------------------------------------------
        */

        $attempt = QuizAttempt::query()
            ->where(
                'quiz_id',
                $quiz->id
            )
            ->where(
                'student_id',
                $student->id
            )
            ->first();


        /*
        |--------------------------------------------------------------------------
        | VIEW HASIL
        |--------------------------------------------------------------------------
        */

        return view(
            'quiz.result',
            compact(
                'quiz',
                'student',
                'attempt'
            )
        );

    }
}