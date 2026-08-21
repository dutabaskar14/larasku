<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\MaterialMeeting;
use Illuminate\Http\Request;

class MaterialControllerSiswa extends Controller
{
    /**
     * Menampilkan materi pembelajaran untuk siswa.
     *
     * Material bersifat umum.
     *
     * Tidak menggunakan:
     * - kelas
     * - nama siswa
     * - nomor absen
     *
     * Pertemuan mengikuti material_meetings
     * yang dibuat oleh Guru.
     */
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | DAFTAR PERTEMUAN AKTIF
        |--------------------------------------------------------------------------
        */

        $meetings = MaterialMeeting::query()
            ->where('aktif', true)
            ->orderBy('pertemuan')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | PERTEMUAN TERPILIH
        |--------------------------------------------------------------------------
        |
        | Jika URL tidak membawa ?pertemuan=...
        | gunakan pertemuan aktif pertama.
        |
        */

        $pertemuanInput = $request->get('pertemuan');

        $pertemuan = null;

        if ($pertemuanInput !== null && $pertemuanInput !== '') {

            $pertemuanInput = (int) $pertemuanInput;

            if (
                $meetings->contains(
                    'pertemuan',
                    $pertemuanInput
                )
            ) {

                $pertemuan = $pertemuanInput;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | DEFAULT PERTEMUAN
        |--------------------------------------------------------------------------
        */

        if ($pertemuan === null && $meetings->isNotEmpty()) {

            $pertemuan =
                (int) $meetings->first()->pertemuan;
        }


        /*
        |--------------------------------------------------------------------------
        | MATERI
        |--------------------------------------------------------------------------
        |
        | Hanya materi aktif pada pertemuan terpilih.
        |
        */

        $materials = collect();

        if ($pertemuan !== null) {

            $materials = Material::query()
                ->where(
                    'pertemuan',
                    $pertemuan
                )
                ->where(
                    'aktif',
                    true
                )
                ->orderBy('id')
                ->get();
        }


        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'materials.index',
            compact(
                'materials',
                'pertemuan',
                'meetings'
            )
        );
    }


    /**
     * Menampilkan detail satu materi.
     *
     * Hanya materi aktif yang dapat dibuka siswa.
     */
    public function show(
        Material $material
    ) {

        if (!$material->aktif) {

            abort(404);
        }


        /*
        |--------------------------------------------------------------------------
        | Pastikan pertemuan masih aktif
        |--------------------------------------------------------------------------
        */

        $meetingExists =
            MaterialMeeting::query()
                ->where(
                    'pertemuan',
                    $material->pertemuan
                )
                ->where(
                    'aktif',
                    true
                )
                ->exists();


        if (!$meetingExists) {

            abort(404);
        }


        return view(
            'materials.show',
            compact(
                'material'
            )
        );
    }
}