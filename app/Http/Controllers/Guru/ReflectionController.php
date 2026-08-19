<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use App\Models\Reflection;
use App\Models\ReflectionMeeting;
use App\Models\ReflectionQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReflectionController extends Controller
{
    /**
     * ============================================================
     * REKAP REFLEKSI
     * ============================================================
     *
     * Pertemuan Refleksi berdiri sendiri.
     * Tidak mengambil data dari Material.
     */
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | DAFTAR PERTEMUAN REFLEKSI
        |--------------------------------------------------------------------------
        */

        $reflectionMeetings = ReflectionMeeting::query()
            ->orderBy('pertemuan')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | DATA PERTEMUAN UNTUK FILTER
        |--------------------------------------------------------------------------
        */

        $pertemuans = $reflectionMeetings
            ->pluck('pertemuan')
            ->map(fn ($item) => (int) $item)
            ->values();


        $kelas = $request->get('kelas');
        $pertemuan = $request->get('pertemuan');
        $status = $request->get('status');


        /*
        |--------------------------------------------------------------------------
        | DAFTAR KELAS
        |--------------------------------------------------------------------------
        */

        $classes = ClassRoom::query()
            ->where('aktif', true)
            ->orderBy('nama')
            ->pluck('nama');


        /*
        |--------------------------------------------------------------------------
        | DATA REFLEKSI
        |--------------------------------------------------------------------------
        */

        $reflections = Reflection::query()
            ->with([
                'questions',
                'answers.student',
            ])
            ->when(
                $pertemuan !== null &&
                $pertemuan !== '',
                function ($query) use ($pertemuan) {

                    $query->where(
                        'pertemuan',
                        (int) $pertemuan
                    );
                }
            )
            ->orderBy('pertemuan')
            ->orderBy('id')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | FILTER KELAS & STATUS
        |--------------------------------------------------------------------------
        */

        $reflections = $reflections
            ->filter(function ($reflection) use (
                $kelas,
                $status
            ) {

                $students = $reflection
                    ->answers
                    ->filter(
                        fn ($answer) =>
                            $answer->student
                    )
                    ->groupBy('student_id');


                /*
                |--------------------------------------------------------------------------
                | FILTER KELAS
                |--------------------------------------------------------------------------
                */

                if ($kelas) {

                    $students = $students->filter(
                        function ($answers) use ($kelas) {

                            $student = $answers
                                ->first()
                                ->student;

                            return $student &&
                                $student->kelas === $kelas;
                        }
                    );
                }


                /*
                |--------------------------------------------------------------------------
                | FILTER STATUS
                |--------------------------------------------------------------------------
                */

                if ($status) {

                    $students = $students->filter(
                        function ($answers) use ($status) {

                            if ($answers->isEmpty()) {
                                return false;
                            }


                            $sudahDinilai =
                                $answers->every(
                                    fn ($answer) =>
                                        $answer->nilai !== null
                                );


                            if ($status === 'dinilai') {

                                return $sudahDinilai;
                            }


                            if ($status === 'belum_dinilai') {

                                return ! $sudahDinilai;
                            }


                            return true;
                        }
                    );
                }


                /*
                |--------------------------------------------------------------------------
                | JIKA FILTER TIDAK MENEMUKAN SISWA
                |--------------------------------------------------------------------------
                */

                if (
                    ($kelas || $status) &&
                    $students->isEmpty()
                ) {

                    return false;
                }


                return true;
            })
            ->values();


        /*
        |--------------------------------------------------------------------------
        | KIRIM DATA KE VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'guru.reflections.index',
            compact(
                'reflections',
                'reflectionMeetings',
                'classes',
                'pertemuans',
                'kelas',
                'pertemuan',
                'status'
            )
        );
    }


    /**
     * ============================================================
     * CREATE REFLEKSI
     * ============================================================
     *
     * Pertemuan diambil dari reflection_meetings.
     * Tidak bergantung pada Material.
     */
    public function create(Request $request)
    {
        $pertemuans = ReflectionMeeting::query()
            ->orderBy('pertemuan')
            ->pluck('pertemuan')
            ->map(fn ($item) => (int) $item)
            ->values();


        $pertemuan = $request->get('pertemuan');


        if ($pertemuan !== null) {

            $pertemuan = (int) $pertemuan;
        }


        /*
        |--------------------------------------------------------------------------
        | JIKA BELUM MEMILIH PERTEMUAN
        |--------------------------------------------------------------------------
        */

        if (
            $pertemuan === null &&
            $pertemuans->isNotEmpty()
        ) {

            $pertemuan =
                $pertemuans->first();
        }


        /*
        |--------------------------------------------------------------------------
        | PASTIKAN PERTEMUAN MEMANG TERSEDIA
        |--------------------------------------------------------------------------
        */

        if (
            $pertemuan !== null &&
            ! $pertemuans->contains($pertemuan)
        ) {

            $pertemuan = null;
        }


        /*
        |--------------------------------------------------------------------------
        | CEK REFLEKSI YANG SUDAH ADA
        |--------------------------------------------------------------------------
        */

        $existingReflection = null;


        if ($pertemuan !== null) {

            $existingReflection = Reflection::query()
                ->where(
                    'pertemuan',
                    $pertemuan
                )
                ->first();
        }


        return view(
            'guru.reflections.create',
            compact(
                'pertemuans',
                'pertemuan',
                'existingReflection'
            )
        );
    }


    /**
     * ============================================================
     * SIMPAN REFLEKSI
     * ============================================================
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

        ]);


        /*
        |--------------------------------------------------------------------------
        | CEK PERTEMUAN
        |--------------------------------------------------------------------------
        */

        $meetingExists = ReflectionMeeting::query()
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
                        'Pertemuan tersebut belum dibuat. Silakan klik "Tambah Pertemuan" terlebih dahulu.',

                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | CEK DUPLIKAT REFLEKSI
        |--------------------------------------------------------------------------
        */

        $reflectionExists = Reflection::query()
            ->where(
                'pertemuan',
                $validated['pertemuan']
            )
            ->exists();


        if ($reflectionExists) {

            return back()
                ->withInput()
                ->withErrors([

                    'pertemuan' =>
                        'Refleksi untuk pertemuan tersebut sudah ada. Silakan edit Refleksi yang sudah dibuat.',

                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN REFLEKSI + SOAL
        |--------------------------------------------------------------------------
        */

        DB::transaction(
            function () use ($validated) {

                $reflection =
                    Reflection::create([

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

                    ReflectionQuestion::create([

                        'reflection_id' =>
                            $reflection->id,

                        'urutan' =>
                            $index + 1,

                        'pertanyaan' =>
                            $data['pertanyaan'],

                    ]);
                }
            }
        );


        return redirect()
            ->route(
                'guru.reflections.index',
                [
                    'pertemuan' =>
                        $validated['pertemuan'],
                ]
            )
            ->with(
                'success',
                'Refleksi berhasil dibuat.'
            );
    }


    /**
     * ============================================================
     * DETAIL REFLEKSI
     * ============================================================
     */
    public function show(
        Request $request,
        Reflection $reflection
    ) {

        $kelas =
            $request->get('kelas');


        $classes = ClassRoom::query()
            ->where('aktif', true)
            ->orderBy('nama')
            ->pluck('nama');


        $reflection->load([

            'questions' => function ($query) {

                $query->orderBy('urutan');
            },

            'answers' => function ($query) use ($kelas) {

                $query
                    ->with([
                        'student',
                        'question',
                    ])
                    ->when(
                        $kelas,
                        function ($answerQuery) use ($kelas) {

                            $answerQuery->whereHas(
                                'student',
                                function ($studentQuery) use ($kelas) {

                                    $studentQuery->where(
                                        'kelas',
                                        $kelas
                                    );
                                }
                            );
                        }
                    )
                    ->orderBy('student_id')
                    ->orderBy(
                        'reflection_question_id'
                    );
            },

        ]);


        return view(
            'guru.reflections.show',
            compact(
                'reflection',
                'classes',
                'kelas'
            )
        );
    }


    /**
     * ============================================================
     * EDIT REFLEKSI
     * ============================================================
     */
    public function edit(
        Reflection $reflection
    ) {

        $reflection->load([

            'questions' => function ($query) {

                $query->orderBy('urutan');
            },

        ]);


        /*
        |--------------------------------------------------------------------------
        | PERTEMUAN DARI REFLECTION_MEETINGS
        |--------------------------------------------------------------------------
        */

        $pertemuans = ReflectionMeeting::query()
            ->orderBy('pertemuan')
            ->pluck('pertemuan')
            ->map(fn ($item) => (int) $item)
            ->values();


        return view(
            'guru.reflections.edit',
            compact(
                'reflection',
                'pertemuans'
            )
        );
    }


    /**
     * ============================================================
     * UPDATE REFLEKSI
     * ============================================================
     */
    public function update(
        Request $request,
        Reflection $reflection
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

        ]);


        DB::transaction(
            function () use (
                $validated,
                $reflection,
                $request
            ) {

                /*
                |--------------------------------------------------------------------------
                | UPDATE INFORMASI REFLEKSI
                |--------------------------------------------------------------------------
                */

                $reflection->update([

                    'judul' =>
                        $validated['judul'],

                    'deskripsi' =>
                        $validated['deskripsi'] ?? null,

                    'aktif' =>
                        $request->boolean(
                            'aktif'
                        ),

                ]);


                /*
                |--------------------------------------------------------------------------
                | SOAL LAMA
                |--------------------------------------------------------------------------
                */

                $existingQuestionIds =
                    $reflection
                        ->questions()
                        ->pluck('id')
                        ->map(
                            fn ($id) =>
                                (string) $id
                        )
                        ->toArray();


                /*
                |--------------------------------------------------------------------------
                | SOAL YANG MASIH ADA
                |--------------------------------------------------------------------------
                */

                $submittedExistingIds =
                    collect(
                        $validated['questions']
                    )
                        ->keys()
                        ->filter(
                            function ($key)
                            use (
                                $existingQuestionIds
                            ) {

                                return in_array(
                                    (string) $key,
                                    $existingQuestionIds,
                                    true
                                );
                            }
                        )
                        ->map(
                            fn ($id) =>
                                (int) $id
                        )
                        ->values()
                        ->toArray();


                /*
                |--------------------------------------------------------------------------
                | HAPUS SOAL YANG DIHILANGKAN
                |--------------------------------------------------------------------------
                */

                $idsToDelete =
                    array_diff(
                        array_map(
                            'intval',
                            $existingQuestionIds
                        ),
                        $submittedExistingIds
                    );


                if (! empty($idsToDelete)) {

                    $reflection
                        ->questions()
                        ->whereIn(
                            'id',
                            $idsToDelete
                        )
                        ->delete();
                }


                /*
                |--------------------------------------------------------------------------
                | UPDATE / TAMBAH SOAL
                |--------------------------------------------------------------------------
                */

                foreach (
                    $validated['questions']
                    as $questionId => $data
                ) {

                    if (
                        is_numeric($questionId) &&
                        in_array(
                            (string) $questionId,
                            $existingQuestionIds,
                            true
                        )
                    ) {

                        $question =
                            $reflection
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

                            ]);
                        }

                    } else {

                        $reflection
                            ->questions()
                            ->create([

                                'urutan' => 0,

                                'pertanyaan' =>
                                    $data['pertanyaan'],

                            ]);
                    }
                }


                /*
                |--------------------------------------------------------------------------
                | RAPIKAN URUTAN
                |--------------------------------------------------------------------------
                */

                $questions =
                    $reflection
                        ->questions()
                        ->orderBy('id')
                        ->get();


                foreach (
                    $questions as $index => $question
                ) {

                    $question->update([

                        'urutan' =>
                            $index + 1,

                    ]);
                }
            }
        );


        return redirect()
            ->route(
                'guru.reflections.index',
                [
                    'pertemuan' =>
                        $reflection->pertemuan,
                ]
            )
            ->with(
                'success',
                'Refleksi dan seluruh soal berhasil diperbarui.'
            );
    }


    /**
     * ============================================================
     * HAPUS REFLEKSI
     * ============================================================
     *
     * Menghapus:
     * - data reflections
     * - seluruh reflection_questions
     * - seluruh reflection_answers
     *
     * Pertemuan pada reflection_meetings TIDAK dihapus.
     */
    public function destroy(
        Reflection $reflection
    ) {

        $pertemuan =
            $reflection->pertemuan;


        DB::transaction(
            function () use ($reflection) {

                /*
                |--------------------------------------------------------------------------
                | HAPUS REFLEKSI
                |--------------------------------------------------------------------------
                */

                $reflection->delete();
            }
        );


        return redirect()
            ->route(
                'guru.reflections.index',
                [
                    'pertemuan' =>
                        $pertemuan,
                ]
            )
            ->with(
                'success',
                'Refleksi, seluruh soal, dan jawaban siswa berhasil dihapus.'
            );
    }


    /**
     * ============================================================
     * NILAI REFLEKSI
     * ============================================================
     */
    public function grade(
        Request $request,
        Reflection $reflection
    ) {

        $validated = $request->validate([

            'nilai' => [
                'required',
                'array',
            ],

            'nilai.*' => [
                'required',
                'integer',
                'min:0',
                'max:100',
            ],

        ]);


        DB::transaction(
            function () use (
                $validated,
                $reflection
            ) {

                foreach (
                    $validated['nilai']
                    as $answerId => $nilai
                ) {

                    $answer =
                        $reflection
                            ->answers()
                            ->where(
                                'id',
                                $answerId
                            )
                            ->first();


                    if (! $answer) {

                        continue;
                    }


                    $answer->update([

                        'nilai' =>
                            $nilai,

                        'dinilai_at' =>
                            now(),

                    ]);
                }
            }
        );


        return redirect()
            ->route(
                'guru.reflections.index',
                [
                    'pertemuan' =>
                        $reflection->pertemuan,
                ]
            )
            ->with(
                'success',
                'Nilai refleksi berhasil diselesaikan.'
            );
    }
}