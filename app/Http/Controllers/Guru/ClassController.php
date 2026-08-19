<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClassController extends Controller
{
    /**
     * Menampilkan daftar kelas.
     */
    public function index()
    {
        $classes = ClassRoom::query()
            ->withCount('students')
            ->orderBy('nama')
            ->get();

        return view(
            'guru.classes.index',
            compact('classes')
        );
    }


    /**
     * Form tambah kelas.
     */
    public function create()
    {
        return view('guru.classes.create');
    }


    /**
     * Menyimpan kelas baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => [
                'required',
                'string',
                'max:50',
                'unique:classes,nama',
            ],

            'aktif' => [
                'nullable',
                'boolean',
            ],
        ], [
            'nama.required' => 'Nama kelas wajib diisi.',
            'nama.unique' => 'Kelas tersebut sudah tersedia.',
            'nama.max' => 'Nama kelas maksimal 50 karakter.',
        ]);


        $validated['nama'] = trim(
            preg_replace(
                '/\s+/',
                ' ',
                $validated['nama']
            )
        );

        $validated['aktif'] = $request->boolean('aktif');


        /*
        |--------------------------------------------------------------------------
        | CEK DUPLIKAT SETELAH NORMALISASI
        |--------------------------------------------------------------------------
        */

        $exists = ClassRoom::query()
            ->whereRaw(
                'LOWER(nama) = ?',
                [strtolower($validated['nama'])]
            )
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'nama' => 'Kelas tersebut sudah tersedia.',
                ]);
        }


        ClassRoom::create($validated);


        return redirect()
            ->route('guru.classes.index')
            ->with(
                'success',
                'Kelas berhasil ditambahkan.'
            );
    }


    /**
     * Form edit kelas.
     */
    public function edit(ClassRoom $class)
    {
        $studentCount = Student::query()
            ->where('kelas', $class->nama)
            ->count();

        return view(
            'guru.classes.edit',
            compact(
                'class',
                'studentCount'
            )
        );
    }


    /**
     * Memperbarui kelas.
     */
    public function update(
        Request $request,
        ClassRoom $class
    ) {
        $validated = $request->validate([
            'nama' => [
                'required',
                'string',
                'max:50',
                Rule::unique('classes', 'nama')
                    ->ignore($class->id),
            ],

            'aktif' => [
                'nullable',
                'boolean',
            ],
        ], [
            'nama.required' => 'Nama kelas wajib diisi.',
            'nama.unique' => 'Kelas tersebut sudah tersedia.',
            'nama.max' => 'Nama kelas maksimal 50 karakter.',
        ]);


        $namaLama = $class->nama;


        $namaBaru = trim(
            preg_replace(
                '/\s+/',
                ' ',
                $validated['nama']
            )
        );


        /*
        |--------------------------------------------------------------------------
        | CEK DUPLIKAT CASE-INSENSITIVE
        |--------------------------------------------------------------------------
        */

        $exists = ClassRoom::query()
            ->where('id', '!=', $class->id)
            ->whereRaw(
                'LOWER(nama) = ?',
                [strtolower($namaBaru)]
            )
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'nama' => 'Kelas tersebut sudah tersedia.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE KELAS
        |--------------------------------------------------------------------------
        */

        $class->update([
            'nama' => $namaBaru,
            'aktif' => $request->boolean('aktif'),
        ]);


        /*
        |--------------------------------------------------------------------------
        | UPDATE DATA SISWA
        |--------------------------------------------------------------------------
        |
        | Karena students.kelas masih berupa string,
        | jika nama kelas berubah maka siswa yang menggunakan
        | kelas lama juga harus ikut diperbarui.
        |
        */

        if ($namaLama !== $namaBaru) {

            Student::query()
                ->where('kelas', $namaLama)
                ->update([
                    'kelas' => $namaBaru,
                ]);
        }


        return redirect()
            ->route('guru.classes.index')
            ->with(
                'success',
                'Kelas berhasil diperbarui.'
            );
    }


    /**
     * Menghapus kelas.
     */
    public function destroy(ClassRoom $class)
    {
        /*
        |--------------------------------------------------------------------------
        | CEK SISWA
        |--------------------------------------------------------------------------
        |
        | Kelas yang masih memiliki siswa tidak boleh dihapus.
        | Ini untuk mencegah data siswa menjadi tidak memiliki
        | referensi kelas yang valid.
        |
        */

        $studentCount = Student::query()
            ->where('kelas', $class->nama)
            ->count();


        if ($studentCount > 0) {

            return redirect()
                ->route('guru.classes.index')
                ->with(
                    'error',
                    "Kelas {$class->nama} tidak dapat dihapus karena masih memiliki {$studentCount} siswa."
                );
        }


        $class->delete();


        return redirect()
            ->route('guru.classes.index')
            ->with(
                'success',
                'Kelas berhasil dihapus.'
            );
    }
}