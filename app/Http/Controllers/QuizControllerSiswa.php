<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\Student;
use Illuminate\Http\Request;

class QuizControllerSiswa extends Controller
{
    /**
     * Menampilkan halaman Quiz siswa.
     */
    public function index(Request $request)
    {
        $kelas = $request->get('kelas', '');

        $pertemuan = (int) $request->get('pertemuan', 1);

        if ($pertemuan < 1 || $pertemuan > 8) {
            $pertemuan = 1;
        }


        /*
        |--------------------------------------------------------------------------
        | Daftar kelas
        |--------------------------------------------------------------------------
        */

        $classes = Student::where('aktif', true)
            ->whereNotNull('kelas')
            ->where('kelas', '!=', '')
            ->select('kelas')
            ->distinct()
            ->orderBy('kelas')
            ->pluck('kelas');


        /*
        |--------------------------------------------------------------------------
        | Daftar siswa berdasarkan kelas
        |--------------------------------------------------------------------------
        */

        $students = collect();

        if ($kelas !== '') {

            $students = Student::where('aktif', true)
                ->where('kelas', $kelas)
                ->orderBy('nomor_absen')
                ->orderBy('nama')
                ->get();
        }


        /*
        |--------------------------------------------------------------------------
        | Siswa yang dipilih
        |--------------------------------------------------------------------------
        */

        $studentId = $request->get('student_id');

        $selectedStudent = null;

        if ($studentId) {

            $selectedStudent = $students
                ->firstWhere('id', (int) $studentId);
        }


        /*
        |--------------------------------------------------------------------------
        | Quiz berdasarkan pertemuan
        |--------------------------------------------------------------------------
        */

        $quiz = Quiz::query()
            ->with([
                'questions' => function ($query) {
                    $query->orderBy('urutan');
                },
            ])
            ->where('pertemuan', $pertemuan)
            ->where('aktif', true)
            ->first();


        /*
        |--------------------------------------------------------------------------
        | Hasil pengerjaan sebelumnya
        |--------------------------------------------------------------------------
        */

        $existingAttempt = null;

        if ($selectedStudent && $quiz) {

            $existingAttempt = QuizAttempt::where(
                'student_id',
                $selectedStudent->id
            )
                ->where(
                    'quiz_id',
                    $quiz->id
                )
                ->first();
        }


        return view('quiz.index', compact(
            'classes',
            'kelas',
            'students',
            'studentId',
            'selectedStudent',
            'pertemuan',
            'quiz',
            'existingAttempt'
        ));
    }


    /**
     * Menyimpan jawaban Quiz dan menghitung nilai otomatis.
     */
    public function submit(Request $request, Quiz $quiz)
    {
        /*
        |--------------------------------------------------------------------------
        | Pastikan Quiz aktif
        |--------------------------------------------------------------------------
        */

        if (!$quiz->aktif) {

            abort(404);
        }


        /*
        |--------------------------------------------------------------------------
        | Validasi data siswa
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
                'max:8',
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
        | Pastikan siswa aktif
        |--------------------------------------------------------------------------
        */

        $student = Student::where(
            'id',
            $validated['student_id']
        )
            ->where('aktif', true)
            ->first();


        if (!$student) {

            return back()
                ->withErrors([
                    'student_id' =>
                        'Siswa tidak ditemukan atau sudah tidak aktif.',
                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | Pastikan Quiz sesuai pertemuan
        |--------------------------------------------------------------------------
        */

        if ((int) $quiz->pertemuan !== (int) $validated['pertemuan']) {

            return back()
                ->withErrors([
                    'pertemuan' =>
                        'Pertemuan Quiz tidak sesuai.',
                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | Ambil semua soal
        |--------------------------------------------------------------------------
        */

        $quiz->load([
            'questions' => function ($query) {
                $query->orderBy('urutan');
            },
        ]);


        $jawaban = $validated['jawaban'];

        $jumlahSoal = $quiz->questions->count();

        $jumlahBenar = 0;


        /*
        |--------------------------------------------------------------------------
        | Penilaian otomatis
        |--------------------------------------------------------------------------
        */

        foreach ($quiz->questions as $question) {

            $jawabanSiswa = $jawaban[$question->id] ?? null;

            if (
                $jawabanSiswa &&
                strtoupper($jawabanSiswa) ===
                strtoupper($question->jawaban_benar)
            ) {

                $jumlahBenar++;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Hitung nilai 0 - 100
        |--------------------------------------------------------------------------
        */

        $nilai = $jumlahSoal > 0
            ? round(
                ($jumlahBenar / $jumlahSoal) * 100,
                2
            )
            : 0;


        /*
        |--------------------------------------------------------------------------
        | Simpan hasil
        |--------------------------------------------------------------------------
        */

        QuizAttempt::updateOrCreate(

            [
                'quiz_id' => $quiz->id,
                'student_id' => $student->id,
            ],

            [
                'jawaban' => $jawaban,
                'jumlah_benar' => $jumlahBenar,
                'jumlah_soal' => $jumlahSoal,
                'nilai' => $nilai,
                'dikerjakan_at' => now(),
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | Kembali ke halaman Quiz
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('quiz.index', [
                'kelas' => $student->kelas,
                'student_id' => $student->id,
                'pertemuan' => $quiz->pertemuan,
            ])
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
     * Menampilkan hasil Quiz.
     */
    public function result(Request $request, Quiz $quiz)
    {
        $studentId = $request->get('student_id');

        if (!$studentId) {

            return redirect()
                ->route('quiz.index', [
                    'pertemuan' => $quiz->pertemuan,
                ]);
        }


        $student = Student::where(
            'id',
            $studentId
        )
            ->where('aktif', true)
            ->first();


        if (!$student) {

            abort(404);
        }


        $attempt = QuizAttempt::where(
            'quiz_id',
            $quiz->id
        )
            ->where(
                'student_id',
                $student->id
            )
            ->first();


        return view('quiz.result', compact(
            'quiz',
            'student',
            'attempt'
        ));
    }
}