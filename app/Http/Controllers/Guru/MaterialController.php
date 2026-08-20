<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\MaterialMeeting;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Menampilkan daftar materi.
     */
    public function index(Request $request)
    {
        $pertemuan = $request->get('pertemuan');


        /*
        |--------------------------------------------------------------------------
        | DAFTAR MATERI
        |--------------------------------------------------------------------------
        */

        $materials = Material::query()
            ->when(
                $pertemuan,
                function ($query) use ($pertemuan) {

                    $query->where(
                        'pertemuan',
                        $pertemuan
                    );

                }
            )
            ->orderBy('pertemuan')
            ->orderBy('id')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | DAFTAR PERTEMUAN
        |--------------------------------------------------------------------------
        |
        | Sumber pertemuan berasal dari material_meetings.
        |
        */

        $pertemuans = MaterialMeeting::query()
            ->where('aktif', true)
            ->orderBy('pertemuan')
            ->pluck('pertemuan');


        return view(
            'guru.materials.index',
            compact(
                'materials',
                'pertemuan',
                'pertemuans'
            )
        );
    }


    /**
     * Form tambah materi.
     */
    public function create()
    {
        /*
        |--------------------------------------------------------------------------
        | DAFTAR PERTEMUAN
        |--------------------------------------------------------------------------
        */

        $pertemuans = MaterialMeeting::query()
            ->where('aktif', true)
            ->orderBy('pertemuan')
            ->pluck('pertemuan');


        return view(
            'guru.materials.create',
            compact(
                'pertemuans'
            )
        );
    }


    /**
     * Menyimpan materi baru.
     */
    public function store(
        Request $request
    ) {

        $validated = $request->validate([

            'pertemuan' => [
                'required',
                'integer',
                'min:1',
                'max:255',
            ],

            'judul' => [
                'required',
                'string',
                'max:255',
            ],

            'kategori' => [
                'nullable',
                'string',
                'max:100',
            ],

            'isi' => [
                'nullable',
                'string',
            ],

            'gambar' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'video_url' => [
                'nullable',
                'url',
                'max:2048',
            ],

            'audio_url' => [
                'nullable',
                'url',
                'max:2048',
            ],

            'aktif' => [
                'nullable',
                'boolean',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | PASTIKAN PERTEMUAN SUDAH ADA
        |--------------------------------------------------------------------------
        */

        $meetingExists =
            MaterialMeeting::query()
                ->where(
                    'pertemuan',
                    $validated['pertemuan']
                )
                ->where(
                    'aktif',
                    true
                )
                ->exists();


        if (!$meetingExists) {

            return back()
                ->withInput()
                ->withErrors([
                    'pertemuan' =>
                        "Pertemuan {$validated['pertemuan']} belum tersedia.",
                ]);

        }


        /*
        |--------------------------------------------------------------------------
        | UPLOAD GAMBAR
        |--------------------------------------------------------------------------
        */

        if (
            $request->hasFile('gambar')
        ) {

            $validated['gambar'] =
                $request
                    ->file('gambar')
                    ->store(
                        'materials',
                        'public'
                    );

        }


        /*
        |--------------------------------------------------------------------------
        | STATUS AKTIF
        |--------------------------------------------------------------------------
        */

        $validated['aktif'] =
            $request->boolean(
                'aktif'
            );


        /*
        |--------------------------------------------------------------------------
        | SIMPAN MATERI
        |--------------------------------------------------------------------------
        */

        Material::create(
            $validated
        );


        return redirect()
            ->route(
                'guru.materials.index',
                [
                    'pertemuan' =>
                        $validated['pertemuan'],
                ]
            )
            ->with(
                'success',
                'Materi berhasil ditambahkan.'
            );
    }


    /**
     * Upload gambar untuk Rich Text Editor.
     */
    public function uploadImage(
        Request $request
    ) {

        $request->validate([

            'image' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

        ]);


        $path =
            $request
                ->file('image')
                ->store(
                    'materials/content',
                    'public'
                );


        return response()->json([

            'success' => true,

            'url' => asset(
                'storage/' . $path
            ),

        ]);
    }


    /**
     * Menampilkan detail materi.
     */
    public function show(
        Material $material
    ) {

        return view(
            'guru.materials.show',
            compact(
                'material'
            )
        );
    }


    /**
     * Form edit materi.
     */
    public function edit(
        Material $material
    ) {

        $pertemuans =
            MaterialMeeting::query()
                ->where('aktif', true)
                ->orderBy('pertemuan')
                ->pluck('pertemuan');


        return view(
            'guru.materials.edit',
            compact(
                'material',
                'pertemuans'
            )
        );
    }


    /**
     * Memperbarui materi.
     */
    public function update(
        Request $request,
        Material $material
    ) {

        $validated = $request->validate([

            'pertemuan' => [
                'required',
                'integer',
                'min:1',
                'max:255',
            ],

            'judul' => [
                'required',
                'string',
                'max:255',
            ],

            'kategori' => [
                'nullable',
                'string',
                'max:100',
            ],

            'isi' => [
                'nullable',
                'string',
            ],

            'gambar' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'video_url' => [
                'nullable',
                'url',
                'max:2048',
            ],

            'audio_url' => [
                'nullable',
                'url',
                'max:2048',
            ],

            'aktif' => [
                'nullable',
                'boolean',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | PASTIKAN PERTEMUAN SUDAH ADA
        |--------------------------------------------------------------------------
        */

        $meetingExists =
            MaterialMeeting::query()
                ->where(
                    'pertemuan',
                    $validated['pertemuan']
                )
                ->where(
                    'aktif',
                    true
                )
                ->exists();


        if (!$meetingExists) {

            return back()
                ->withInput()
                ->withErrors([
                    'pertemuan' =>
                        "Pertemuan {$validated['pertemuan']} belum tersedia.",
                ]);

        }


        /*
        |--------------------------------------------------------------------------
        | UPLOAD GAMBAR BARU
        |--------------------------------------------------------------------------
        */

        if (
            $request->hasFile('gambar')
        ) {

            $validated['gambar'] =
                $request
                    ->file('gambar')
                    ->store(
                        'materials',
                        'public'
                    );

        } else {

            unset(
                $validated['gambar']
            );

        }


        /*
        |--------------------------------------------------------------------------
        | STATUS AKTIF
        |--------------------------------------------------------------------------
        */

        $validated['aktif'] =
            $request->boolean(
                'aktif'
            );


        /*
        |--------------------------------------------------------------------------
        | UPDATE
        |--------------------------------------------------------------------------
        */

        $material->update(
            $validated
        );


        return redirect()
            ->route(
                'guru.materials.index',
                [
                    'pertemuan' =>
                        $validated['pertemuan'],
                ]
            )
            ->with(
                'success',
                'Materi berhasil diperbarui.'
            );
    }


    /**
     * Menghapus materi.
     *
     * Jika masih ada materi lain pada pertemuan yang sama,
     * pertemuan tetap dipertahankan.
     *
     * Jika materi yang dihapus adalah materi terakhir,
     * pertemuan tersebut ikut dihapus dari material_meetings.
     */
    public function destroy(
        Material $material
    ) {

        $pertemuan =
            $material->pertemuan;


        /*
        |--------------------------------------------------------------------------
        | HAPUS MATERI
        |--------------------------------------------------------------------------
        */

        $material->delete();


        /*
        |--------------------------------------------------------------------------
        | CEK APAKAH MASIH ADA MATERI
        |--------------------------------------------------------------------------
        */

        $remainingMaterials =
            Material::query()
                ->where(
                    'pertemuan',
                    $pertemuan
                )
                ->exists();


        /*
        |--------------------------------------------------------------------------
        | JIKA SUDAH TIDAK ADA MATERI
        |--------------------------------------------------------------------------
        */

        if (!$remainingMaterials) {

            MaterialMeeting::query()
                ->where(
                    'pertemuan',
                    $pertemuan
                )
                ->delete();

        }


        /*
        |--------------------------------------------------------------------------
        | KEMBALI KE INDEX
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'guru.materials.index',
                [
                    'pertemuan' =>
                        $pertemuan,
                ]
            )
            ->with(
                'success',
                'Materi berhasil dihapus. Quiz dan Refleksi tetap aman.'
            );
    }
}