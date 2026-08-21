<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\VideoMeetingAdmin;
use Illuminate\Http\Request;

class VideoControllerSiswa extends Controller
{
    /**
     * Menampilkan Video untuk siswa.
     *
     * Video bersifat umum.
     *
     * Tidak menggunakan:
     * - kelas
     * - nama siswa
     * - nomor absen
     *
     * Pertemuan mengikuti data yang dibuat guru
     * pada tabel video_meetings.
     */
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | DAFTAR PERTEMUAN VIDEO
        |--------------------------------------------------------------------------
        |
        | Hanya pertemuan yang AKTIF yang ditampilkan kepada siswa.
        |
        */

        $meetings = VideoMeetingAdmin::query()
            ->where('aktif', true)
            ->orderBy('pertemuan')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | PERTEMUAN YANG DIPILIH
        |--------------------------------------------------------------------------
        |
        | Jika tidak ada parameter pertemuan,
        | gunakan pertemuan aktif pertama.
        |
        */

        $pertemuan = (int) $request->get(
            'pertemuan',
            $meetings->first()?->pertemuan ?? 1
        );


        /*
        |--------------------------------------------------------------------------
        | PASTIKAN PERTEMUAN TERSEDIA
        |--------------------------------------------------------------------------
        |
        | Jika siswa membuka nomor pertemuan yang tidak tersedia
        | atau tidak aktif, arahkan ke pertemuan aktif pertama.
        |
        */

        if (
            $meetings->isNotEmpty()
            &&
            !$meetings->contains(
                'pertemuan',
                $pertemuan
            )
        ) {

            $pertemuan =
                (int) $meetings->first()->pertemuan;
        }


        /*
        |--------------------------------------------------------------------------
        | VIDEO PADA PERTEMUAN TERPILIH
        |--------------------------------------------------------------------------
        */

        $videos = Video::query()
            ->where(
                'pertemuan',
                $pertemuan
            )
            ->orderBy('urutan')
            ->orderBy('id')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | TAMPILKAN HALAMAN SISWA
        |--------------------------------------------------------------------------
        */

        return view(
            'videos.index',
            compact(
                'videos',
                'pertemuan',
                'meetings'
            )
        );
    }
}