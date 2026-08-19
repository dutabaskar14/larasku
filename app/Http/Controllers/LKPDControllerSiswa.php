<?php

namespace App\Http\Controllers;

use App\Models\LKPD;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LKPDControllerSiswa extends Controller
{
    /**
     * Menampilkan halaman LKPD siswa.
     */
    public function index(Request $request)
    {
        $kelas = $request->get('kelas', '');

        $pertemuan = (int) $request->get('pertemuan', 1);

        if ($pertemuan < 1 || $pertemuan > 8) {
            $pertemuan = 1;
        }

        /*
        |--------------------------------------------------------------------------
        | Daftar kelas
        |--------------------------------------------------------------------------
        */

        $classes = Student::where('aktif', true)
            ->whereNotNull('kelas')
            ->where('kelas', '!=', '')
            ->select('kelas')
            ->distinct()
            ->orderBy('kelas')
            ->pluck('kelas');


        /*
        |--------------------------------------------------------------------------
        | Daftar siswa berdasarkan kelas
        |--------------------------------------------------------------------------
        */

        $students = collect();

        if ($kelas !== '') {
            $students = Student::where('aktif', true)
                ->where('kelas', $kelas)
                ->orderBy('nomor_absen')
                ->orderBy('nama')
                ->get();
        }


        /*
        |--------------------------------------------------------------------------
        | Siswa yang dipilih
        |--------------------------------------------------------------------------
        */

        $studentId = $request->get('student_id');

        $selectedStudent = null;

        if ($studentId) {
            $selectedStudent = $students
                ->firstWhere('id', (int) $studentId);
        }


        /*
        |--------------------------------------------------------------------------
        | LKPD yang sudah dikumpulkan
        |--------------------------------------------------------------------------
        */

        $existingLkpd = null;

        if ($selectedStudent) {
            $existingLkpd = LKPD::where(
                'student_id',
                $selectedStudent->id
            )
                ->where('pertemuan', $pertemuan)
                ->first();
        }


        /*
        |--------------------------------------------------------------------------
        | Soal / tugas setiap pertemuan
        |--------------------------------------------------------------------------
        */

        $task = $this->tasks($pertemuan);


        return view('lkpd.index', compact(
            'classes',
            'kelas',
            'students',
            'studentId',
            'selectedStudent',
            'pertemuan',
            'task',
            'existingLkpd'
        ));
    }


    /**
     * Mengirim tugas LKPD.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => [
                'required',
                'integer',
                'exists:students,id',
            ],

            'pertemuan' => [
                'required',
                'integer',
                'min:1',
                'max:8',
            ],

            'foto' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Pastikan siswa aktif
        |--------------------------------------------------------------------------
        */

        $student = Student::where('id', $validated['student_id'])
            ->where('aktif', true)
            ->first();

        if (!$student) {
            return back()
                ->withErrors([
                    'student_id' =>
                        'Siswa tidak ditemukan atau sudah tidak aktif.',
                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | Cek pengumpulan sebelumnya
        |--------------------------------------------------------------------------
        */

        $existingLkpd = LKPD::where('student_id', $student->id)
            ->where('pertemuan', $validated['pertemuan'])
            ->first();


        /*
        |--------------------------------------------------------------------------
        | Upload foto
        |--------------------------------------------------------------------------
        */

        $foto = $request->file('foto');

        $path = $foto->store(
            'lkpd',
            'public'
        );


        /*
        |--------------------------------------------------------------------------
        | Jika sudah pernah mengirim, hapus foto lama
        |--------------------------------------------------------------------------
        */

        if ($existingLkpd && $existingLkpd->foto) {

            if (Storage::disk('public')->exists($existingLkpd->foto)) {
                Storage::disk('public')->delete(
                    $existingLkpd->foto
                );
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Simpan / update LKPD
        |--------------------------------------------------------------------------
        */

        LKPD::updateOrCreate(
            [
                'student_id' => $student->id,
                'pertemuan' => $validated['pertemuan'],
            ],
            [
                'foto' => $path,
            ]
        );


        return redirect()
            ->route('lkpd.index', [
                'kelas' => $student->kelas,
                'student_id' => $student->id,
                'pertemuan' => $validated['pertemuan'],
            ])
            ->with(
                'success',
                'Tugas LKPD berhasil dikirim.'
            );
    }


    /**
     * Tugas LKPD setiap pertemuan.
     */
    private function tasks(int $pertemuan): string
    {
        return match ($pertemuan) {

            1 =>
                'Pilih satu lagu daerah yang kamu ketahui. Tuliskan identitas lagu tersebut pada buku tugas, meliputi nama lagu dan daerah asalnya. Setelah selesai, foto hasil pekerjaanmu dan unggah di sini.',

            2 =>
                'Pilih satu lagu daerah. Identifikasi dan tuliskan ciri-ciri lagu tersebut berdasarkan materi yang telah dipelajari. Foto hasil pekerjaanmu dan unggah di sini.',

            3 =>
                'Lakukan latihan teknik dasar bernyanyi dengan memperhatikan sikap tubuh dan teknik pernapasan. Tuliskan hasil pengalaman latihanmu pada buku tugas, kemudian foto hasil pekerjaanmu dan unggah di sini.',

            4 =>
                'Latih satu bagian lagu daerah dengan memperhatikan intonasi, artikulasi, tempo, dan frasering. Tuliskan hasil latihan atau catatan kesulitanmu pada buku tugas, kemudian foto hasil pekerjaanmu dan unggah di sini.',

            5 =>
                'Pilih tiga alat musik tradisional Indonesia. Tuliskan nama alat musik dan daerah asalnya. Foto hasil pekerjaanmu dan unggah di sini.',

            6 =>
                'Pilih empat alat musik tradisional yang dimainkan dengan cara berbeda. Tuliskan nama alat musik dan cara memainkannya. Foto hasil pekerjaanmu dan unggah di sini.',

            7 =>
                'Pilih empat alat musik tradisional dan kelompokkan berdasarkan sumber bunyinya: kordofon, aerofon, membranofon, atau idiofon. Foto hasil pekerjaanmu dan unggah di sini.',

            8 =>
                'Buatlah tulisan singkat tentang cara yang dapat dilakukan generasi muda untuk melestarikan alat musik tradisional Indonesia. Kerjakan pada buku tugas, kemudian foto hasil pekerjaanmu dan unggah di sini.',

            default =>
                'Kerjakan tugas sesuai materi pembelajaran pada pertemuan ini, kemudian foto hasil pekerjaanmu dan unggah di sini.',
        };
    }
}