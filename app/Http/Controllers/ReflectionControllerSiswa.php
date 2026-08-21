<?php

namespace App\Http\Controllers;

use App\Models\Reflection;
use App\Models\ReflectionAnswer;
use App\Models\ReflectionMeeting;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReflectionControllerSiswa extends Controller
{
    /**
     * ============================================================
     * HALAMAN REFLEKSI SISWA
     * ============================================================
     */
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | PERTEMUAN REFLEKSI
        |--------------------------------------------------------------------------
        */

        $reflectionMeetings = ReflectionMeeting::query()
            ->orderBy('pertemuan')
            ->get();

        $pertemuans = $reflectionMeetings
            ->pluck('pertemuan')
            ->map(fn ($item) => (int) $item)
            ->values();


        /*
        |--------------------------------------------------------------------------
        | PERTEMUAN DIPILIH
        |--------------------------------------------------------------------------
        */

        $pertemuan = $request->get('pertemuan');

        if ($pertemuan !== null && $pertemuan !== '') {
            $pertemuan = (int) $pertemuan;
        } else {
            $pertemuan = $pertemuans->first();
        }

        if (
            $pertemuan !== null &&
            ! $pertemuans->contains($pertemuan)
        ) {
            abort(404);
        }


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
        | KELAS DIPILIH
        |--------------------------------------------------------------------------
        */

        $kelas = $request->get('kelas', '');


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
                ->orderByRaw('CAST(nomor_absen AS INTEGER) ASC')
                ->orderBy('nama')
                ->get();
        }


        /*
        |--------------------------------------------------------------------------
        | SISWA DIPILIH
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
        | REFLEKSI AKTIF
        |--------------------------------------------------------------------------
        */

        $reflection = null;

        if ($pertemuan !== null) {
            $reflection = Reflection::query()
                ->where('pertemuan', $pertemuan)
                ->where('aktif', true)
                ->with([
                    'questions' => function ($query) {
                        $query->orderBy('urutan');
                    },
                ])
                ->first();
        }


        /*
        |--------------------------------------------------------------------------
        | STATUS PENGERJAAN SISWA
        |--------------------------------------------------------------------------
        |
        | PENTING:
        |
        | Kita TIDAK mengirim isi jawaban ke Blade.
        |
        | Hanya mengirim:
        | - hasSubmitted
        | - hasBeenGraded
        | - score
        |
        */

        $hasSubmitted = false;
        $hasBeenGraded = false;
        $score = null;

        if ($reflection && $selectedStudent) {

            $answers = ReflectionAnswer::query()
                ->where('reflection_id', $reflection->id)
                ->where('student_id', $selectedStudent->id)
                ->get();

            $questionCount = $reflection->questions->count();

            /*
            |--------------------------------------------------------------------------
            | SUDAH SUBMIT
            |--------------------------------------------------------------------------
            |
            | Submission dianggap selesai apabila seluruh pertanyaan
            | mempunyai jawaban.
            |
            */

            $hasSubmitted =
                $questionCount > 0 &&
                $answers->count() >= $questionCount;

            if ($hasSubmitted) {

                /*
                |--------------------------------------------------------------------------
                | CEK PENILAIAN
                |--------------------------------------------------------------------------
                */

                $gradedAnswers = $answers->filter(
                    fn ($answer) => $answer->nilai !== null
                );

                $hasBeenGraded =
                    $gradedAnswers->count() === $questionCount;

                /*
                |--------------------------------------------------------------------------
                | NILAI RATA-RATA
                |--------------------------------------------------------------------------
                */

                if ($hasBeenGraded) {
                    $score = round(
                        $gradedAnswers->avg('nilai'),
                        2
                    );
                }
            }
        }


        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'reflections.index',
            compact(
                'classes',
                'kelas',
                'students',
                'studentId',
                'selectedStudent',
                'pertemuan',
                'pertemuans',
                'reflection',
                'hasSubmitted',
                'hasBeenGraded',
                'score'
            )
        );
    }


    /**
     * ============================================================
     * SIMPAN REFLEKSI SISWA
     * ============================================================
     *
     * SISWA HANYA BOLEH MENGIRIM SATU KALI.
     */
    public function store(Request $request)
    {
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
            ],

            'jawaban' => [
                'required',
                'array',
                'min:1',
            ],

            'jawaban.*' => [
                'required',
                'string',
                'max:5000',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | SISWA
        |--------------------------------------------------------------------------
        */

        $student = Student::query()
            ->where('id', $validated['student_id'])
            ->where('aktif', true)
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
        | REFLEKSI
        |--------------------------------------------------------------------------
        */

        $reflection = Reflection::query()
            ->where('pertemuan', $validated['pertemuan'])
            ->where('aktif', true)
            ->with([
                'questions' => function ($query) {
                    $query->orderBy('urutan');
                },
            ])
            ->first();

        if (! $reflection) {
            return back()
                ->withInput()
                ->withErrors([
                    'pertemuan' =>
                        'Refleksi belum tersedia atau belum diaktifkan oleh guru.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | CEK APAKAH SUDAH PERNAH MENGIRIM
        |--------------------------------------------------------------------------
        |
        | INI BAGIAN PENTING.
        |
        | Kalau sudah ada submission lengkap, langsung ditolak.
        | Tidak boleh update.
        |
        */

        $questionCount = $reflection->questions->count();

        $existingAnswerCount = ReflectionAnswer::query()
            ->where('reflection_id', $reflection->id)
            ->where('student_id', $student->id)
            ->count();

        if (
            $questionCount > 0 &&
            $existingAnswerCount >= $questionCount
        ) {
            return redirect()
                ->route('reflections.index', [
                    'kelas' => $student->kelas,
                    'student_id' => $student->id,
                    'pertemuan' => $reflection->pertemuan,
                ])
                ->with(
                    'success',
                    'Refleksi sudah pernah dikirim. Jawaban tidak dapat diubah.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | VALIDASI SOAL
        |--------------------------------------------------------------------------
        */

        $questions = $reflection->questions;

        $questionIds = $questions
            ->pluck('id')
            ->map(fn ($id) => (string) $id)
            ->values();

        $submittedQuestionIds = collect(
            array_keys($validated['jawaban'])
        )
            ->map(fn ($id) => (string) $id)
            ->values();


        /*
        |--------------------------------------------------------------------------
        | SOAL ILEGAL
        |--------------------------------------------------------------------------
        */

        $invalidQuestionIds = $submittedQuestionIds
            ->diff($questionIds);

        if ($invalidQuestionIds->isNotEmpty()) {
            return back()
                ->withInput()
                ->withErrors([
                    'jawaban' =>
                        'Terdapat pertanyaan yang tidak sesuai dengan refleksi.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | SOAL BELUM DIJAWAB
        |--------------------------------------------------------------------------
        */

        $missingQuestionIds = $questionIds
            ->diff($submittedQuestionIds);

        if ($missingQuestionIds->isNotEmpty()) {
            return back()
                ->withInput()
                ->withErrors([
                    'jawaban' =>
                        'Semua pertanyaan refleksi wajib dijawab.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN SEKALI
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use (
            $validated,
            $reflection,
            $student
        ) {

            foreach ($validated['jawaban'] as $questionId => $jawaban) {

                ReflectionAnswer::create([
                    'reflection_id' =>
                        $reflection->id,

                    'student_id' =>
                        $student->id,

                    'reflection_question_id' =>
                        (int) $questionId,

                    'jawaban' =>
                        trim($jawaban),

                    'nilai' =>
                        null,

                    'dinilai_at' =>
                        null,
                ]);
            }
        });


        /*
        |--------------------------------------------------------------------------
        | KEMBALI
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('reflections.index', [
                'kelas' => $student->kelas,
                'student_id' => $student->id,
                'pertemuan' => $reflection->pertemuan,
            ])
            ->with(
                'success',
                'Refleksi berhasil dikirim. Jawaban tidak dapat diubah kembali.'
            );
    }
}