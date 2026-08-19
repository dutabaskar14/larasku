<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Menampilkan daftar materi.
     */
    public function index(Request $request)
    {
        $pertemuan = $request->get('pertemuan');

        $materials = Material::query()
            ->when($pertemuan, function ($query) use ($pertemuan) {
                $query->where('pertemuan', $pertemuan);
            })
            ->orderBy('pertemuan')
            ->orderBy('id')
            ->get();

        return view(
            'guru.materials.index',
            compact(
                'materials',
                'pertemuan'
            )
        );
    }


    /**
     * Form tambah materi.
     */
    public function create()
    {
        return view(
            'guru.materials.create'
        );
    }


    /**
     * Menyimpan materi baru.
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

            'kategori' => [
                'nullable',
                'string',
                'max:100',
            ],

            'isi' => [
                'nullable',
                'string',
            ],

            /*
            |--------------------------------------------------------------------------
            | GAMBAR UTAMA
            |--------------------------------------------------------------------------
            */

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
        | UPLOAD GAMBAR UTAMA
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('gambar')) {

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
            $request->boolean('aktif');


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
     *
     * Gambar yang dimasukkan ke dalam
     * isi materi disimpan sebagai file.
     */
    public function uploadImage(Request $request)
    {
        $request->validate([

            'image' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

        ]);


        $path = $request
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
    public function show(Material $material)
    {
        return view(
            'guru.materials.show',
            compact('material')
        );
    }


    /**
     * Form edit materi.
     */
    public function edit(Material $material)
    {
        return view(
            'guru.materials.edit',
            compact('material')
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
                'max:8',
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

            /*
            |--------------------------------------------------------------------------
            | GAMBAR UTAMA
            |--------------------------------------------------------------------------
            */

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
        | GAMBAR UTAMA BARU
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('gambar')) {

            $validated['gambar'] =
                $request
                    ->file('gambar')
                    ->store(
                        'materials',
                        'public'
                    );

        } else {

            /*
            | Tidak ada gambar baru.
            | Gambar lama tetap dipertahankan.
            */

            unset(
                $validated['gambar']
            );
        }


        /*
        |--------------------------------------------------------------------------
        | STATUS
        |--------------------------------------------------------------------------
        */

        $validated['aktif'] =
            $request->boolean('aktif');


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
     */
    public function destroy(
        Material $material
    ) {
        $pertemuan =
            $material->pertemuan;


        $material->delete();


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
                'Materi berhasil dihapus.'
            );
    }
}