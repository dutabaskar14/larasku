<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\LKPD;
use App\Models\LKPDQuestion;
use App\Models\LKPDAnswer;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class LKPDController extends Controller
{
    /**
     * Rekap seluruh LKPD.
     */
    public function index(Request $request)
    {
        $kelas = $request->get('kelas', '');
        $pertemuan = $request->get('pertemuan', '');
        $status = $request->get('status', '');

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
        | DAFTAR PERTEMUAN LKPD
        |--------------------------------------------------------------------------
        |
        | Berdiri sendiri.
        | Tidak mengambil pertemuan dari Material.
        |
        */

        $pertemuans = LKPD::query()
            ->select('pertemuan')
            ->distinct()
            ->orderBy('pertemuan')
            ->pluck('pertemuan');


        /*
        |--------------------------------------------------------------------------
        | REKAP LKPD
        |--------------------------------------------------------------------------
        */

        $lkpds = LKPD::query()
            ->with([
                'questions',
                'answers.student',
                'answers.question',
            ])
            ->when(
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
        | FILTER KELAS & STATUS PENILAIAN
        |--------------------------------------------------------------------------
        |
        | Filter diterapkan berdasarkan jawaban siswa.
        |
        */

        if ($kelas !== '' || $status !== '') {

            $lkpds = $lkpds->filter(
                function (LKPD $lkpd) use (
                    $kelas,
                    $status
                ) {

                    /*
                    |--------------------------------------------------------------------------
                    | FILTER KELAS
                    |--------------------------------------------------------------------------
                    */

                    if ($kelas !== '') {

                        $adaKelas = $lkpd->answers
                            ->contains(
                                function ($answer) use ($kelas) {

                                    return $answer->student &&
                                        (string) $answer->student->kelas ===
                                        (string) $kelas;
                                }
                            );

                        if (! $adaKelas) {
                            return false;
                        }
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | FILTER STATUS
                    |--------------------------------------------------------------------------
                    */

                    if ($status !== '') {

                        $hasEssay = $lkpd->questions
                            ->contains(
                                fn ($question) =>
                                    $question->jenis === 'essay'
                            );


                        /*
                        |--------------------------------------------------------------------------
                        | PG SAJA
                        |--------------------------------------------------------------------------
                        |
                        | PG otomatis dinilai.
                        |
                        */

                        if (! $hasEssay) {

                            if ($status === 'dinilai') {
                                return true;
                            }

                            if ($status === 'belum_dinilai') {
                                return false;
                            }
                        }


                        /*
                        |--------------------------------------------------------------------------
                        | ADA ESSAY
                        |--------------------------------------------------------------------------
                        */

                        if ($hasEssay) {

                            $studentIds = $lkpd->answers
                                ->pluck('student_id')
                                ->filter()
                                ->unique();


                            $allFinished = $studentIds->every(
                                function ($studentId) use ($lkpd) {

                                    $essayQuestionIds =
                                        $lkpd->questions
                                            ->where(
                                                'jenis',
                                                'essay'
                                            )
                                            ->pluck('id');


                                    return ! $essayQuestionIds->contains(
                                        function ($questionId) use (
                                            $lkpd,
                                            $studentId
                                        ) {

                                            return ! $lkpd->answers
                                                ->where(
                                                    'student_id',
                                                    $studentId
                                                )
                                                ->where(
                                                    'lkpd_question_id',
                                                    $questionId
                                                )
                                                ->first(
                                                    fn ($answer) =>
                                                        $answer->nilai !== null
                                                );
                                        }
                                    );
                                }
                            );


                            if (
                                $status === 'dinilai' &&
                                ! $allFinished
                            ) {
                                return false;
                            }


                            if (
                                $status === 'belum_dinilai' &&
                                $allFinished
                            ) {
                                return false;
                            }
                        }
                    }


                    return true;
                }
            )
            ->values();
        }


        return view(
            'guru.lkpd.index',
            compact(
                'lkpds',
                'classes',
                'pertemuans',
                'kelas',
                'pertemuan',
                'status'
            )
        );
    }


    /**
     * Form membuat LKPD.
     */
    public function create()
    {
        /*
        |--------------------------------------------------------------------------
        | PERTEMUAN LKPD
        |--------------------------------------------------------------------------
        |
        | LKPD berdiri sendiri.
        |
        */

        $pertemuans = LKPD::query()
            ->select('pertemuan')
            ->distinct()
            ->orderBy('pertemuan')
            ->pluck('pertemuan');


        return view(
            'guru.lkpd.create',
            compact('pertemuans')
        );
    }


    /**
 * Menyimpan LKPD baru.
 */
public function store(Request $request)
{
    $validated = $request->validate([

        'pertemuan' => [
            'required',
            'integer',
            'min:1',
            'max:255',
            Rule::unique(
                'lkpds',
                'pertemuan'
            ),
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

        'questions.*.jenis' => [
            'required',
            Rule::in([
                'pilihan_ganda',
                'essay',
            ]),
        ],

        'questions.*.pertanyaan' => [
            'required',
            'string',
        ],

        'questions.*.opsi_a' => [
            'nullable',
            'string',
        ],

        'questions.*.opsi_b' => [
            'nullable',
            'string',
        ],

        'questions.*.opsi_c' => [
            'nullable',
            'string',
        ],

        'questions.*.opsi_d' => [
            'nullable',
            'string',
        ],

        'questions.*.jawaban_benar' => [
            'nullable',
            Rule::in([
                'A',
                'B',
                'C',
                'D',
            ]),
        ],

    ], [
        'pertemuan.required' =>
            'Pertemuan wajib dipilih.',

        'pertemuan.integer' =>
            'Nomor pertemuan harus berupa angka.',

        'pertemuan.min' =>
            'Nomor pertemuan minimal 1.',

        'pertemuan.max' =>
            'Nomor pertemuan maksimal 255.',

        'pertemuan.unique' =>
            'LKPD untuk pertemuan ini sudah dibuat. Silakan pilih pertemuan lain.',

        'judul.required' =>
            'Judul LKPD wajib diisi.',

        'questions.required' =>
            'Minimal harus ada satu soal.',

        'questions.min' =>
            'Minimal harus ada satu soal.',

        'questions.*.jenis.required' =>
            'Jenis soal wajib dipilih.',

        'questions.*.pertanyaan.required' =>
            'Pertanyaan wajib diisi.',
    ]);

    
        DB::transaction(
            function () use ($validated) {

                $lkpd = LKPD::create([

                    'pertemuan' =>
                        $validated['pertemuan'],

                    'judul' =>
                        $validated['judul'],

                    'deskripsi' =>
                        $validated['deskripsi'] ?? null,

                    'aktif' =>
                        $validated['aktif'] ?? false,

                ]);


                foreach (
                    $validated['questions']
                    as $index => $question
                ) {

                    LKPDQuestion::create([

                        'lkpd_id' =>
                            $lkpd->id,

                        'urutan' =>
                            $index + 1,

                        'jenis' =>
                            $question['jenis'],

                        'pertanyaan' =>
                            $question['pertanyaan'],

                        'opsi_a' =>
                            $question['opsi_a'] ?? null,

                        'opsi_b' =>
                            $question['opsi_b'] ?? null,

                        'opsi_c' =>
                            $question['opsi_c'] ?? null,

                        'opsi_d' =>
                            $question['opsi_d'] ?? null,

                        'jawaban_benar' =>
                            $question['jawaban_benar'] ?? null,

                    ]);
                }
            }
        );


        return redirect()
            ->route(
                'guru.lkpd.index'
            )
            ->with(
                'success',
                'LKPD berhasil dibuat.'
            );
    }


    /**
     * Detail LKPD dan rekap jawaban siswa.
     */
    public function show(LKPD $lkpd)
    {
        $lkpd->load([
            'questions',
            'answers.student',
            'answers.question',
        ]);


        return view(
            'guru.lkpd.show',
            compact('lkpd')
        );
    }


    /**
     * Form edit LKPD.
     */
    public function edit(LKPD $lkpd)
    {
        $lkpd->load('questions');


        $pertemuans = LKPD::query()
            ->where(
                'id',
                '!=',
                $lkpd->id
            )
            ->select('pertemuan')
            ->distinct()
            ->orderBy('pertemuan')
            ->pluck('pertemuan');


        return view(
            'guru.lkpd.edit',
            compact(
                'lkpd',
                'pertemuans'
            )
        );
    }


    /**
     * Memperbarui LKPD.
     */
    public function update(
        Request $request,
        LKPD $lkpd
    ) {
        $validated = $request->validate([

            'pertemuan' => [
                'required',
                'integer',
                'min:1',
                'max:255',
                Rule::unique(
                    'lkpds',
                    'pertemuan'
                )->ignore($lkpd->id),
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

            'questions.*.id' => [
                'nullable',
                'integer',
            ],

            'questions.*.jenis' => [
                'required',
                Rule::in([
                    'pilihan_ganda',
                    'essay',
                ]),
            ],

            'questions.*.pertanyaan' => [
                'required',
                'string',
            ],

            'questions.*.opsi_a' => [
                'nullable',
                'string',
            ],

            'questions.*.opsi_b' => [
                'nullable',
                'string',
            ],

            'questions.*.opsi_c' => [
                'nullable',
                'string',
            ],

            'questions.*.opsi_d' => [
                'nullable',
                'string',
            ],

            'questions.*.jawaban_benar' => [
                'nullable',
                Rule::in([
                    'A',
                    'B',
                    'C',
                    'D',
                ]),
            ],

        ]);


        DB::transaction(
            function () use (
                $validated,
                $lkpd
            ) {

                $lkpd->update([

                    'pertemuan' =>
                        $validated['pertemuan'],

                    'judul' =>
                        $validated['judul'],

                    'deskripsi' =>
                        $validated['deskripsi'] ?? null,

                    'aktif' =>
                        $validated['aktif'] ?? false,

                ]);


                /*
                |--------------------------------------------------------------------------
                | Hapus soal lama
                |--------------------------------------------------------------------------
                |
                | Jawaban siswa akan ikut terhapus karena
                | lkpd_question_id menggunakan cascade.
                |
                */

                $lkpd->questions()->delete();


                foreach (
                    $validated['questions']
                    as $index => $question
                ) {

                    LKPDQuestion::create([

                        'lkpd_id' =>
                            $lkpd->id,

                        'urutan' =>
                            $index + 1,

                        'jenis' =>
                            $question['jenis'],

                        'pertanyaan' =>
                            $question['pertanyaan'],

                        'opsi_a' =>
                            $question['opsi_a'] ?? null,

                        'opsi_b' =>
                            $question['opsi_b'] ?? null,

                        'opsi_c' =>
                            $question['opsi_c'] ?? null,

                        'opsi_d' =>
                            $question['opsi_d'] ?? null,

                        'jawaban_benar' =>
                            $question['jawaban_benar'] ?? null,

                    ]);
                }
            }
        );


        return redirect()
            ->route(
                'guru.lkpd.show',
                $lkpd
            )
            ->with(
                'success',
                'LKPD berhasil diperbarui.'
            );
    }


    /**
     * Menilai jawaban essay siswa.
     */
    public function grade(
        Request $request,
        LKPD $lkpd
    ) {
        $validated = $request->validate([

            'answers' => [
                'required',
                'array',
            ],

            'answers.*' => [
                'required',
                'integer',
                'min:0',
                'max:100',
            ],

        ]);


        DB::transaction(
            function () use (
                $validated,
                $lkpd
            ) {

                foreach (
                    $validated['answers']
                    as $answerId => $nilai
                ) {

                    $answer = LKPDAnswer::query()
                        ->where(
                            'lkpd_id',
                            $lkpd->id
                        )
                        ->where(
                            'id',
                            $answerId
                        )
                        ->first();


                    if (! $answer) {
                        continue;
                    }


                    if (
                        $answer->question &&
                        $answer->question->jenis ===
                        'essay'
                    ) {

                        $answer->update([

                            'nilai' =>
                                $nilai,

                            'dinilai_at' =>
                                now(),

                        ]);
                    }
                }
            }
        );


        return redirect()
            ->route(
                'guru.lkpd.show',
                $lkpd
            )
            ->with(
                'success',
                'Nilai essay berhasil disimpan.'
            );
    }


    /**
     * Menyelesaikan penilaian LKPD.
     *
     * Untuk LKPD essay atau campuran,
     * nilai akhir baru dianggap final setelah
     * seluruh essay selesai dinilai.
     */
    public function finalize(
        LKPD $lkpd
    ) {
        $lkpd->load([
            'questions',
            'answers.question',
        ]);


        $essayQuestionIds = $lkpd->questions
            ->where(
                'jenis',
                'essay'
            )
            ->pluck('id');


        /*
        |--------------------------------------------------------------------------
        | Pastikan seluruh essay sudah dinilai
        |--------------------------------------------------------------------------
        */

        if ($essayQuestionIds->isNotEmpty()) {

            $belumDinilai = $lkpd->answers
                ->whereIn(
                    'lkpd_question_id',
                    $essayQuestionIds
                )
                ->contains(
                    fn ($answer) =>
                        $answer->nilai === null
                );


            if ($belumDinilai) {

                return back()
                    ->with(
                        'error',
                        'Masih ada jawaban essay yang belum dinilai.'
                    );
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Nilai akhir akan dihitung ketika siswa
        | melihat hasil.
        |--------------------------------------------------------------------------
        |
        | Tidak perlu menyimpan nilai akhir di tabel
        | answers karena nilai per soal sudah tersedia.
        |
        */

        return redirect()
            ->route(
                'guru.lkpd.show',
                $lkpd
            )
            ->with(
                'success',
                'Penilaian LKPD berhasil diselesaikan.'
            );
    }


    /**
     * Menghapus LKPD.
     */
    public function destroy(
        LKPD $lkpd
    ) {
        $lkpd->delete();


        return redirect()
            ->route(
                'guru.lkpd.index'
            )
            ->with(
                'success',
                'LKPD berhasil dihapus.'
            );
    }
}