<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\AssignmentGroup;
use App\Models\AssignmentMeeting;
use App\Models\AssignmentSubmission;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AssignmentControllerSiswa extends Controller
{
    /**
     * ============================================================
     * HALAMAN TUGAS SISWA
     * ============================================================
     *
     * Struktur:
     *
     * P1 / P2 / P3 / dst.
     *          ↓
     *       KELAS
     *          ↓
     *   INDIVIDU / KELOMPOK
     *          ↓
     *   DETAIL NAMA / KELOMPOK
     *
     * Tidak menggunakan student_id sebagai filter utama tampilan.
     * student_id hanya digunakan saat siswa melakukan pengumpulan.
     */
    public function index(Request $request): View
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
        | Jika kelas tidak valid
        |--------------------------------------------------------------------------
        */

        if (
            $kelas !== '' &&
            !$classes->contains($kelas)
        ) {

            $kelas = '';
        }


        /*
        |--------------------------------------------------------------------------
        | PERTEMUAN
        |--------------------------------------------------------------------------
        |
        | Pertemuan berasal dari AssignmentMeeting.
        |
        | Karena AssignmentMeeting dibuat berdasarkan kelas,
        | maka P1/P2/P3 yang tampil mengikuti database Guru.
        |
        */

        $meetings = collect();


        if ($kelas !== '') {

            $meetings = AssignmentMeeting::query()
                ->where(
                    'kelas',
                    $kelas
                )
                ->where(
                    'aktif',
                    true
                )
                ->orderBy(
                    'pertemuan'
                )
                ->get();
        }


        /*
        |--------------------------------------------------------------------------
        | PERTEMUAN TERPILIH
        |--------------------------------------------------------------------------
        */

        $pertemuanInput =
            $request->get('pertemuan');


        $pertemuan = null;


        if (
            $pertemuanInput !== null &&
            $pertemuanInput !== ''
        ) {

            $pertemuanInput =
                (int) $pertemuanInput;


            if (
                $meetings->contains(
                    'pertemuan',
                    $pertemuanInput
                )
            ) {

                $pertemuan =
                    $pertemuanInput;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | DEFAULT PERTEMUAN
        |--------------------------------------------------------------------------
        */

        if (
            $pertemuan === null &&
            $meetings->isNotEmpty()
        ) {

            $pertemuan =
                (int) $meetings
                    ->first()
                    ->pertemuan;
        }


        /*
        |--------------------------------------------------------------------------
        | DAFTAR SISWA KELAS
        |--------------------------------------------------------------------------
        */

        $students = collect();


        if ($kelas !== '') {

            $students = Student::query()
                ->where(
                    'aktif',
                    true
                )
                ->where(
                    'kelas',
                    $kelas
                )
                ->orderBy(
                    'nomor_absen'
                )
                ->orderBy(
                    'nama'
                )
                ->get();
        }


        /*
        |--------------------------------------------------------------------------
        | TUGAS
        |--------------------------------------------------------------------------
        */

        $assignments = collect();


        if (
            $kelas !== '' &&
            $pertemuan !== null
        ) {

            $assignments = Assignment::query()

                ->where(
                    'kelas',
                    $kelas
                )

                ->where(
                    'pertemuan',
                    $pertemuan
                )

                ->where(
                    'aktif',
                    true
                )

                ->with([
                    'assignmentMeeting',

                    'groups.members.student',

                    'submissions.student',

                    'submissions.group.members.student',
                ])

                ->orderBy(
                    'id'
                )

                ->get();
        }


        /*
        |--------------------------------------------------------------------------
        | SIAPKAN DATA INDIVIDU & KELOMPOK
        |--------------------------------------------------------------------------
        */

        $assignments->each(
            function ($assignment) use ($students) {

                /*
                |--------------------------------------------------------------------------
                | MODE INDIVIDU
                |--------------------------------------------------------------------------
                */

                if (
                    $assignment->mode_pengumpulan ===
                    'individu'
                ) {

                    /*
                    |--------------------------------------------------------------------------
                    | Setiap siswa kelas
                    |--------------------------------------------------------------------------
                    */

                    $assignment->student_items =
                        $students->map(
                            function ($student) use ($assignment) {

                                /*
                                |--------------------------------------------------------------------------
                                | Submission siswa
                                |--------------------------------------------------------------------------
                                */

                                $submission =
                                    $assignment
                                        ->submissions
                                        ->firstWhere(
                                            'student_id',
                                            $student->id
                                        );


                                /*
                                |--------------------------------------------------------------------------
                                | Data default
                                |--------------------------------------------------------------------------
                                */

                                $item = new \stdClass();

                                $item->student =
                                    $student;

                                $item->submission =
                                    $submission;

                                $item->status =
                                    'belum_mengumpulkan';

                                $item->label =
                                    'Belum mengumpulkan';

                                $item->nilai =
                                    null;

                                $item->catatan_guru =
                                    null;

                                $item->can_edit =
                                    false;


                                /*
                                |--------------------------------------------------------------------------
                                | SUDAH MENGUMPULKAN
                                |--------------------------------------------------------------------------
                                */

                                if ($submission) {

                                    /*
                                    |--------------------------------------------------------------------------
                                    | SUDAH DINILAI
                                    |--------------------------------------------------------------------------
                                    */

                                    if (
                                        $submission->status ===
                                        'selesai'
                                    ) {

                                        $item->status =
                                            'selesai';

                                        $item->label =
                                            'Sudah dinilai';

                                        $item->nilai =
                                            $submission->nilai;

                                        $item->catatan_guru =
                                            $submission->catatan_guru;

                                        $item->can_edit =
                                            false;
                                    }

                                    /*
                                    |--------------------------------------------------------------------------
                                    | MENUNGGU PENILAIAN
                                    |--------------------------------------------------------------------------
                                    */

                                    else {

                                        $item->status =
                                            'belum_dinilai';

                                        $item->label =
                                            'Menunggu penilaian';

                                        $item->can_edit =
                                            true;
                                    }
                                }


                                return $item;
                            }
                        );

                    return;
                }


                /*
                |--------------------------------------------------------------------------
                | MODE KELOMPOK
                |--------------------------------------------------------------------------
                */

                $assignment->group_items =
                    $assignment->groups
                        ->map(
                            function ($group) use ($assignment) {

                                /*
                                |--------------------------------------------------------------------------
                                | Submission kelompok
                                |--------------------------------------------------------------------------
                                */

                                $submission =
                                    $assignment
                                        ->submissions
                                        ->firstWhere(
                                            'assignment_group_id',
                                            $group->id
                                        );


                                /*
                                |--------------------------------------------------------------------------
                                | Data kelompok
                                |--------------------------------------------------------------------------
                                */

                                $item = new \stdClass();

                                $item->group =
                                    $group;

                                $item->members =
                                    $group->members;

                                $item->submission =
                                    $submission;

                                $item->status =
                                    'belum_mengumpulkan';

                                $item->label =
                                    'Belum mengumpulkan';

                                $item->nilai =
                                    null;

                                $item->catatan_guru =
                                    null;

                                $item->can_edit =
                                    false;


                                /*
                                |--------------------------------------------------------------------------
                                | SUDAH ADA SUBMISSION
                                |--------------------------------------------------------------------------
                                */

                                if ($submission) {

                                    /*
                                    |--------------------------------------------------------------------------
                                    | SUDAH DINILAI
                                    |--------------------------------------------------------------------------
                                    */

                                    if (
                                        $submission->status ===
                                        'selesai'
                                    ) {

                                        $item->status =
                                            'selesai';

                                        $item->label =
                                            'Sudah dinilai';

                                        $item->nilai =
                                            $submission->nilai;

                                        $item->catatan_guru =
                                            $submission->catatan_guru;

                                        $item->can_edit =
                                            false;
                                    }

                                    /*
                                    |--------------------------------------------------------------------------
                                    | MENUNGGU PENILAIAN
                                    |--------------------------------------------------------------------------
                                    */

                                    else {

                                        $item->status =
                                            'belum_dinilai';

                                        $item->label =
                                            'Menunggu penilaian';

                                        $item->can_edit =
                                            true;
                                    }
                                }


                                return $item;
                            }
                        );
            }
        );


        /*
        |--------------------------------------------------------------------------
        | DETAIL YANG DIPILIH
        |--------------------------------------------------------------------------
        */

        $selectedStudentId =
            $request->get(
                'student_id'
            );

        $selectedGroupId =
            $request->get(
                'group_id'
            );


        /*
        |--------------------------------------------------------------------------
        | SISWA TERPILIH
        |--------------------------------------------------------------------------
        */

        $selectedStudent = null;


        if ($selectedStudentId) {

            $selectedStudent =
                $students->firstWhere(
                    'id',
                    (int) $selectedStudentId
                );
        }


        /*
        |--------------------------------------------------------------------------
        | KELOMPOK TERPILIH
        |--------------------------------------------------------------------------
        */

        $selectedGroup = null;


        if (
            $selectedGroupId &&
            $assignments->isNotEmpty()
        ) {

            foreach (
                $assignments as $assignment
            ) {

                if (
                    isset(
                        $assignment->group_items
                    )
                ) {

                    foreach (
                        $assignment->group_items
                        as $groupItem
                    ) {

                        if (
                            (int) $groupItem->group->id ===
                            (int) $selectedGroupId
                        ) {

                            $selectedGroup =
                                $groupItem;

                            break 2;
                        }
                    }
                }
            }
        }


        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'assignments.index',
            compact(
                'classes',
                'kelas',
                'meetings',
                'pertemuan',
                'students',
                'assignments',
                'selectedStudentId',
                'selectedGroupId',
                'selectedStudent',
                'selectedGroup'
            )
        );
    }


    /**
     * ============================================================
     * KUMPULKAN / EDIT LINK
     * ============================================================
     *
     * Individu:
     * - satu submission untuk satu siswa.
     *
     * Kelompok:
     * - satu submission untuk satu kelompok.
     *
     * Selama belum selesai dinilai:
     * - link boleh diedit.
     *
     * Setelah selesai:
     * - link terkunci.
     */
    public function submit(
        Request $request,
        Assignment $assignment
    ): RedirectResponse {

        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'student_id' => [
                'required',
                'integer',
                'exists:students,id',
            ],

            'link' => [
                'required',
                'url',
                'max:2000',
            ],

            'catatan_siswa' => [
                'nullable',
                'string',
                'max:10000',
            ],

        ], [

            'student_id.required' =>
                'Siswa wajib dipilih.',

            'student_id.exists' =>
                'Siswa tidak ditemukan.',

            'link.required' =>
                'Link tugas wajib diisi.',

            'link.url' =>
                'Link tugas harus berupa URL yang valid.',

            'link.max' =>
                'Link tugas terlalu panjang.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | TUGAS AKTIF
        |--------------------------------------------------------------------------
        */

        if (!$assignment->aktif) {

            return back()
                ->withErrors([
                    'assignment' =>
                        'Tugas ini sudah tidak aktif.',
                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | SISWA AKTIF
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
        | PASTIKAN KELAS SESUAI
        |--------------------------------------------------------------------------
        */

        if (
            trim(
                (string) $student->kelas
            ) !==
            trim(
                (string) $assignment->kelas
            )
        ) {

            return back()
                ->withErrors([
                    'student_id' =>
                        'Siswa tidak berasal dari kelas tugas ini.',
                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | BATAS WAKTU
        |--------------------------------------------------------------------------
        */

        if (
            $assignment->batas_waktu &&
            now()->greaterThan(
                $assignment->batas_waktu
            )
        ) {

            return back()
                ->withErrors([
                    'link' =>
                        'Batas waktu pengumpulan tugas sudah berakhir.',
                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | INDIVIDU
        |--------------------------------------------------------------------------
        */

        if (
            $assignment->mode_pengumpulan ===
            'individu'
        ) {

            $submission =
                AssignmentSubmission::query()
                    ->where(
                        'assignment_id',
                        $assignment->id
                    )
                    ->where(
                        'student_id',
                        $student->id
                    )
                    ->whereNull(
                        'assignment_group_id'
                    )
                    ->first();


            /*
            |--------------------------------------------------------------------------
            | SUDAH DINILAI
            |--------------------------------------------------------------------------
            */

            if (
                $submission &&
                $submission->status ===
                'selesai'
            ) {

                return back()
                    ->withErrors([
                        'link' =>
                            'Tugas sudah dinilai dan link tidak dapat diedit lagi.',
                    ])
                    ->withInput();
            }


            /*
            |--------------------------------------------------------------------------
            | EDIT
            |--------------------------------------------------------------------------
            */

            if ($submission) {

                $submission->update([

                    'link' =>
                        $validated['link'],

                    'catatan_siswa' =>
                        $validated['catatan_siswa'] ?? null,

                    'status' =>
                        'belum_dinilai',

                    'nilai' =>
                        null,

                    'catatan_guru' =>
                        null,

                    'submitted_at' =>
                        now(),

                    'graded_at' =>
                        null,
                ]);

                $message =
                    'Link tugas berhasil diperbarui. Menunggu penilaian guru.';
            }

            /*
            |--------------------------------------------------------------------------
            | BARU
            |--------------------------------------------------------------------------
            */

            else {

                AssignmentSubmission::create([

                    'assignment_id' =>
                        $assignment->id,

                    'student_id' =>
                        $student->id,

                    'assignment_group_id' =>
                        null,

                    'link' =>
                        $validated['link'],

                    'catatan_siswa' =>
                        $validated['catatan_siswa'] ?? null,

                    'nilai' =>
                        null,

                    'catatan_guru' =>
                        null,

                    'status' =>
                        'belum_dinilai',

                    'submitted_at' =>
                        now(),

                    'graded_at' =>
                        null,
                ]);

                $message =
                    'Tugas berhasil dikumpulkan. Menunggu penilaian guru.';
            }


            return redirect()
                ->route(
                    'assignments.index',
                    [
                        'kelas' =>
                            $assignment->kelas,

                        'pertemuan' =>
                            $assignment->pertemuan,

                        'student_id' =>
                            $student->id,
                    ]
                )
                ->with(
                    'success',
                    $message
                );
        }


        /*
        |--------------------------------------------------------------------------
        | KELOMPOK
        |--------------------------------------------------------------------------
        */

        $group =
            AssignmentGroup::query()
                ->where(
                    'assignment_id',
                    $assignment->id
                )
                ->whereHas(
                    'members',
                    function ($query) use ($student) {

                        $query->where(
                            'student_id',
                            $student->id
                        );
                    }
                )
                ->first();


        /*
        |--------------------------------------------------------------------------
        | TIDAK ADA KELOMPOK
        |--------------------------------------------------------------------------
        */

        if (!$group) {

            return back()
                ->withErrors([
                    'link' =>
                        'Siswa belum terdaftar dalam kelompok tugas ini.',
                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | SUBMISSION KELOMPOK
        |--------------------------------------------------------------------------
        */

        $submission =
            AssignmentSubmission::query()
                ->where(
                    'assignment_id',
                    $assignment->id
                )
                ->where(
                    'assignment_group_id',
                    $group->id
                )
                ->first();


        /*
        |--------------------------------------------------------------------------
        | SUDAH DINILAI
        |--------------------------------------------------------------------------
        */

        if (
            $submission &&
            $submission->status ===
            'selesai'
        ) {

            return back()
                ->withErrors([
                    'link' =>
                        "Tugas Kelompok {$group->nomor_kelompok} sudah dinilai dan link tidak dapat diedit lagi.",
                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | EDIT SUBMISSION KELOMPOK
        |--------------------------------------------------------------------------
        */

        if ($submission) {

            $submission->update([

                'student_id' =>
                    $student->id,

                'link' =>
                    $validated['link'],

                'catatan_siswa' =>
                    $validated['catatan_siswa'] ?? null,

                'status' =>
                    'belum_dinilai',

                'nilai' =>
                    null,

                'catatan_guru' =>
                    null,

                'submitted_at' =>
                    now(),

                'graded_at' =>
                    null,
            ]);

            $message =
                "Link Kelompok {$group->nomor_kelompok} berhasil diperbarui. Menunggu penilaian guru.";
        }

        /*
        |--------------------------------------------------------------------------
        | SUBMISSION BARU
        |--------------------------------------------------------------------------
        */

        else {

            AssignmentSubmission::create([

                'assignment_id' =>
                    $assignment->id,

                'student_id' =>
                    $student->id,

                'assignment_group_id' =>
                    $group->id,

                'link' =>
                    $validated['link'],

                'catatan_siswa' =>
                    $validated['catatan_siswa'] ?? null,

                'nilai' =>
                    null,

                'catatan_guru' =>
                    null,

                'status' =>
                    'belum_dinilai',

                'submitted_at' =>
                    now(),

                'graded_at' =>
                    null,
            ]);

            $message =
                "Tugas Kelompok {$group->nomor_kelompok} berhasil dikumpulkan. Status pengumpulan berlaku untuk seluruh anggota.";
        }


        /*
        |--------------------------------------------------------------------------
        | KEMBALI
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'assignments.index',
                [
                    'kelas' =>
                        $assignment->kelas,

                    'pertemuan' =>
                        $assignment->pertemuan,

                    'group_id' =>
                        $group->id,

                    'student_id' =>
                        $student->id,
                ]
            )
            ->with(
                'success',
                $message
            );
    }
}