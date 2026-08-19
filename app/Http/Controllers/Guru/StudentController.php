<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\ClassRoom;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Menampilkan daftar siswa.
     */
    public function index(Request $request)
    {
        $kelas = $request->get('kelas', '');

        /*
        |--------------------------------------------------------------------------
        | Ambil daftar kelas dari tabel classes
        |--------------------------------------------------------------------------
        */

        $classes = ClassRoom::query()
            ->where('aktif', true)
            ->orderBy('nama')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Daftar siswa
        |--------------------------------------------------------------------------
        |
        | Nomor absen diurutkan secara NUMERIK.
        | Bukan berdasarkan urutan teks/string.
        |
        */

        $students = Student::query()
            ->orderBy('kelas')
            ->orderByRaw(
                'CAST(nomor_absen AS INTEGER) ASC'
            )
            ->orderBy('nama');


        /*
        |--------------------------------------------------------------------------
        | Filter kelas
        |--------------------------------------------------------------------------
        */

        if ($kelas !== '') {

            $students->where(function ($query) use ($kelas) {

                $query->where(
                    'kelas',
                    $kelas
                )->orWhere(
                    'kelas',
                    str_replace('-', ' ', $kelas)
                );

            });
        }


        /*
        |--------------------------------------------------------------------------
        | Ambil data siswa
        |--------------------------------------------------------------------------
        */

        $students = $students->get();


        /*
        |--------------------------------------------------------------------------
        | Statistik
        |--------------------------------------------------------------------------
        */

        $totalStudents = Student::count();

        $activeStudents = Student::where(
            'aktif',
            true
        )->count();

        $inactiveStudents = Student::where(
            'aktif',
            false
        )->count();


        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'guru.students.index',
            compact(
                'students',
                'kelas',
                'classes',
                'totalStudents',
                'activeStudents',
                'inactiveStudents'
            )
        );
    }


    /**
     * Menampilkan form tambah siswa.
     */
    public function create()
    {
        /*
        |--------------------------------------------------------------------------
        | Ambil kelas aktif dari tabel classes
        |--------------------------------------------------------------------------
        */

        $classes = ClassRoom::query()
            ->where('aktif', true)
            ->orderBy('nama')
            ->get();


        return view(
            'guru.students.create',
            compact('classes')
        );
    }


    /**
     * Menyimpan siswa baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'nama' => [
                'required',
                'string',
                'max:255',
            ],

            'kelas' => [
                'required',
                'string',
                'max:100',
            ],

            'nomor_absen' => [
                'nullable',
                'integer',
                'min:1',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Pastikan kelas berasal dari tabel classes
        |--------------------------------------------------------------------------
        */

        $classExists = ClassRoom::query()
            ->where(
                'nama',
                $validated['kelas']
            )
            ->where(
                'aktif',
                true
            )
            ->exists();


        if (! $classExists) {

            return back()
                ->withInput()
                ->withErrors([
                    'kelas' =>
                        'Kelas yang dipilih tidak tersedia.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Siswa baru otomatis aktif
        |--------------------------------------------------------------------------
        */

        $validated['aktif'] = true;


        /*
        |--------------------------------------------------------------------------
        | Simpan siswa
        |--------------------------------------------------------------------------
        */

        Student::create(
            $validated
        );


        /*
        |--------------------------------------------------------------------------
        | Kembali ke daftar siswa
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'guru.students.index',
                [
                    'kelas' =>
                        $validated['kelas'],
                ]
            )
            ->with(
                'success',
                'Data siswa berhasil ditambahkan.'
            );
    }


    /**
     * Menampilkan detail siswa.
     *
     * Fitur Show tidak digunakan lagi di tampilan.
     */
    public function show(Student $student)
    {
        return view(
            'guru.students.show',
            compact('student')
        );
    }


    /**
     * Menampilkan form edit siswa.
     */
    public function edit(Student $student)
    {
        /*
        |--------------------------------------------------------------------------
        | Ambil kelas aktif
        |--------------------------------------------------------------------------
        */

        $classes = ClassRoom::query()
            ->where('aktif', true)
            ->orderBy('nama')
            ->get();


        return view(
            'guru.students.edit',
            compact(
                'student',
                'classes'
            )
        );
    }


    /**
     * Memperbarui data siswa.
     */
    public function update(
        Request $request,
        Student $student
    ) {
        $validated = $request->validate([

            'nama' => [
                'required',
                'string',
                'max:255',
            ],

            'kelas' => [
                'required',
                'string',
                'max:100',
            ],

            'nomor_absen' => [
                'nullable',
                'integer',
                'min:1',
            ],

            'aktif' => [
                'required',
                'boolean',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Pastikan kelas tersedia
        |--------------------------------------------------------------------------
        */

        $classExists = ClassRoom::query()
            ->where(
                'nama',
                $validated['kelas']
            )
            ->where(
                'aktif',
                true
            )
            ->exists();


        if (! $classExists) {

            return back()
                ->withInput()
                ->withErrors([
                    'kelas' =>
                        'Kelas yang dipilih tidak tersedia.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Update siswa
        |--------------------------------------------------------------------------
        */

        $student->update(
            $validated
        );


        /*
        |--------------------------------------------------------------------------
        | Kembali ke kelas siswa
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'guru.students.index',
                [
                    'kelas' =>
                        $validated['kelas'],
                ]
            )
            ->with(
                'success',
                'Data siswa berhasil diperbarui.'
            );
    }


    /**
     * Menghapus siswa.
     *
     * Hanya menghapus dari tabel students.
     * Data kelas di tabel classes tetap aman.
     */
    public function destroy(Student $student)
    {
        $kelas = $student->kelas;


        $student->delete();


        return redirect()
            ->route(
                'guru.students.index',
                [
                    'kelas' =>
                        $kelas,
                ]
            )
            ->with(
                'success',
                'Data siswa berhasil dihapus.'
            );
    }
}