<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Models\VideoMeetingAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VideoMeetingAdminController extends Controller
{
    /**
     * Tambah pertemuan Video.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pertemuan' => [
                'required',
                'integer',
                'min:1',
                'max:255',
                'unique:video_meetings,pertemuan',
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
        | TAMBAH PERTEMUAN
        |--------------------------------------------------------------------------
        |
        | Pertemuan baru otomatis AKTIF.
        |
        */

        $meeting = VideoMeetingAdmin::create([
            'pertemuan' => $validated['pertemuan'],
            'aktif' => true,
        ]);


        return redirect()
            ->route('guru.videos.index', [
                'pertemuan' => $meeting->pertemuan,
            ])
            ->with(
                'success',
                "Pertemuan {$meeting->pertemuan} berhasil ditambahkan."
            );
    }


    /**
     * Aktif / Nonaktifkan satu pertemuan Video.
     *
     * Status ini berlaku untuk seluruh video
     * pada pertemuan tersebut.
     *
     * Jika NONAKTIF:
     * - Pertemuan tidak ditampilkan kepada siswa.
     * - Video tetap tersimpan.
     * - Data video tidak dihapus.
     */
    public function toggle(
        VideoMeetingAdmin $videoMeetingAdmin
    ) {
        $videoMeetingAdmin->update([
            'aktif' => ! $videoMeetingAdmin->aktif,
        ]);


        $status = $videoMeetingAdmin->aktif
            ? 'diaktifkan'
            : 'dinonaktifkan';


        return redirect()
            ->route('guru.videos.index', [
                'pertemuan' =>
                    $videoMeetingAdmin->pertemuan,
            ])
            ->with(
                'success',
                "Pertemuan {$videoMeetingAdmin->pertemuan} berhasil {$status}."
            );
    }


    /**
     * Hapus SATU pertemuan Video.
     *
     * Hanya:
     * - meeting yang dipilih
     * - Video pada pertemuan tersebut
     *
     * Pertemuan Video lainnya tidak disentuh.
     *
     * Material tidak disentuh.
     * Quiz tidak disentuh.
     * Refleksi tidak disentuh.
     */
    public function destroy(
        VideoMeetingAdmin $videoMeetingAdmin
    ) {
        $pertemuan =
            (int) $videoMeetingAdmin->pertemuan;


        DB::transaction(function () use (
            $videoMeetingAdmin,
            $pertemuan
        ) {

            /*
            |--------------------------------------------------------------------------
            | HAPUS VIDEO PADA PERTEMUAN INI SAJA
            |--------------------------------------------------------------------------
            */

            Video::query()
                ->where(
                    'pertemuan',
                    $pertemuan
                )
                ->delete();


            /*
            |--------------------------------------------------------------------------
            | HAPUS SATU PERTEMUAN VIDEO YANG DIPILIH
            |--------------------------------------------------------------------------
            */

            VideoMeetingAdmin::query()
                ->whereKey(
                    $videoMeetingAdmin->getKey()
                )
                ->delete();
        });


        return redirect()
            ->route('guru.videos.index')
            ->with(
                'success',
                "Pertemuan {$pertemuan} dan seluruh Video-nya berhasil dihapus."
            );
    }
}