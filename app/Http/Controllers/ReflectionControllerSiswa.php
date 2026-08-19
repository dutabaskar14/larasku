<?php

namespace App\Http\Controllers;

use App\Models\Reflection;
use App\Models\Student;
use Illuminate\Http\Request;

class ReflectionControllerSiswa extends Controller
{
    /**
     * Menampilkan halaman refleksi.
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
        | Daftar kelas aktif
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
                ->where(function ($query) use ($kelas) {
                    $query->where('kelas', $kelas)
                        ->orWhere(
                            'kelas',
                            str_replace('-', ' ', $kelas)
                        )
                        ->orWhere(
                            'kelas',
                            str_replace(' ', '-', $kelas)
                        );
                })
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
        | Pertanyaan
        |--------------------------------------------------------------------------
        */

        $questions = $this->questions($pertemuan);


        /*
        |--------------------------------------------------------------------------
        | Refleksi yang sudah pernah disimpan
        |--------------------------------------------------------------------------
        */

        $existingReflection = null;

        if ($selectedStudent) {
            $existingReflection = Reflection::where(
                'student_id',
                $selectedStudent->id
            )
                ->where('pertemuan', $pertemuan)
                ->first();
        }


        return view('reflections.index', compact(
            'classes',
            'kelas',
            'students',
            'studentId',
            'selectedStudent',
            'pertemuan',
            'questions',
            'existingReflection'
        ));
    }


    /**
     * Menyimpan refleksi siswa.
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

            'jawaban_1' => [
                'required',
                'string',
                'max:5000',
            ],

            'jawaban_2' => [
                'required',
                'string',
                'max:5000',
            ],

            'jawaban_3' => [
                'required',
                'string',
                'max:5000',
            ],

            'jawaban_4' => [
                'required',
                'string',
                'max:5000',
            ],

            'jawaban_5' => [
                'required',
                'string',
                'max:5000',
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
        | Simpan / update refleksi
        |--------------------------------------------------------------------------
        */

        Reflection::updateOrCreate(
            [
                'student_id' => $student->id,
                'pertemuan' => $validated['pertemuan'],
            ],
            [
                'jawaban_1' => $validated['jawaban_1'],
                'jawaban_2' => $validated['jawaban_2'],
                'jawaban_3' => $validated['jawaban_3'],
                'jawaban_4' => $validated['jawaban_4'],
                'jawaban_5' => $validated['jawaban_5'],
            ]
        );


        return redirect()
            ->route('reflections.index', [
                'kelas' => $student->kelas,
                'student_id' => $student->id,
                'pertemuan' => $validated['pertemuan'],
            ])
            ->with(
                'success',
                'Refleksi berhasil dikirim.'
            );
    }


    /**
     * Pertanyaan refleksi 8 pertemuan.
     */
    private function questions(int $pertemuan): array
    {
        return match ($pertemuan) {

            1 => [
                'Apa yang kamu pahami tentang pengertian lagu daerah setelah mengikuti pembelajaran hari ini?',
                'Sebutkan satu lagu daerah yang kamu ketahui dan jelaskan dari daerah mana lagu tersebut berasal.',
                'Menurut pendapatmu, mengapa lagu daerah perlu dilestarikan oleh generasi muda?',
                'Apa hal baru yang kamu ketahui tentang lagu daerah pada pembelajaran hari ini?',
                'Setelah mempelajari lagu daerah, bagaimana perasaanmu terhadap keberagaman budaya musik di Indonesia?',
            ],

            2 => [
                'Apa ciri-ciri lagu daerah yang kamu pahami setelah pembelajaran hari ini?',
                'Lagu daerah apa yang paling menarik perhatianmu? Jelaskan alasanmu.',
                'Apa perbedaan yang kamu rasakan antara lagu daerah dari satu daerah dengan daerah lainnya?',
                'Bagian materi lagu daerah apa yang masih membuatmu bingung atau belum kamu pahami?',
                'Menurutmu, bagaimana cara yang dapat dilakukan siswa untuk ikut melestarikan lagu daerah?',
            ],

            3 => [
                'Apa yang kamu pahami tentang teknik pernapasan dalam bernyanyi?',
                'Teknik bernyanyi apa yang menurutmu paling sulit untuk dilakukan? Mengapa?',
                'Apa yang kamu rasakan ketika mencoba menerapkan teknik pernapasan saat bernyanyi?',
                'Kesalahan apa yang kamu lakukan saat berlatih bernyanyi dan bagaimana cara kamu memperbaikinya?',
                'Setelah mengikuti pembelajaran hari ini, perubahan apa yang kamu rasakan dalam kemampuan bernyanyimu?',
            ],

            4 => [
                'Apa yang kamu pahami tentang intonasi, artikulasi, tempo, dan frasering?',
                'Dari keempat teknik tersebut, teknik mana yang paling sulit kamu kuasai? Jelaskan alasannya.',
                'Mengapa ketepatan intonasi penting ketika menyanyikan lagu daerah?',
                'Bagaimana cara kamu berlatih agar pengucapan lirik lagu daerah menjadi lebih jelas?',
                'Setelah melakukan latihan bernyanyi, apa kemampuan yang ingin kamu tingkatkan pada latihan berikutnya?',
            ],

            5 => [
                'Apa yang kamu pahami tentang pengertian alat musik tradisional?',
                'Sebutkan alat musik tradisional yang kamu ketahui dan jelaskan daerah asalnya.',
                'Alat musik tradisional apa yang paling menarik perhatianmu? Mengapa?',
                'Apa hal baru yang kamu ketahui tentang alat musik tradisional Indonesia hari ini?',
                'Menurutmu, mengapa setiap daerah di Indonesia memiliki alat musik tradisional yang berbeda-beda?',
            ],

            6 => [
                'Apa saja cara memainkan alat musik tradisional yang kamu pelajari hari ini?',
                'Dari alat musik yang dipukul, dipetik, digesek, dan ditiup, mana yang paling menarik bagimu? Jelaskan alasannya.',
                'Sebutkan satu alat musik tradisional yang cara memainkannya baru kamu ketahui.',
                'Mengapa cara memainkan alat musik dapat memengaruhi karakter bunyi yang dihasilkan?',
                'Jika kamu diberi kesempatan mempelajari satu alat musik tradisional, alat musik apa yang ingin kamu pelajari? Mengapa?',
            ],

            7 => [
                'Apa yang kamu pahami tentang pengelompokan alat musik berdasarkan sumber bunyinya?',
                'Apa perbedaan alat musik kordofon, aerofon, membranofon, dan idiofon yang kamu pahami?',
                'Alat musik apa yang menurutmu paling mudah untuk dikelompokkan? Jelaskan alasannya.',
                'Apa kesulitan yang kamu alami ketika mengelompokkan alat musik tradisional?',
                'Menurutmu, mengapa penting bagi kita mengetahui jenis dan sumber bunyi alat musik tradisional?',
            ],

            8 => [
                'Apa pengetahuan baru tentang alat musik tradisional yang paling berkesan bagimu selama pembelajaran?',
                'Dari seluruh alat musik tradisional yang telah dipelajari, alat musik mana yang paling kamu sukai? Jelaskan alasannya.',
                'Menurutmu, apa yang akan terjadi jika generasi muda tidak mau mempelajari alat musik tradisional?',
                'Apa yang dapat kamu lakukan sebagai pelajar untuk membantu melestarikan alat musik tradisional Indonesia?',
                'Setelah mengikuti pembelajaran selama 8 pertemuan, apa perubahan pemahaman atau sikap yang kamu rasakan terhadap musik tradisional Indonesia?',
            ],
        };
    }
}