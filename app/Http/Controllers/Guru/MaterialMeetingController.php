<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\MaterialMeeting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MaterialMeetingController extends Controller
{
    /**
     * Menyimpan pertemuan materi baru.
     */
    public function store(
        Request $request
    ): RedirectResponse {

        $validated = $request->validate([
            'pertemuan' => [
                'required',
                'integer',
                'min:1',
                'max:255',
            ],
        ], [
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
        | Cegah Pertemuan Duplikat
        |--------------------------------------------------------------------------
        */

        $exists = MaterialMeeting::query()
            ->where(
                'pertemuan',
                $validated['pertemuan']
            )
            ->exists();


        if ($exists) {

            return back()
                ->withInput()
                ->withErrors([
                    'pertemuan' =>
                        "Pertemuan {$validated['pertemuan']} sudah tersedia.",
                ]);

        }


        /*
        |--------------------------------------------------------------------------
        | Simpan Pertemuan
        |--------------------------------------------------------------------------
        */

        MaterialMeeting::create([
            'pertemuan' =>
                $validated['pertemuan'],

            'aktif' =>
                true,
        ]);


        /*
        |--------------------------------------------------------------------------
        | Kembali ke Create Material
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'guru.materials.create'
            )
            ->with(
                'success',
                "Pertemuan {$validated['pertemuan']} berhasil dibuat."
            );
    }


    /**
     * Aktifkan / nonaktifkan pertemuan.
     */
    public function toggle(
        MaterialMeeting $materialMeeting
    ): RedirectResponse {

        $materialMeeting->update([
            'aktif' =>
                !$materialMeeting->aktif,
        ]);


        $status =
            $materialMeeting->aktif
                ? 'diaktifkan'
                : 'dinonaktifkan';


        return back()
            ->with(
                'success',
                "Pertemuan {$materialMeeting->pertemuan} berhasil {$status}."
            );
    }


    /**
     * Hapus pertemuan.
     *
     * Pertemuan yang sudah memiliki materi
     * tidak boleh dihapus.
     */
    public function destroy(
        MaterialMeeting $materialMeeting
    ): RedirectResponse {

        $hasMaterials =
            $materialMeeting
                ->materials()
                ->exists();


        if ($hasMaterials) {

            return back()
                ->with(
                    'error',
                    "Pertemuan {$materialMeeting->pertemuan} tidak dapat dihapus karena sudah memiliki materi."
                );

        }


        $pertemuan =
            $materialMeeting->pertemuan;


        $materialMeeting->delete();


        return back()
            ->with(
                'success',
                "Pertemuan {$pertemuan} berhasil dihapus."
            );
    }
}