<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\AssignmentMeeting;
use App\Models\ClassRoom;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AssignmentMeetingController extends Controller
{
    /**
     * Daftar pertemuan tugas berdasarkan kelas.
     */
    public function index(Request $request): View
    {
        $kelas = trim(
            (string) $request->get('kelas', '')
        );

        $classes = ClassRoom::query()
            ->where('aktif', true)
            ->orderBy('nama')
            ->get();

        $meetings = AssignmentMeeting::query()
            ->withCount('assignments')
            ->when(
                $kelas !== '',
                function ($query) use ($kelas) {
                    $query->where(
                        'kelas',
                        $kelas
                    );
                }
            )
            ->orderBy('kelas')
            ->orderBy('pertemuan')
            ->get();

        return view(
            'guru.assignments.meetings.index',
            compact(
                'classes',
                'meetings',
                'kelas'
            )
        );
    }


    /**
     * Simpan pertemuan baru.
     *
     * Guru menentukan sendiri nomor pertemuan.
     * Contoh:
     * 4 → Pertemuan 4
     * 5 → Pertemuan 5
     * 8 → Pertemuan 8
     */
    public function store(
        Request $request
    ): RedirectResponse {

        $validated = $request->validate([
            'kelas' => [
                'required',
                'string',
                'max:50',
            ],

            'pertemuan' => [
                'required',
                'integer',
                'min:1',
                'max:255',
            ],
        ], [
            'kelas.required' =>
                'Kelas wajib dipilih.',

            'pertemuan.required' =>
                'Nomor pertemuan wajib diisi.',

            'pertemuan.integer' =>
                'Nomor pertemuan harus berupa angka.',

            'pertemuan.min' =>
                'Nomor pertemuan minimal adalah 1.',

            'pertemuan.max' =>
                'Nomor pertemuan maksimal adalah 255.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Pastikan kelas tersedia dan aktif
        |--------------------------------------------------------------------------
        */

        $classExists = ClassRoom::query()
            ->where(
                'nama',
                $validated['kelas']
            )
            ->where(
                'aktif',
                true
            )
            ->exists();


        if (!$classExists) {

            return back()
                ->withInput()
                ->withErrors([
                    'kelas' =>
                        'Kelas tidak ditemukan atau sedang tidak aktif.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Cegah pertemuan ganda dalam kelas yang sama
        |--------------------------------------------------------------------------
        */

        $alreadyExists = AssignmentMeeting::query()
            ->where(
                'kelas',
                $validated['kelas']
            )
            ->where(
                'pertemuan',
                $validated['pertemuan']
            )
            ->exists();


        if ($alreadyExists) {

            return back()
                ->withInput()
                ->withErrors([
                    'pertemuan' =>
                        "Pertemuan {$validated['pertemuan']} sudah tersedia untuk kelas {$validated['kelas']}.",
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Buat pertemuan
        |--------------------------------------------------------------------------
        */

        $meeting = AssignmentMeeting::create([
            'kelas' =>
                $validated['kelas'],

            'pertemuan' =>
                $validated['pertemuan'],

            'aktif' =>
                true,
        ]);


        return redirect()
            ->route(
                'guru.assignments.meetings.index',
                [
                    'kelas' =>
                        $meeting->kelas,
                ]
            )
            ->with(
                'success',
                "Pertemuan {$meeting->pertemuan} berhasil ditambahkan untuk kelas {$meeting->kelas}."
            );
    }


    /**
     * Aktifkan / nonaktifkan pertemuan.
     */
    public function toggle(
        AssignmentMeeting $assignmentMeeting
    ): RedirectResponse {

        $assignmentMeeting->update([
            'aktif' =>
                !$assignmentMeeting->aktif,
        ]);


        $status = $assignmentMeeting->aktif
            ? 'diaktifkan'
            : 'dinonaktifkan';


        return back()
            ->with(
                'success',
                "Pertemuan {$assignmentMeeting->pertemuan} berhasil {$status}."
            );
    }


    /**
     * Hapus pertemuan.
     *
     * Pertemuan yang sudah memiliki tugas tidak boleh
     * dihapus agar relasi tugas tetap aman.
     */
    public function destroy(
        AssignmentMeeting $assignmentMeeting
    ): RedirectResponse {

        $hasAssignments = Assignment::query()
            ->where(
                'assignment_meeting_id',
                $assignmentMeeting->id
            )
            ->exists();


        if ($hasAssignments) {

            return back()
                ->with(
                    'error',
                    "Pertemuan {$assignmentMeeting->pertemuan} tidak dapat dihapus karena sudah memiliki tugas."
                );
        }


        $kelas =
            $assignmentMeeting->kelas;


        $pertemuan =
            $assignmentMeeting->pertemuan;


        $assignmentMeeting->delete();


        return redirect()
            ->route(
                'guru.assignments.meetings.index',
                [
                    'kelas' => $kelas,
                ]
            )
            ->with(
                'success',
                "Pertemuan {$pertemuan} berhasil dihapus."
            );
    }
}