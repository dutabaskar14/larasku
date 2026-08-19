<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialControllerSiswa extends Controller
{
    /**
     * Menampilkan materi berdasarkan pertemuan untuk siswa.
     */
    public function index(Request $request)
    {
        $pertemuan = $request->get('pertemuan');

        // Validasi pertemuan hanya 1 sampai 8.
        if ($pertemuan !== null) {
            $pertemuan = (int) $pertemuan;

            abort_unless(
                $pertemuan >= 1 && $pertemuan <= 8,
                404
            );
        }

        $materials = Material::where('aktif', true)
            ->when($pertemuan !== null, function ($query) use ($pertemuan) {
                $query->where('pertemuan', $pertemuan);
            })
            ->orderBy('id')
            ->get();

        return view(
            'materials.index',
            compact(
                'materials',
                'pertemuan'
            )
        );
    }

    /**
     * Menampilkan satu materi.
     */
    public function show(Material $material)
    {
        abort_unless($material->aktif, 404);

        return view(
            'materials.show',
            compact('material')
        );
    }
}