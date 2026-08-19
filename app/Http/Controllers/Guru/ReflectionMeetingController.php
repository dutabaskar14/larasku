<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Reflection;
use App\Models\ReflectionMeeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReflectionMeetingController extends Controller
{
    /**
     * ============================================================
     * TAMBAH PERTEMUAN REFLEKSI
     * ============================================================
     *
     * Pertemuan Refleksi berdiri sendiri.
     * Tidak bergantung pada Material.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pertemuan' => [
                'required',
                'integer',
                'min:1',
                'max:255',
                'unique:reflection_meetings,pertemuan',
            ],
        ], [
            'pertemuan.required' =>
                'Nomor pertemuan wajib diisi.',

            'pertemuan.integer' =>
                'Nomor pertemuan harus berupa angka.',

            'pertemuan.min' =>
                'Nomor pertemuan minimal adalah 1.',

            'pertemuan.unique' =>
                'Pertemuan tersebut sudah tersedia.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | SIMPAN PERTEMUAN
        |--------------------------------------------------------------------------
        */

        $meeting = ReflectionMeeting::create([
            'pertemuan' => $validated['pertemuan'],
        ]);


        return redirect()
            ->route('guru.reflections.create', [
                'pertemuan' => $meeting->pertemuan,
            ])
            ->with(
                'success',
                "Pertemuan {$meeting->pertemuan} berhasil ditambahkan."
            );
    }


    /**
     * ============================================================
     * HAPUS PERTEMUAN REFLEKSI
     * ============================================================
     *
     * Menghapus hanya SATU pertemuan yang dipilih.
     *
     * Pertemuan
     *     ↓
     * Reflection
     *     ↓
     * ReflectionQuestion
     *     ↓
     * ReflectionAnswer
     *
     * Data Material tidak disentuh.
     *
     * Pertemuan lain juga tidak disentuh.
     */
    public function destroy(
        ReflectionMeeting $reflectionMeeting
    ) {
        /*
        |--------------------------------------------------------------------------
        | SIMPAN NOMOR PERTEMUAN SEBELUM DIHAPUS
        |--------------------------------------------------------------------------
        */

        $pertemuan = $reflectionMeeting->pertemuan;


        /*
        |--------------------------------------------------------------------------
        | HAPUS DALAM TRANSACTION
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use (
            $reflectionMeeting,
            $pertemuan
        ) {

            /*
            |--------------------------------------------------------------------------
            | AMBIL REFLEKSI PADA PERTEMUAN INI SAJA
            |--------------------------------------------------------------------------
            */

            $reflections = Reflection::query()
                ->where(
                    'pertemuan',
                    $pertemuan
                )
                ->get();


            /*
            |--------------------------------------------------------------------------
            | HAPUS REFLEKSI
            |--------------------------------------------------------------------------
            |
            | ReflectionQuestion dan ReflectionAnswer
            | akan ikut terhapus melalui cascadeOnDelete().
            |
            */

            foreach ($reflections as $reflection) {

                $reflection->delete();

            }


            /*
            |--------------------------------------------------------------------------
            | HAPUS SATU RECORD PERTEMUAN YANG DIKLIK
            |--------------------------------------------------------------------------
            */

            $reflectionMeeting->delete();
        });


        /*
        |--------------------------------------------------------------------------
        | KEMBALI KE INDEX
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('guru.reflections.index')
            ->with(
                'success',
                "Pertemuan {$pertemuan} dan seluruh data refleksinya berhasil dihapus."
            );
    }
}