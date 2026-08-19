<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    /**
     * Daftar Quiz Guru.
     */
    public function index(Request $request)
    {
        $pertemuan = (int) $request->get('pertemuan', 1);

        if ($pertemuan < 1 || $pertemuan > 8) {
            $pertemuan = 1;
        }

        $quizzes = Quiz::query()
            ->withCount('questions')
            ->orderBy('pertemuan')
            ->get();

        $quiz = Quiz::query()
            ->with([
                'questions' => function ($query) {
                    $query->orderBy('urutan');
                },
            ])
            ->withCount('questions')
            ->where('pertemuan', $pertemuan)
            ->first();

        return view('guru.quizzes.index', compact(
            'quizzes',
            'quiz',
            'pertemuan'
        ));
    }


    /**
     * Melihat seluruh hasil Quiz siswa.
     */
    public function show(Quiz $quiz)
    {
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

        return view('guru.quizzes.show', compact(
            'quiz'
        ));
    }


    /**
     * Edit seluruh soal dalam satu pertemuan.
     */
    public function edit(Quiz $quiz)
    {
        $quiz->load([
            'questions' => function ($query) {
                $query->orderBy('urutan');
            },
        ]);

        return view('guru.quizzes.edit', compact(
            'quiz'
        ));
    }


    /**
     * Update Quiz dan seluruh soal.
     */
    public function update(Request $request, Quiz $quiz)
    {
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
            $quiz
        ) {

            $quiz->update([

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
                as $questionId => $data
            ) {

                $question = $quiz->questions()
                    ->where(
                        'id',
                        $questionId
                    )
                    ->first();


                if (!$question) {
                    continue;
                }


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