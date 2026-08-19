<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Models\VideoMeetingAdmin;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Daftar video berdasarkan pertemuan.
     */
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | AMBIL DAFTAR PERTEMUAN VIDEO
        |--------------------------------------------------------------------------
        */

        $meetings = VideoMeetingAdmin::query()
            ->orderBy('pertemuan')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | PERTEMUAN AKTIF
        |--------------------------------------------------------------------------
        */

        $pertemuan = (int) $request->get(
            'pertemuan',
            $meetings->first()?->pertemuan ?? 1
        );


        /*
        |--------------------------------------------------------------------------
        | JIKA PERTEMUAN TIDAK TERSEDIA
        |--------------------------------------------------------------------------
        */

        if (
            $meetings->isNotEmpty() &&
            !$meetings->contains('pertemuan', $pertemuan)
        ) {
            $pertemuan = $meetings->first()->pertemuan;
        }


        /*
        |--------------------------------------------------------------------------
        | VIDEO PADA PERTEMUAN TERPILIH
        |--------------------------------------------------------------------------
        */

        $videos = Video::query()
            ->where('pertemuan', $pertemuan)
            ->orderBy('urutan')
            ->orderBy('id')
            ->get();


        return view(
            'guru.videos.index',
            compact(
                'videos',
                'pertemuan',
                'meetings'
            )
        );
    }


    /**
     * Form tambah video.
     */
    public function create(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | AMBIL DAFTAR PERTEMUAN VIDEO
        |--------------------------------------------------------------------------
        */

        $meetings = VideoMeetingAdmin::query()
            ->orderBy('pertemuan')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | PERTEMUAN AKTIF
        |--------------------------------------------------------------------------
        */

        $pertemuan = (int) $request->get(
            'pertemuan',
            $meetings->first()?->pertemuan ?? 1
        );


        /*
        |--------------------------------------------------------------------------
        | PASTIKAN PERTEMUAN TERSEDIA
        |--------------------------------------------------------------------------
        */

        if (
            $meetings->isNotEmpty() &&
            !$meetings->contains('pertemuan', $pertemuan)
        ) {
            $pertemuan = $meetings->first()->pertemuan;
        }


        return view(
            'guru.videos.create',
            compact(
                'pertemuan',
                'meetings'
            )
        );
    }


    /**
     * Simpan video baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pertemuan' => [
                'required',
                'integer',
                'min:1',
                'max:255',
                'exists:video_meetings,pertemuan',
            ],

            'judul' => [
                'required',
                'string',
                'max:255',
            ],

            'youtube_url' => [
                'required',
                'url',
                'max:2000',
            ],

            'deskripsi' => [
                'nullable',
                'string',
                'max:5000',
            ],
        ], [
            'pertemuan.exists' =>
                'Pertemuan Video tersebut belum tersedia.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | MAKSIMAL 10 VIDEO PER PERTEMUAN
        |--------------------------------------------------------------------------
        */

        $jumlahVideo = Video::query()
            ->where(
                'pertemuan',
                $validated['pertemuan']
            )
            ->count();


        if ($jumlahVideo >= 10) {

            return back()
                ->withInput()
                ->withErrors([
                    'youtube_url' =>
                        'Maksimal 10 video untuk setiap pertemuan.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | TENTUKAN URUTAN OTOMATIS
        |--------------------------------------------------------------------------
        */

        $urutan = $jumlahVideo + 1;


        /*
        |--------------------------------------------------------------------------
        | SIMPAN VIDEO
        |--------------------------------------------------------------------------
        */

        Video::create([
            'pertemuan' =>
                $validated['pertemuan'],

            'judul' =>
                $validated['judul'],

            'youtube_url' =>
                $validated['youtube_url'],

            'deskripsi' =>
                $validated['deskripsi'] ?? null,

            'urutan' =>
                $urutan,
        ]);


        return redirect()
            ->route(
                'guru.videos.index',
                [
                    'pertemuan' =>
                        $validated['pertemuan'],
                ]
            )
            ->with(
                'success',
                'Video berhasil ditambahkan.'
            );
    }


    /**
     * Form edit video.
     */
    public function edit(Video $video)
    {
        /*
        |--------------------------------------------------------------------------
        | DAFTAR PERTEMUAN VIDEO
        |--------------------------------------------------------------------------
        */

        $meetings = VideoMeetingAdmin::query()
            ->orderBy('pertemuan')
            ->get();


        return view(
            'guru.videos.edit',
            compact(
                'video',
                'meetings'
            )
        );
    }


    /**
     * Update video.
     */
    public function update(
        Request $request,
        Video $video
    ) {
        $validated = $request->validate([
            'pertemuan' => [
                'required',
                'integer',
                'min:1',
                'max:255',
                'exists:video_meetings,pertemuan',
            ],

            'judul' => [
                'required',
                'string',
                'max:255',
            ],

            'youtube_url' => [
                'required',
                'url',
                'max:2000',
            ],

            'deskripsi' => [
                'nullable',
                'string',
                'max:5000',
            ],
        ], [
            'pertemuan.exists' =>
                'Pertemuan Video tersebut belum tersedia.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | JIKA PINDAH PERTEMUAN
        |--------------------------------------------------------------------------
        */

        if (
            (int) $video->pertemuan !==
            (int) $validated['pertemuan']
        ) {

            $jumlahVideo = Video::query()
                ->where(
                    'pertemuan',
                    $validated['pertemuan']
                )
                ->where(
                    'id',
                    '!=',
                    $video->id
                )
                ->count();


            if ($jumlahVideo >= 10) {

                return back()
                    ->withInput()
                    ->withErrors([
                        'pertemuan' =>
                            'Pertemuan tujuan sudah memiliki maksimal 10 video.',
                    ]);
            }


            $validated['urutan'] =
                $jumlahVideo + 1;
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE
        |--------------------------------------------------------------------------
        */

        $video->update($validated);


        return redirect()
            ->route(
                'guru.videos.index',
                [
                    'pertemuan' =>
                        $video->pertemuan,
                ]
            )
            ->with(
                'success',
                'Video berhasil diperbarui.'
            );
    }


    /**
     * Hapus video.
     */
    public function destroy(Video $video)
    {
        $pertemuan =
            $video->pertemuan;


        /*
        |--------------------------------------------------------------------------
        | HAPUS VIDEO
        |--------------------------------------------------------------------------
        */

        $video->delete();


        /*
        |--------------------------------------------------------------------------
        | RAPIKAN URUTAN VIDEO
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


        foreach ($videos as $index => $item) {

            $item->update([
                'urutan' =>
                    $index + 1,
            ]);
        }


        return redirect()
            ->route(
                'guru.videos.index',
                [
                    'pertemuan' =>
                        $pertemuan,
                ]
            )
            ->with(
                'success',
                'Video berhasil dihapus.'
            );
    }
}