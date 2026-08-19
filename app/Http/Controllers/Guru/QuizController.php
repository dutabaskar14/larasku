<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizMeetingAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    /**
     * Daftar Quiz Guru.
     *
     * Pertemuan Quiz berdiri sendiri
     * dan tidak bergantung pada Material.
     */
    public function index(Request $request)
    {
        $pertemuans = QuizMeetingAdmin::query()
            ->orderBy('pertemuan')
            ->pluck('pertemuan')
            ->map(fn ($item) => (int) $item)
            ->values();

        $pertemuan = $request->get('pertemuan');

        if ($pertemuan !== null) {
            $pertemuan = (int) $pertemuan;
        }

        if (
            $pertemuan === null &&
            $pertemuans->isNotEmpty()
        ) {
            $pertemuan = $pertemuans->first();
        }

        if (
            $pertemuan !== null &&
            ! $pertemuans->contains($pertemuan)
        ) {
            $pertemuan = null;
        }

        $quizzes = Quiz::query()
            ->withCount('questions')
            ->orderBy('pertemuan')
            ->orderBy('id')
            ->get();

        $quiz = null;

        if ($pertemuan !== null) {
            $quiz = Quiz::query()
                ->with([
                    'questions' => function ($query) {
                        $query->orderBy('urutan');
                    },
                ])
                ->withCount('questions')
                ->where('pertemuan', $pertemuan)
                ->first();
        }

        return view(
            'guru.quizzes.index',
            compact(
                'quizzes',
                'quiz',
                'pertemuan',
                'pertemuans'
            )
        );
    }


    /**
     * Form Create Quiz.
     */
    public function create(Request $request)
    {
        $pertemuans = QuizMeetingAdmin::query()
            ->orderBy('pertemuan')
            ->pluck('pertemuan')
            ->map(fn ($item) => (int) $item)
            ->values();

        $pertemuan = $request->get('pertemuan');

        if ($pertemuan !== null) {
            $pertemuan = (int) $pertemuan;
        }

        if (
            $pertemuan === null &&
            $pertemuans->isNotEmpty()
        ) {
            $pertemuan = $pertemuans->first();
        }

        if (
            $pertemuan !== null &&
            ! $pertemuans->contains($pertemuan)
        ) {
            $pertemuan = null;
        }

        $existingQuiz = null;

        if ($pertemuan !== null) {
            $existingQuiz = Quiz::query()
                ->where(
                    'pertemuan',
                    $pertemuan
                )
                ->first();
        }

        return view(
            'guru.quizzes.create',
            compact(
                'pertemuans',
                'pertemuan',
                'existingQuiz'
            )
        );
    }


    /**
     * Menyimpan Quiz baru beserta seluruh soal.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'pertemuan' => [
                'required',
                'integer',
                'min:1',
            ],

            'judul' => [
                'required',
                'string',
                'max:255',
            ],

            'deskripsi' => [
                'nullable',
                'string',
            ],

            'aktif' => [
                'nullable',
                'boolean',
            ],

            'questions' => [
                'required',
                'array',
                'min:1',
            ],

            'questions.*.pertanyaan' => [
                'required',
                'string',
            ],

            'questions.*.opsi_a' => [
                'required',
                'string',
            ],

            'questions.*.opsi_b' => [
                'required',
                'string',
            ],

            'questions.*.opsi_c' => [
                'required',
                'string',
            ],

            'questions.*.opsi_d' => [
                'required',
                'string',
            ],

            'questions.*.jawaban_benar' => [
                'required',
                'in:A,B,C,D',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | PASTIKAN PERTEMUAN QUIZ MEMANG ADA
        |--------------------------------------------------------------------------
        */

        $meetingExists = QuizMeetingAdmin::query()
            ->where(
                'pertemuan',
                $validated['pertemuan']
            )
            ->exists();


        if (! $meetingExists) {

            return back()
                ->withInput()
                ->withErrors([
                    'pertemuan' =>
                        'Pertemuan Quiz tersebut belum dibuat.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | CEK QUIZ SUDAH ADA
        |--------------------------------------------------------------------------
        */

        $quizExists = Quiz::query()
            ->where(
                'pertemuan',
                $validated['pertemuan']
            )
            ->exists();


        if ($quizExists) {

            return back()
                ->withInput()
                ->withErrors([
                    'pertemuan' =>
                        'Quiz untuk pertemuan tersebut sudah ada. Silakan edit Quiz yang sudah dibuat.',
                ]);
        }


        DB::transaction(function () use ($validated) {

            $quiz = Quiz::create([

                'pertemuan' =>
                    $validated['pertemuan'],

                'judul' =>
                    $validated['judul'],

                'deskripsi' =>
                    $validated['deskripsi'] ?? null,

                'aktif' =>
                    isset($validated['aktif'])
                        ? (bool) $validated['aktif']
                        : false,

            ]);


            foreach (
                $validated['questions']
                as $index => $data
            ) {

                QuizQuestion::create([

                    'quiz_id' =>
                        $quiz->id,

                    'urutan' =>
                        $index + 1,

                    'pertanyaan' =>
                        $data['pertanyaan'],

                    'opsi_a' =>
                        $data['opsi_a'],

                    'opsi_b' =>
                        $data['opsi_b'],

                    'opsi_c' =>
                        $data['opsi_c'],

                    'opsi_d' =>
                        $data['opsi_d'],

                    'jawaban_benar' =>
                        $data['jawaban_benar'],

                ]);
            }
        });


        return redirect()
            ->route(
                'guru.quizzes.index',
                [
                    'pertemuan' =>
                        $validated['pertemuan'],
                ]
            )
            ->with(
                'success',
                'Quiz berhasil dibuat.'
            );
    }


    /**
     * Melihat seluruh hasil Quiz siswa.
     */
    public function show(
        Request $request,
        Quiz $quiz
    ) {
        $classes = ClassRoom::query()
            ->where('aktif', true)
            ->orderBy('nama')
            ->get();

        $kelas = $request->get('kelas');

        $quiz->load([

            'questions' => function ($query) {
                $query->orderBy('urutan');
            },

            'attempts' => function ($query) {
                $query
                    ->with('student')
                    ->orderByDesc('nilai')
                    ->orderBy('student_id');
            },

        ]);


        $attempts = $quiz->attempts;


        if (
            $kelas !== null &&
            $kelas !== ''
        ) {

            $attempts =
                $attempts
                    ->filter(function ($attempt) use ($kelas) {

                        return $attempt->student
                            && $attempt->student->kelas === $kelas;

                    })
                    ->values();
        }


        return view(
            'guru.quizzes.show',
            compact(
                'quiz',
                'classes',
                'kelas',
                'attempts'
            )
        );
    }


    /**
     * Form Edit Quiz.
     */
    public function edit(Quiz $quiz)
    {
        $quiz->load([

            'questions' => function ($query) {
                $query->orderBy('urutan');
            },

        ]);


        $pertemuans = QuizMeetingAdmin::query()
            ->orderBy('pertemuan')
            ->pluck('pertemuan')
            ->map(fn ($item) => (int) $item)
            ->values();


        return view(
            'guru.quizzes.edit',
            compact(
                'quiz',
                'pertemuans'
            )
        );
    }


    /**
     * Update Quiz dan seluruh soal.
     *
     * Mendukung:
     * - Edit soal lama
     * - Tambah soal baru
     * - Hapus soal
     * - Aktif / nonaktif Quiz
     */
    public function update(
        Request $request,
        Quiz $quiz
    ) {
        $validated = $request->validate([

            'judul' => [
                'required',
                'string',
                'max:255',
            ],

            'deskripsi' => [
                'nullable',
                'string',
            ],

            'aktif' => [
                'nullable',
                'boolean',
            ],

            'questions' => [
                'required',
                'array',
                'min:1',
            ],

            'questions.*.pertanyaan' => [
                'required',
                'string',
            ],

            'questions.*.opsi_a' => [
                'required',
                'string',
            ],

            'questions.*.opsi_b' => [
                'required',
                'string',
            ],

            'questions.*.opsi_c' => [
                'required',
                'string',
            ],

            'questions.*.opsi_d' => [
                'required',
                'string',
            ],

            'questions.*.jawaban_benar' => [
                'required',
                'in:A,B,C,D',
            ],

        ]);


        DB::transaction(function () use (
            $validated,
            $quiz,
            $request
        ) {

            /*
            |--------------------------------------------------------------------------
            | UPDATE INFORMASI QUIZ
            |--------------------------------------------------------------------------
            */

            $quiz->update([

                'judul' =>
                    $validated['judul'],

                'deskripsi' =>
                    $validated['deskripsi'] ?? null,

                'aktif' =>
                    $request->boolean('aktif'),

            ]);


            /*
            |--------------------------------------------------------------------------
            | ID SOAL LAMA YANG MASIH ADA
            |--------------------------------------------------------------------------
            */

            $existingQuestionIds = $quiz
                ->questions()
                ->pluck('id')
                ->map(fn ($id) => (string) $id)
                ->toArray();


            $submittedExistingIds = collect(
                $validated['questions']
            )
                ->keys()
                ->filter(function ($key) use (
                    $existingQuestionIds
                ) {

                    return in_array(
                        (string) $key,
                        $existingQuestionIds,
                        true
                    );

                })
                ->map(fn ($id) => (int) $id)
                ->values()
                ->toArray();


            /*
            |--------------------------------------------------------------------------
            | HAPUS SOAL YANG SUDAH DIHILANGKAN DARI FORM
            |--------------------------------------------------------------------------
            */

            $idsToDelete = array_diff(
                array_map(
                    'intval',
                    $existingQuestionIds
                ),
                $submittedExistingIds
            );


            if (! empty($idsToDelete)) {

                $quiz->questions()
                    ->whereIn(
                        'id',
                        $idsToDelete
                    )
                    ->delete();
            }


            /*
            |--------------------------------------------------------------------------
            | SIMPAN / UPDATE SOAL
            |--------------------------------------------------------------------------
            */

            foreach (
                $validated['questions']
                as $questionId => $data
            ) {

                /*
                |--------------------------------------------------------------------------
                | SOAL LAMA
                |--------------------------------------------------------------------------
                */

                if (
                    is_numeric($questionId) &&
                    in_array(
                        (string) $questionId,
                        $existingQuestionIds,
                        true
                    )
                ) {

                    $question = $quiz
                        ->questions()
                        ->where(
                            'id',
                            (int) $questionId
                        )
                        ->first();


                    if ($question) {

                        $question->update([

                            'pertanyaan' =>
                                $data['pertanyaan'],

                            'opsi_a' =>
                                $data['opsi_a'],

                            'opsi_b' =>
                                $data['opsi_b'],

                            'opsi_c' =>
                                $data['opsi_c'],

                            'opsi_d' =>
                                $data['opsi_d'],

                            'jawaban_benar' =>
                                $data['jawaban_benar'],

                        ]);
                    }

                } else {

                    /*
                    |--------------------------------------------------------------------------
                    | SOAL BARU
                    |--------------------------------------------------------------------------
                    */

                    $quiz->questions()->create([

                        'urutan' =>
                            0,

                        'pertanyaan' =>
                            $data['pertanyaan'],

                        'opsi_a' =>
                            $data['opsi_a'],

                        'opsi_b' =>
                            $data['opsi_b'],

                        'opsi_c' =>
                            $data['opsi_c'],

                        'opsi_d' =>
                            $data['opsi_d'],

                        'jawaban_benar' =>
                            $data['jawaban_benar'],

                    ]);
                }
            }


            /*
            |--------------------------------------------------------------------------
            | RAPIKAN NOMOR URUTAN
            |--------------------------------------------------------------------------
            */

            $questions = $quiz
                ->questions()
                ->orderBy('id')
                ->get();


            foreach (
                $questions as $index => $question
            ) {

                $question->update([
                    'urutan' => $index + 1,
                ]);
            }

        });


        return redirect()
            ->route(
                'guru.quizzes.index',
                [
                    'pertemuan' =>
                        $quiz->pertemuan,
                ]
            )
            ->with(
                'success',
                'Quiz dan seluruh soal berhasil diperbarui.'
            );
    }
}