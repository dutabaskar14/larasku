<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\ClassRoom;
use App\Models\MaterialMeeting;
use App\Models\Student;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Halaman absensi siswa.
     *
     * Kelas diambil dari tabel classes.
     * Siswa diambil dari tabel students
     * berdasarkan kelas yang dipilih.
     *
     * Pertemuan diambil dari material_meetings
     * yang sedang aktif.
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
        | AMBIL PERTEMUAN AKTIF
        |--------------------------------------------------------------------------
        |
        | Pertemuan absensi mengikuti pertemuan
        | yang dibuka oleh guru melalui material_meetings.
        |
        */

        $meetings = MaterialMeeting::query()
            ->where('aktif', true)
            ->orderBy('pertemuan')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | KELAS YANG DIPILIH
        |--------------------------------------------------------------------------
        */

        $kelas = $request->get('kelas', '');


        /*
        |--------------------------------------------------------------------------
        | AMBIL DATA KELAS TERPILIH
        |--------------------------------------------------------------------------
        */

        $selectedClass = ClassRoom::query()
            ->where('nama', $kelas)
            ->where('aktif', true)
            ->first();


        /*
        |--------------------------------------------------------------------------
        | DAFTAR SISWA
        |--------------------------------------------------------------------------
        |
        | Hanya siswa aktif dari kelas yang dipilih.
        |
        */

        $students = Student::query()
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
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'attendance.index',
            compact(
                'classes',
                'meetings',
                'kelas',
                'students',
                'selectedClass'
            )
        );
    }


    /**
     * Menyimpan absensi siswa.
     *
     * Satu siswa hanya boleh memiliki
     * satu absensi untuk setiap pertemuan.
     *
     * Siswa hanya dapat melakukan absensi
     * pada pertemuan yang sedang aktif
     * di material_meetings.
     */
    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI INPUT
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'kelas' => [
                'required',
                'string',
                'max:100',
            ],

            'student_id' => [
                'required',
                'exists:students,id',
            ],

            'pertemuan' => [
                'required',
                'integer',
                'min:1',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | AMBIL KELAS
        |--------------------------------------------------------------------------
        |
        | Kelas tetap berasal dari tabel classes.
        |
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


        /*
        |--------------------------------------------------------------------------
        | KELAS TIDAK TERSEDIA
        |--------------------------------------------------------------------------
        */

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
        | CEK PERTEMUAN AKTIF
        |--------------------------------------------------------------------------
        |
        | Pertemuan sekarang tidak lagi bergantung
        | pada classes.pertemuan_aktif.
        |
        | Sumber kebenaran:
        |
        | material_meetings
        |     aktif = true
        |
        */

        $meeting = MaterialMeeting::query()
            ->where(
                'pertemuan',
                $validated['pertemuan']
            )
            ->where(
                'aktif',
                true
            )
            ->first();


        /*
        |--------------------------------------------------------------------------
        | PERTEMUAN BELUM DIBUKA
        |--------------------------------------------------------------------------
        */

        if (! $meeting) {

            return back()
                ->withInput()
                ->withErrors([
                    'pertemuan' =>
                        "Pertemuan {$validated['pertemuan']} belum dibuka oleh guru.",
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | CARI SISWA
        |--------------------------------------------------------------------------
        |
        | Siswa harus:
        |
        | 1. Ada di tabel students
        | 2. Aktif
        | 3. Berasal dari kelas yang dipilih
        |
        */

        $student = Student::query()
            ->where(
                'id',
                $validated['student_id']
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


        /*
        |--------------------------------------------------------------------------
        | SISWA TIDAK SESUAI KELAS
        |--------------------------------------------------------------------------
        */

        if (! $student) {

            return back()
                ->withInput()
                ->withErrors([
                    'student_id' =>
                        'Siswa tidak ditemukan pada kelas yang dipilih.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | CEK ABSENSI YANG SUDAH ADA
        |--------------------------------------------------------------------------
        |
        | Satu siswa hanya boleh mempunyai
        | satu absensi pada setiap pertemuan.
        |
        */

        $attendance = Attendance::query()
            ->where(
                'student_id',
                $student->id
            )
            ->where(
                'pertemuan',
                $validated['pertemuan']
            )
            ->first();


        /*
        |--------------------------------------------------------------------------
        | SUDAH ABSEN
        |--------------------------------------------------------------------------
        */

        if ($attendance) {

            /*
            |--------------------------------------------------------------------------
            | SIMPAN IDENTITAS SISWA KE SESSION
            |--------------------------------------------------------------------------
            */

            session([
                'student_id' =>
                    $student->id,
            ]);


            /*
            |--------------------------------------------------------------------------
            | KEMBALI KE DASHBOARD
            |--------------------------------------------------------------------------
            */

            return redirect()
                ->route(
                    'student.dashboard'
                )
                ->with(
                    'success',
                    "{$student->nama} sudah tercatat hadir pada Pertemuan {$validated['pertemuan']}."
                );
        }


        /*
        |--------------------------------------------------------------------------
        | BUAT ABSENSI BARU
        |--------------------------------------------------------------------------
        */

        Attendance::create([

            'student_id' =>
                $student->id,

            'pertemuan' =>
                $validated['pertemuan'],

            'tanggal' =>
                now()->toDateString(),

            'status' =>
                'hadir',

        ]);


        /*
        |--------------------------------------------------------------------------
        | SIMPAN IDENTITAS SISWA KE SESSION
        |--------------------------------------------------------------------------
        */

        session([
            'student_id' =>
                $student->id,
        ]);


        /*
        |--------------------------------------------------------------------------
        | MASUK DASHBOARD SISWA
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'student.dashboard'
            )
            ->with(
                'success',
                "Absensi {$student->nama} berhasil dicatat."
            );
    }
}