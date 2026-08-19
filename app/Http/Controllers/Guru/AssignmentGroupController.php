<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\AssignmentGroup;
use App\Models\AssignmentGroupMember;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssignmentGroupController extends Controller
{
    /**
     * Tambah kelompok baru pada sebuah tugas.
     */
    public function store(
        Request $request,
        Assignment $assignment
    ): RedirectResponse {

        /*
        |--------------------------------------------------------------------------
        | Pastikan tugas menggunakan mode kelompok
        |--------------------------------------------------------------------------
        */

        if (
            $assignment->mode_pengumpulan !== 'kelompok'
        ) {

            return back()
                ->withErrors([
                    'kelompok' =>
                        'Tugas ini menggunakan mode individu sehingga tidak memiliki kelompok.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Validasi
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'nomor_kelompok' => [
                'required',
                'integer',
                'min:1',
                'max:999',
            ],
        ], [

            'nomor_kelompok.required' =>
                'Nomor kelompok wajib diisi.',

            'nomor_kelompok.integer' =>
                'Nomor kelompok harus berupa angka.',

            'nomor_kelompok.min' =>
                'Nomor kelompok minimal adalah 1.',

            'nomor_kelompok.max' =>
                'Nomor kelompok maksimal adalah 999.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Cek duplikasi nomor kelompok
        |--------------------------------------------------------------------------
        */

        $exists = AssignmentGroup::query()
            ->where(
                'assignment_id',
                $assignment->id
            )
            ->where(
                'nomor_kelompok',
                $validated['nomor_kelompok']
            )
            ->exists();


        if ($exists) {

            return back()
                ->withInput()
                ->withErrors([
                    'nomor_kelompok' =>
                        "Kelompok {$validated['nomor_kelompok']} sudah tersedia.",
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Simpan kelompok
        |--------------------------------------------------------------------------
        */

        $group = AssignmentGroup::create([
            'assignment_id' =>
                $assignment->id,

            'kelas' =>
                $assignment->kelas,

            'nomor_kelompok' =>
                (int) $validated['nomor_kelompok'],
        ]);


        return back()
            ->with(
                'success',
                "Kelompok {$group->nomor_kelompok} berhasil ditambahkan."
            );
    }


    /**
     * Hapus kelompok.
     *
     * Semua anggota kelompok dan submission kelompok
     * ikut terhapus melalui cascade database.
     */
    public function destroy(
        Assignment $assignment,
        AssignmentGroup $group
    ): RedirectResponse {

        /*
        |--------------------------------------------------------------------------
        | Pastikan kelompok memang milik tugas tersebut
        |--------------------------------------------------------------------------
        */

        if (
            (int) $group->assignment_id !==
            (int) $assignment->id
        ) {

            abort(404);
        }


        /*
        |--------------------------------------------------------------------------
        | Jangan hapus kelompok jika sudah memiliki pengumpulan
        |--------------------------------------------------------------------------
        |
        | Ini mencegah data nilai/pengumpulan hilang secara tidak sengaja.
        |
        */

        if (
            $group
                ->submissions()
                ->exists()
        ) {

            return back()
                ->withErrors([
                    'kelompok' =>
                        'Kelompok tidak dapat dihapus karena sudah memiliki pengumpulan tugas.',
                ]);
        }


        $nomorKelompok =
            $group->nomor_kelompok;


        $group->delete();


        return back()
            ->with(
                'success',
                "Kelompok {$nomorKelompok} berhasil dihapus."
            );
    }


    /**
     * Tambahkan satu siswa ke kelompok.
     */
    public function addMember(
        Request $request,
        Assignment $assignment,
        AssignmentGroup $group
    ): RedirectResponse {

        /*
        |--------------------------------------------------------------------------
        | Pastikan kelompok milik tugas
        |--------------------------------------------------------------------------
        */

        if (
            (int) $group->assignment_id !==
            (int) $assignment->id
        ) {

            abort(404);
        }


        /*
        |--------------------------------------------------------------------------
        | Pastikan mode kelompok
        |--------------------------------------------------------------------------
        */

        if (
            $assignment->mode_pengumpulan !== 'kelompok'
        ) {

            return back()
                ->withErrors([
                    'anggota' =>
                        'Tugas ini bukan tugas kelompok.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Validasi siswa
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'student_id' => [
                'required',
                'integer',
                'exists:students,id',
            ],
        ], [

            'student_id.required' =>
                'Siswa wajib dipilih.',

            'student_id.exists' =>
                'Siswa tidak ditemukan.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Ambil siswa
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
                        'Siswa tidak aktif atau tidak ditemukan.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Siswa harus berasal dari kelas tugas
        |--------------------------------------------------------------------------
        */

        if (
            trim((string) $student->kelas) !==
            trim((string) $assignment->kelas)
        ) {

            return back()
                ->withErrors([
                    'student_id' =>
                        'Siswa harus berasal dari kelas yang dipilih untuk tugas ini.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Pastikan siswa belum berada dalam kelompok lain
        |--------------------------------------------------------------------------
        */

        $alreadyGrouped = AssignmentGroupMember::query()
            ->whereHas(
                'group',
                function ($query) use (
                    $assignment
                ) {

                    $query->where(
                        'assignment_id',
                        $assignment->id
                    );
                }
            )
            ->where(
                'student_id',
                $student->id
            )
            ->exists();


        if ($alreadyGrouped) {

            return back()
                ->withErrors([
                    'student_id' =>
                        "{$student->nama} sudah masuk ke kelompok lain pada tugas ini.",
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Tambahkan anggota
        |--------------------------------------------------------------------------
        */

        AssignmentGroupMember::create([
            'assignment_group_id' =>
                $group->id,

            'student_id' =>
                $student->id,
        ]);


        return back()
            ->with(
                'success',
                "{$student->nama} berhasil ditambahkan ke Kelompok {$group->nomor_kelompok}."
            );
    }


    /**
     * Hapus anggota dari kelompok.
     */
    public function removeMember(
        Assignment $assignment,
        AssignmentGroup $group,
        AssignmentGroupMember $member
    ): RedirectResponse {

        /*
        |--------------------------------------------------------------------------
        | Pastikan kelompok milik tugas
        |--------------------------------------------------------------------------
        */

        if (
            (int) $group->assignment_id !==
            (int) $assignment->id
        ) {

            abort(404);
        }


        /*
        |--------------------------------------------------------------------------
        | Pastikan anggota milik kelompok
        |--------------------------------------------------------------------------
        */

        if (
            (int) $member->assignment_group_id !==
            (int) $group->id
        ) {

            abort(404);
        }


        /*
        |--------------------------------------------------------------------------
        | Jangan menghapus anggota jika kelompok sudah mengumpulkan
        |--------------------------------------------------------------------------
        |
        | Ini menjaga agar anggota yang menerima nilai kelompok
        | tidak tiba-tiba berubah setelah pengumpulan.
        |
        */

        if (
            $group
                ->submissions()
                ->exists()
        ) {

            return back()
                ->withErrors([
                    'anggota' =>
                        'Anggota tidak dapat dihapus karena kelompok sudah mengumpulkan tugas.',
                ]);
        }


        $studentName =
            optional(
                $member->student
            )->nama
            ?? 'Siswa';


        $member->delete();


        return back()
            ->with(
                'success',
                "{$studentName} berhasil dikeluarkan dari kelompok."
            );
    }


    /**
     * Tambah beberapa anggota sekaligus.
     *
     * Berguna jika guru memilih beberapa siswa dari daftar.
     */
    public function addMembers(
        Request $request,
        Assignment $assignment,
        AssignmentGroup $group
    ): RedirectResponse {

        /*
        |--------------------------------------------------------------------------
        | Pastikan kelompok milik tugas
        |--------------------------------------------------------------------------
        */

        if (
            (int) $group->assignment_id !==
            (int) $assignment->id
        ) {

            abort(404);
        }


        /*
        |--------------------------------------------------------------------------
        | Pastikan mode kelompok
        |--------------------------------------------------------------------------
        */

        if (
            $assignment->mode_pengumpulan !== 'kelompok'
        ) {

            return back()
                ->withErrors([
                    'anggota' =>
                        'Tugas ini bukan tugas kelompok.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Validasi
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'student_ids' => [
                'required',
                'array',
                'min:1',
            ],

            'student_ids.*' => [
                'integer',
                'exists:students,id',
            ],
        ], [

            'student_ids.required' =>
                'Pilih minimal satu siswa.',

            'student_ids.array' =>
                'Data siswa tidak valid.',

            'student_ids.min' =>
                'Pilih minimal satu siswa.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Jangan mengubah kelompok yang sudah mengumpulkan
        |--------------------------------------------------------------------------
        */

        if (
            $group
                ->submissions()
                ->exists()
        ) {

            return back()
                ->withErrors([
                    'anggota' =>
                        'Anggota kelompok tidak dapat diubah karena sudah mengumpulkan tugas.',
                ]);
        }


        $added = [];
        $skipped = [];


        DB::transaction(
            function () use (
                $validated,
                $assignment,
                $group,
                &$added,
                &$skipped
            ) {

                foreach (
                    $validated['student_ids']
                    as $studentId
                ) {

                    /*
                    |--------------------------------------------------------------------------
                    | Ambil siswa aktif
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


                    if (!$student) {

                        $skipped[] =
                            "Siswa ID {$studentId} tidak aktif.";

                        continue;
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Cek kelas
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

                        $skipped[] =
                            "{$student->nama} bukan siswa {$assignment->kelas}.";

                        continue;
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Cek sudah masuk kelompok lain
                    |--------------------------------------------------------------------------
                    */

                    $alreadyGrouped =
                        AssignmentGroupMember::query()
                            ->whereHas(
                                'group',
                                function ($query) use (
                                    $assignment
                                ) {

                                    $query->where(
                                        'assignment_id',
                                        $assignment->id
                                    );
                                }
                            )
                            ->where(
                                'student_id',
                                $student->id
                            )
                            ->exists();


                    if ($alreadyGrouped) {

                        $skipped[] =
                            "{$student->nama} sudah berada di kelompok lain.";

                        continue;
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Masukkan ke kelompok
                    |--------------------------------------------------------------------------
                    */

                    AssignmentGroupMember::create([
                        'assignment_group_id' =>
                            $group->id,

                        'student_id' =>
                            $student->id,
                    ]);


                    $added[] =
                        $student->nama;
                }
            }
        );


        /*
        |--------------------------------------------------------------------------
        | Pesan hasil
        |--------------------------------------------------------------------------
        */

        if (
            count($added) > 0
        ) {

            $message =
                count($added) .
                ' anggota berhasil ditambahkan.';

            if (
                count($skipped) > 0
            ) {

                $message .=
                    ' ' .
                    count($skipped) .
                    ' siswa dilewati.';
            }

            return back()
                ->with(
                    'success',
                    $message
                );
        }


        return back()
            ->withErrors([
                'anggota' =>
                    'Tidak ada siswa yang berhasil ditambahkan.',
            ]);
    }
}