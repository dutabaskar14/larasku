<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\AssignmentGroup;
use App\Models\AssignmentSubmission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AssignmentSubmissionController extends Controller
{
    /**
     * Daftar seluruh pengumpulan untuk satu tugas.
     */
    public function index(
        Assignment $assignment
    ): View {

        $assignment->load([
            'groups.members.student',
            'submissions.student',
            'submissions.group.members.student',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Pengumpulan
        |--------------------------------------------------------------------------
        */

        $submissions = $assignment
            ->submissions()
            ->with([
                'student',
                'group.members.student',
            ])
            ->orderByDesc('submitted_at')
            ->orderByDesc('id')
            ->get();


        return view(
            'guru.assignments.submissions',
            compact(
                'assignment',
                'submissions'
            )
        );
    }


    /**
     * Detail satu pengumpulan.
     */
    public function show(
        Assignment $assignment,
        AssignmentSubmission $submission
    ): View {

        /*
        |--------------------------------------------------------------------------
        | Pastikan submission milik tugas
        |--------------------------------------------------------------------------
        */

        if (
            (int) $submission->assignment_id !==
            (int) $assignment->id
        ) {

            abort(404);
        }


        $submission->load([
            'student',
            'group.members.student',
            'assignment',
        ]);


        return view(
            'guru.assignments.submission-show',
            compact(
                'assignment',
                'submission'
            )
        );
    }


    /**
     * Simpan nilai dan catatan guru.
     *
     * Belum menyelesaikan penilaian.
     */
    public function grade(
        Request $request,
        Assignment $assignment,
        AssignmentSubmission $submission
    ): RedirectResponse {

        /*
        |--------------------------------------------------------------------------
        | Pastikan submission milik tugas
        |--------------------------------------------------------------------------
        */

        if (
            (int) $submission->assignment_id !==
            (int) $assignment->id
        ) {

            abort(404);
        }


        /*
        |--------------------------------------------------------------------------
        | Validasi
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'nilai' => [
                'required',
                'numeric',
                'min:0',
                'max:100',
            ],

            'catatan_guru' => [
                'nullable',
                'string',
                'max:10000',
            ],

        ], [

            'nilai.required' =>
                'Nilai wajib diisi.',

            'nilai.numeric' =>
                'Nilai harus berupa angka.',

            'nilai.min' =>
                'Nilai minimal adalah 0.',

            'nilai.max' =>
                'Nilai maksimal adalah 100.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Simpan nilai sementara
        |--------------------------------------------------------------------------
        */

        $submission->update([

            'nilai' =>
                $validated['nilai'],

            'catatan_guru' =>
                $validated['catatan_guru'] ?? null,
        ]);


        return back()
            ->with(
                'success',
                'Nilai berhasil disimpan. Klik "Selesaikan Penilaian" untuk mengunci penilaian.'
            );
    }


    /**
     * Selesaikan penilaian.
     *
     * Untuk individu:
     * nilai hanya berlaku untuk siswa tersebut.
     *
     * Untuk kelompok:
     * nilai otomatis berlaku kepada seluruh anggota kelompok.
     */
    public function complete(
        Assignment $assignment,
        AssignmentSubmission $submission
    ): RedirectResponse {

        /*
        |--------------------------------------------------------------------------
        | Pastikan submission milik tugas
        |--------------------------------------------------------------------------
        */

        if (
            (int) $submission->assignment_id !==
            (int) $assignment->id
        ) {

            abort(404);
        }


        /*
        |--------------------------------------------------------------------------
        | Nilai wajib tersedia
        |--------------------------------------------------------------------------
        */

        if (
            $submission->nilai === null
        ) {

            return back()
                ->withErrors([
                    'nilai' =>
                        'Masukkan nilai terlebih dahulu sebelum menyelesaikan penilaian.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Pastikan sudah mengumpulkan
        |--------------------------------------------------------------------------
        */

        if (
            !$submission->submitted_at
        ) {

            return back()
                ->withErrors([
                    'submission' =>
                        'Pengumpulan belum memiliki waktu pengiriman.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Transaksi penilaian
        |--------------------------------------------------------------------------
        */

        DB::transaction(
            function () use (
                $assignment,
                $submission
            ) {

                /*
                |--------------------------------------------------------------------------
                | Tugas individu
                |--------------------------------------------------------------------------
                */

                if (
                    $assignment->mode_pengumpulan ===
                    'individu'
                ) {

                    $submission->update([

                        'status' =>
                            'selesai',

                        'graded_at' =>
                            now(),
                    ]);

                    return;
                }


                /*
                |--------------------------------------------------------------------------
                | Tugas kelompok
                |--------------------------------------------------------------------------
                */

                if (
                    !$submission->assignment_group_id
                ) {

                    return;
                }


                $group = AssignmentGroup::query()
                    ->with([
                        'members.student',
                    ])
                    ->find(
                        $submission->assignment_group_id
                    );


                if (!$group) {

                    return;
                }


                /*
                |--------------------------------------------------------------------------
                | Selesaikan submission kelompok
                |--------------------------------------------------------------------------
                */

                $submission->update([

                    'status' =>
                        'selesai',

                    'graded_at' =>
                        now(),
                ]);


                /*
                |--------------------------------------------------------------------------
                | Nilai kelompok akan dibaca dari submission
                | kelompok tersebut oleh sistem ranking.
                |--------------------------------------------------------------------------
                |
                | Tidak perlu membuat submission baru untuk setiap anggota.
                |
                | Satu submission kelompok = satu nilai kelompok.
                |
                */
            }
        );


        return back()
            ->with(
                'success',
                'Penilaian berhasil diselesaikan.'
            );
    }


    /**
     * Hapus pengumpulan.
     *
     * Hanya dapat dilakukan jika belum selesai dinilai.
     */
    public function destroy(
        Assignment $assignment,
        AssignmentSubmission $submission
    ): RedirectResponse {

        /*
        |--------------------------------------------------------------------------
        | Pastikan submission milik tugas
        |--------------------------------------------------------------------------
        */

        if (
            (int) $submission->assignment_id !==
            (int) $assignment->id
        ) {

            abort(404);
        }


        /*
        |--------------------------------------------------------------------------
        | Jangan hapus penilaian yang sudah selesai
        |--------------------------------------------------------------------------
        */

        if (
            $submission->status ===
            'selesai'
        ) {

            return back()
                ->withErrors([
                    'submission' =>
                        'Pengumpulan yang sudah selesai dinilai tidak dapat dihapus.',
                ]);
        }


        $submission->delete();


        return back()
            ->with(
                'success',
                'Pengumpulan berhasil dihapus.'
            );
    }


    /**
     * Ringkasan status pengumpulan.
     */
    public function summary(
        Assignment $assignment
    ): array {

        $totalStudents = \App\Models\Student::query()
            ->where(
                'kelas',
                $assignment->kelas
            )
            ->where(
                'aktif',
                true
            )
            ->count();


        $totalSubmissions = $assignment
            ->submissions()
            ->count();


        $completed = $assignment
            ->submissions()
            ->where(
                'status',
                'selesai'
            )
            ->count();


        $pending = $assignment
            ->submissions()
            ->where(
                'status',
                'belum_dinilai'
            )
            ->count();


        return [
            'total_students' =>
                $totalStudents,

            'total_submissions' =>
                $totalSubmissions,

            'completed' =>
                $completed,

            'pending' =>
                $pending,
        ];
    }
}