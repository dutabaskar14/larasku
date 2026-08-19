<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\ClassRoom;
use App\Models\Material;
use App\Models\Student;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Menampilkan kelola absensi guru.
     *
     * Daftar pertemuan mengikuti pertemuan yang sudah dibuat
     * melalui materi.
     */
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | AMBIL KELAS AKTIF
        |--------------------------------------------------------------------------
        */

        $classes = ClassRoom::query()
            ->where('aktif', true)
            ->orderBy('nama')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | KELAS TERPILIH
        |--------------------------------------------------------------------------
        */

        $kelas = $request->get('kelas', '');

        if ($kelas === '' && $classes->isNotEmpty()) {
            $kelas = $classes->first()->nama;
        }


        /*
        |--------------------------------------------------------------------------
        | CARI KELAS TERPILIH
        |--------------------------------------------------------------------------
        */

        $selectedClass = $classes->firstWhere(
            'nama',
            $kelas
        );


        /*
        |--------------------------------------------------------------------------
        | AMBIL PERTEMUAN DARI MATERIAL
        |--------------------------------------------------------------------------
        |
        | Pertemuan tidak lagi dibatasi 1-8.
        |
        | Contoh:
        |
        | Material:
        | Pertemuan 1
        | Pertemuan 2
        | Pertemuan 3
        |
        | Maka absensi otomatis memiliki:
        | Pertemuan 1
        | Pertemuan 2
        | Pertemuan 3
        |
        */

        $pertemuans = Material::query()
            ->whereNotNull('pertemuan')
            ->select('pertemuan')
            ->distinct()
            ->orderBy('pertemuan')
            ->pluck('pertemuan');


        /*
        |--------------------------------------------------------------------------
        | PERTEMUAN YANG DIPILIH
        |--------------------------------------------------------------------------
        */

        $pertemuan = $request->get('pertemuan');

        if (
            $pertemuan === null &&
            $pertemuans->isNotEmpty()
        ) {
            $pertemuan = $pertemuans->first();
        }

        $pertemuan =
            $pertemuan !== null
                ? (int) $pertemuan
                : null;


        /*
        |--------------------------------------------------------------------------
        | VALIDASI PERTEMUAN
        |--------------------------------------------------------------------------
        |
        | Pertemuan harus benar-benar berasal dari materi.
        |
        */

        if (
            $pertemuan !== null &&
            ! $pertemuans->contains($pertemuan)
        ) {
            $pertemuan = $pertemuans->first();

            $pertemuan =
                $pertemuan !== null
                    ? (int) $pertemuan
                    : null;
        }


        /*
        |--------------------------------------------------------------------------
        | AMBIL SISWA
        |--------------------------------------------------------------------------
        */

        $students = Student::with('attendances')
            ->where('aktif', true)
            ->when(
                $kelas !== '',
                function ($query) use ($kelas) {

                    $query->where(
                        'kelas',
                        $kelas
                    );
                }
            )
            ->orderByRaw(
                'CAST(nomor_absen AS INTEGER) ASC'
            )
            ->orderBy('nama')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | ABSENSI PERTEMUAN TERPILIH
        |--------------------------------------------------------------------------
        */

        $attendances = collect();

        if ($pertemuan !== null) {

            $attendances = Attendance::where(
                    'pertemuan',
                    $pertemuan
                )
                ->whereIn(
                    'student_id',
                    $students->pluck('id')
                )
                ->get()
                ->keyBy('student_id');
        }


        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'guru.attendance.index',
            compact(
                'classes',
                'selectedClass',
                'students',
                'attendances',
                'kelas',
                'pertemuan',
                'pertemuans'
            )
        );
    }


    /**
     * Membuka pertemuan untuk sebuah kelas.
     *
     * Jika guru membuka pertemuan 3,
     * maka pertemuan 1, 2, dan 3 tetap terbuka.
     */
    public function openMeeting(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'kelas' => [
                'required',
                'string',
                'max:100',
            ],

            'pertemuan' => [
                'required',
                'integer',
                'min:1',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | PASTIKAN PERTEMUAN ADA DI MATERIAL
        |--------------------------------------------------------------------------
        */

        $meetingExists = Material::query()
            ->where(
                'pertemuan',
                $validated['pertemuan']
            )
            ->exists();


        if (! $meetingExists) {

            return back()
                ->withInput()
                ->withErrors([
                    'pertemuan' =>
                        'Pertemuan tersebut belum dibuat pada materi.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | AMBIL KELAS
        |--------------------------------------------------------------------------
        */

        $class = ClassRoom::query()
            ->where(
                'nama',
                $validated['kelas']
            )
            ->where(
                'aktif',
                true
            )
            ->first();


        if (! $class) {

            return back()
                ->withInput()
                ->withErrors([
                    'kelas' =>
                        'Kelas yang dipilih tidak tersedia.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | PERTEMUAN HANYA BOLEH MAJU
        |--------------------------------------------------------------------------
        |
        | Contoh:
        |
        | Pertemuan aktif = 2
        |
        | Guru membuka 3:
        |
        | 1 = terbuka
        | 2 = terbuka
        | 3 = terbuka
        |
        | Pertemuan sebelumnya tidak dikunci.
        |
        */

        if (
            $validated['pertemuan']
            > (int) $class->pertemuan_aktif
        ) {

            $class->update([
                'pertemuan_aktif' =>
                    $validated['pertemuan'],
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | KEMBALI KE HALAMAN ABSENSI
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'guru.attendance.index',
                [
                    'kelas' =>
                        $class->nama,

                    'pertemuan' =>
                        $validated['pertemuan'],
                ]
            )
            ->with(
                'success',
                "Pertemuan {$validated['pertemuan']} untuk kelas {$class->nama} berhasil dibuka."
            );
    }


    /**
     * Menampilkan rekap absensi.
     *
     * Jumlah pertemuan mengikuti materi.
     */
    public function rekap(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | AMBIL KELAS AKTIF
        |--------------------------------------------------------------------------
        */

        $classes = ClassRoom::query()
            ->where('aktif', true)
            ->orderBy('nama')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | KELAS TERPILIH
        |--------------------------------------------------------------------------
        */

        $kelas = $request->get('kelas', '');

        if ($kelas === '' && $classes->isNotEmpty()) {
            $kelas = $classes->first()->nama;
        }


        /*
        |--------------------------------------------------------------------------
        | SISWA
        |--------------------------------------------------------------------------
        */

        $students = Student::with('attendances')
            ->where('aktif', true)
            ->when(
                $kelas !== '',
                function ($query) use ($kelas) {

                    $query->where(
                        'kelas',
                        $kelas
                    );
                }
            )
            ->orderByRaw(
                'CAST(nomor_absen AS INTEGER) ASC'
            )
            ->orderBy('nama')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | PERTEMUAN DARI MATERIAL
        |--------------------------------------------------------------------------
        */

        $pertemuans = Material::query()
            ->whereNotNull('pertemuan')
            ->select('pertemuan')
            ->distinct()
            ->orderBy('pertemuan')
            ->pluck('pertemuan');


        /*
        |--------------------------------------------------------------------------
        | VIEW REKAP
        |--------------------------------------------------------------------------
        */

        return view(
            'guru.attendance.rekap',
            compact(
                'classes',
                'students',
                'kelas',
                'pertemuans'
            )
        );
    }


    /**
     * Menyimpan perubahan absensi satu pertemuan.
     */
    public function update(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'kelas' => [
                'required',
                'string',
                'max:100',
            ],

            'pertemuan' => [
                'required',
                'integer',
                'min:1',
            ],

            'attendance' => [
                'required',
                'array',
            ],

            'attendance.*' => [
                'required',
                'in:hadir,sakit,izin,alfa,dispensasi',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | PASTIKAN PERTEMUAN ADA DI MATERIAL
        |--------------------------------------------------------------------------
        */

        $meetingExists = Material::query()
            ->where(
                'pertemuan',
                $validated['pertemuan']
            )
            ->exists();


        if (! $meetingExists) {

            return back()
                ->withInput()
                ->withErrors([
                    'pertemuan' =>
                        'Pertemuan tersebut belum dibuat pada materi.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | PASTIKAN KELAS ADA
        |--------------------------------------------------------------------------
        */

        $class = ClassRoom::query()
            ->where(
                'nama',
                $validated['kelas']
            )
            ->where(
                'aktif',
                true
            )
            ->first();


        if (! $class) {

            return back()
                ->withInput()
                ->withErrors([
                    'kelas' =>
                        'Kelas yang dipilih tidak tersedia.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN ABSENSI
        |--------------------------------------------------------------------------
        */

        foreach (
            $validated['attendance']
            as $studentId => $status
        ) {

            /*
            |--------------------------------------------------------------------------
            | Pastikan siswa aktif dan berasal dari kelas tersebut.
            |--------------------------------------------------------------------------
            */

            $student = Student::query()
                ->where(
                    'id',
                    $studentId
                )
                ->where(
                    'kelas',
                    $validated['kelas']
                )
                ->where(
                    'aktif',
                    true
                )
                ->first();


            if (! $student) {
                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | UPDATE / CREATE ABSENSI
            |--------------------------------------------------------------------------
            */

            Attendance::updateOrCreate(

                [
                    'student_id' =>
                        $student->id,

                    'pertemuan' =>
                        $validated['pertemuan'],
                ],

                [
                    'tanggal' =>
                        now()->toDateString(),

                    'status' =>
                        $status,
                ]

            );
        }


        /*
        |--------------------------------------------------------------------------
        | KEMBALI KE ABSENSI
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'guru.attendance.index',
                [
                    'kelas' =>
                        $validated['kelas'],

                    'pertemuan' =>
                        $validated['pertemuan'],
                ]
            )
            ->with(
                'success',
                'Absensi berhasil diperbarui.'
            );
    }
}