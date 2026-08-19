<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Daftar video berdasarkan pertemuan.
     */
    public function index(Request $request)
    {
        $pertemuan = (int) $request->get('pertemuan', 1);

        if ($pertemuan < 1 || $pertemuan > 8) {
            $pertemuan = 1;
        }

        $videos = Video::where('pertemuan', $pertemuan)
            ->orderBy('urutan')
            ->orderBy('id')
            ->get();

        return view('guru.videos.index', compact(
            'videos',
            'pertemuan'
        ));
    }


    /**
     * Form tambah video.
     */
    public function create(Request $request)
    {
        $pertemuan = (int) $request->get('pertemuan', 1);

        if ($pertemuan < 1 || $pertemuan > 8) {
            $pertemuan = 1;
        }

        return view('guru.videos.create', compact(
            'pertemuan'
        ));
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
                'max:8',
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
        ]);


        /*
        |--------------------------------------------------------------------------
        | Maksimal 10 video per pertemuan
        |--------------------------------------------------------------------------
        */

        $jumlahVideo = Video::where(
            'pertemuan',
            $validated['pertemuan']
        )->count();

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
        | Tentukan urutan otomatis
        |--------------------------------------------------------------------------
        */

        $urutan = $jumlahVideo + 1;


        Video::create([
            'pertemuan' => $validated['pertemuan'],
            'judul' => $validated['judul'],
            'youtube_url' => $validated['youtube_url'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'urutan' => $urutan,
        ]);


        return redirect()
            ->route('guru.videos.index', [
                'pertemuan' => $validated['pertemuan'],
            ])
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
        return view(
            'guru.videos.edit',
            compact('video')
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
                'max:8',
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
        ]);


        /*
        |--------------------------------------------------------------------------
        | Jika pindah pertemuan
        |--------------------------------------------------------------------------
        */

        if (
            (int) $video->pertemuan !==
            (int) $validated['pertemuan']
        ) {

            $jumlahVideo = Video::where(
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


        $video->update($validated);


        return redirect()
            ->route('guru.videos.index', [
                'pertemuan' => $video->pertemuan,
            ])
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


        $video->delete();


        /*
        |--------------------------------------------------------------------------
        | Rapikan urutan video setelah penghapusan
        |--------------------------------------------------------------------------
        */

        $videos = Video::where(
            'pertemuan',
            $pertemuan
        )
            ->orderBy('urutan')
            ->orderBy('id')
            ->get();


        foreach ($videos as $index => $item) {

            $item->update([
                'urutan' => $index + 1,
            ]);
        }


        return redirect()
            ->route('guru.videos.index', [
                'pertemuan' => $pertemuan,
            ])
            ->with(
                'success',
                'Video berhasil dihapus.'
            );
    }
}