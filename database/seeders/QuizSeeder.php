<?php

namespace Database\Seeders;

use App\Models\Quiz;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        $data = [

            /*
            |--------------------------------------------------------------------------
            | PERTEMUAN 1 — LAGU DAERAH
            |--------------------------------------------------------------------------
            */

            1 => [
                'judul' => 'Pertemuan 1 — Lagu Daerah',
                'deskripsi' => 'Evaluasi pembelajaran tentang lagu daerah.',
                'questions' => [
                    [
                        'pertanyaan' => 'Lagu daerah adalah lagu yang berkembang dan diwariskan dalam lingkungan masyarakat tertentu serta menjadi bagian dari budaya daerah tersebut. Ciri yang paling tepat adalah ...',
                        'opsi_a' => 'Berkembang dalam masyarakat daerah tertentu',
                        'opsi_b' => 'Hanya boleh dinyanyikan oleh penyanyi profesional',
                        'opsi_c' => 'Selalu diciptakan untuk pertunjukan modern',
                        'opsi_d' => 'Selalu menggunakan bahasa asing',
                        'jawaban_benar' => 'A',
                    ],
                    [
                        'pertanyaan' => 'Lagu daerah Jawa Barat yang menggunakan bahasa Sunda adalah ...',
                        'opsi_a' => 'Ampar-Ampar Pisang',
                        'opsi_b' => 'Apuse',
                        'opsi_c' => 'Bubuy Bulan',
                        'opsi_d' => 'Cublak-Cublak Suweng',
                        'jawaban_benar' => 'C',
                    ],
                    [
                        'pertanyaan' => 'Lagu Ampar-Ampar Pisang berasal dari daerah ...',
                        'opsi_a' => 'Sumatera Barat',
                        'opsi_b' => 'Kalimantan Selatan',
                        'opsi_c' => 'Sulawesi Utara',
                        'opsi_d' => 'Jawa Barat',
                        'jawaban_benar' => 'B',
                    ],
                    [
                        'pertanyaan' => 'Salah satu fungsi lagu daerah dalam kehidupan masyarakat adalah ...',
                        'opsi_a' => 'Membatasi interaksi antarmasyarakat',
                        'opsi_b' => 'Menggantikan seluruh jenis musik modern',
                        'opsi_c' => 'Menjadi bagian dari kegiatan budaya masyarakat',
                        'opsi_d' => 'Menghilangkan identitas suatu daerah',
                        'jawaban_benar' => 'C',
                    ],
                    [
                        'pertanyaan' => 'Lagu Apuse dikenal sebagai salah satu lagu daerah dari ...',
                        'opsi_a' => 'Kalimantan Barat',
                        'opsi_b' => 'Jawa Timur',
                        'opsi_c' => 'Papua',
                        'opsi_d' => 'Bali',
                        'jawaban_benar' => 'C',
                    ],
                ],
            ],


            /*
            |--------------------------------------------------------------------------
            | PERTEMUAN 2 — TEKNIK BERNYANYI
            |--------------------------------------------------------------------------
            */

            2 => [
                'judul' => 'Pertemuan 2 — Teknik Bernyanyi',
                'deskripsi' => 'Evaluasi pembelajaran tentang teknik dasar bernyanyi.',
                'questions' => [
                    [
                        'pertanyaan' => 'Teknik pernapasan yang paling mendukung pengendalian napas saat menyanyikan kalimat lagu yang panjang adalah ...',
                        'opsi_a' => 'Pernapasan diafragma',
                        'opsi_b' => 'Pernapasan pendek',
                        'opsi_c' => 'Pernapasan tidak teratur',
                        'opsi_d' => 'Pernapasan tersengal',
                        'jawaban_benar' => 'A',
                    ],
                    [
                        'pertanyaan' => 'Ketepatan tinggi rendahnya nada ketika bernyanyi disebut ...',
                        'opsi_a' => 'Artikulasi',
                        'opsi_b' => 'Frasering',
                        'opsi_c' => 'Resonansi',
                        'opsi_d' => 'Intonasi',
                        'jawaban_benar' => 'D',
                    ],
                    [
                        'pertanyaan' => 'Agar lirik lagu daerah terdengar jelas oleh pendengar, penyanyi perlu memperhatikan ...',
                        'opsi_a' => 'Artikulasi',
                        'opsi_b' => 'Tanda birama saja',
                        'opsi_c' => 'Tempo saja',
                        'opsi_d' => 'Dinamika saja',
                        'jawaban_benar' => 'A',
                    ],
                    [
                        'pertanyaan' => 'Pemenggalan kalimat lagu pada tempat yang tepat agar makna kalimat dan aliran lagu tetap baik disebut ...',
                        'opsi_a' => 'Artikulasi',
                        'opsi_b' => 'Timbre',
                        'opsi_c' => 'Intonasi',
                        'opsi_d' => 'Frasering',
                        'jawaban_benar' => 'D',
                    ],
                    [
                        'pertanyaan' => 'Jika seorang siswa menyanyikan nada terlalu tinggi atau terlalu rendah dari nada yang seharusnya, aspek yang perlu diperbaiki adalah ...',
                        'opsi_a' => 'Frasering',
                        'opsi_b' => 'Tempo',
                        'opsi_c' => 'Intonasi',
                        'opsi_d' => 'Artikulasi',
                        'jawaban_benar' => 'C',
                    ],
                ],
            ],


            /*
            |--------------------------------------------------------------------------
            | PERTEMUAN 3 — SUMBER BUNYI
            |--------------------------------------------------------------------------
            */

            3 => [
                'judul' => 'Pertemuan 3 — Sumber Bunyi',
                'deskripsi' => 'Evaluasi pembelajaran tentang sumber bunyi alat musik tradisional.',
                'questions' => [
                    [
                        'pertanyaan' => 'Alat musik yang sumber bunyinya berasal dari getaran senar atau dawai termasuk kelompok ...',
                        'opsi_a' => 'Aerofon',
                        'opsi_b' => 'Kordofon',
                        'opsi_c' => 'Membranofon',
                        'opsi_d' => 'Idiofon',
                        'jawaban_benar' => 'B',
                    ],
                    [
                        'pertanyaan' => 'Kelompok alat musik yang sumber bunyinya berasal dari getaran udara disebut ...',
                        'opsi_a' => 'Kordofon',
                        'opsi_b' => 'Aerofon',
                        'opsi_c' => 'Idiofon',
                        'opsi_d' => 'Membranofon',
                        'jawaban_benar' => 'B',
                    ],
                    [
                        'pertanyaan' => 'Kendang termasuk kelompok membranofon karena ...',
                        'opsi_a' => 'Bunyinya berasal dari getaran membran',
                        'opsi_b' => 'Bunyinya berasal dari aliran udara',
                        'opsi_c' => 'Bunyinya berasal dari getaran senar',
                        'opsi_d' => 'Bunyinya berasal dari getaran logam yang ditiup',
                        'jawaban_benar' => 'A',
                    ],
                    [
                        'pertanyaan' => 'Angklung termasuk kelompok idiofon karena sumber bunyinya berasal dari ...',
                        'opsi_a' => 'Getaran membran',
                        'opsi_b' => 'Getaran senar',
                        'opsi_c' => 'Getaran badan alat musik',
                        'opsi_d' => 'Getaran udara dalam pipa tiup',
                        'jawaban_benar' => 'C',
                    ],
                    [
                        'pertanyaan' => 'Sasando termasuk kordofon karena ...',
                        'opsi_a' => 'Menggunakan badan alat yang dipukul',
                        'opsi_b' => 'Menggunakan membran sebagai sumber bunyi',
                        'opsi_c' => 'Menggunakan udara sebagai sumber bunyi utama',
                        'opsi_d' => 'Menggunakan senar sebagai sumber bunyi',
                        'jawaban_benar' => 'D',
                    ],
                ],
            ],


            /*
            |--------------------------------------------------------------------------
            | PERTEMUAN 4 — CARA MEMAINKAN ALAT MUSIK
            |--------------------------------------------------------------------------
            */

            4 => [
                'judul' => 'Pertemuan 4 — Cara Memainkan Alat Musik',
                'deskripsi' => 'Evaluasi pembelajaran tentang cara memainkan alat musik tradisional.',
                'questions' => [
                    [
                        'pertanyaan' => 'Alat musik yang dimainkan dengan cara dipukul adalah ...',
                        'opsi_a' => 'Saluang',
                        'opsi_b' => 'Sasando',
                        'opsi_c' => 'Kendang',
                        'opsi_d' => 'Rebab',
                        'jawaban_benar' => 'C',
                    ],
                    [
                        'pertanyaan' => 'Sasando merupakan alat musik tradisional yang dimainkan dengan cara ...',
                        'opsi_a' => 'Ditiup',
                        'opsi_b' => 'Dipetik',
                        'opsi_c' => 'Digesek',
                        'opsi_d' => 'Dipukul',
                        'jawaban_benar' => 'B',
                    ],
                    [
                        'pertanyaan' => 'Rebab merupakan alat musik tradisional yang dimainkan dengan cara ...',
                        'opsi_a' => 'Digesek',
                        'opsi_b' => 'Dipukul',
                        'opsi_c' => 'Dipetik',
                        'opsi_d' => 'Ditiup',
                        'jawaban_benar' => 'A',
                    ],
                    [
                        'pertanyaan' => 'Saluang merupakan alat musik tradisional Minangkabau yang dimainkan dengan cara ...',
                        'opsi_a' => 'Ditiup',
                        'opsi_b' => 'Dipetik',
                        'opsi_c' => 'Dipukul',
                        'opsi_d' => 'Digesek',
                        'jawaban_benar' => 'A',
                    ],
                    [
                        'pertanyaan' => 'Angklung dimainkan dengan cara digoyangkan atau digetarkan. Berdasarkan cara memainkannya, angklung termasuk alat musik yang ...',
                        'opsi_a' => 'Ditiup',
                        'opsi_b' => 'Dipetik',
                        'opsi_c' => 'Digesek',
                        'opsi_d' => 'Digoyangkan',
                        'jawaban_benar' => 'D',
                    ],
                ],
            ],


            /*
            |--------------------------------------------------------------------------
            | PERTEMUAN 5 — ALAT MUSIK TRADISIONAL INDONESIA
            |--------------------------------------------------------------------------
            */

            5 => [
                'judul' => 'Pertemuan 5 — Alat Musik Tradisional Indonesia',
                'deskripsi' => 'Evaluasi pembelajaran tentang alat musik tradisional Indonesia.',
                'questions' => [
                    [
                        'pertanyaan' => 'Angklung merupakan alat musik tradisional yang berasal dari ...',
                        'opsi_a' => 'Nusa Tenggara Timur',
                        'opsi_b' => 'Papua',
                        'opsi_c' => 'Jawa Barat',
                        'opsi_d' => 'Sumatera Barat',
                        'jawaban_benar' => 'C',
                    ],
                    [
                        'pertanyaan' => 'Sasando merupakan alat musik tradisional yang berasal dari ...',
                        'opsi_a' => 'Nusa Tenggara Timur',
                        'opsi_b' => 'Sulawesi Utara',
                        'opsi_c' => 'Kalimantan Selatan',
                        'opsi_d' => 'Jawa Tengah',
                        'jawaban_benar' => 'A',
                    ],
                    [
                        'pertanyaan' => 'Kolintang merupakan alat musik tradisional yang berasal dari ...',
                        'opsi_a' => 'Sulawesi Utara',
                        'opsi_b' => 'Sumatera Selatan',
                        'opsi_c' => 'Bali',
                        'opsi_d' => 'Jawa Barat',
                        'jawaban_benar' => 'A',
                    ],
                    [
                        'pertanyaan' => 'Tifa merupakan alat musik tradisional yang banyak dikenal berasal dari wilayah ...',
                        'opsi_a' => 'Papua dan Maluku',
                        'opsi_b' => 'Sumatera Barat dan Riau',
                        'opsi_c' => 'Jawa Barat dan Banten',
                        'opsi_d' => 'Bali dan Lombok',
                        'jawaban_benar' => 'A',
                    ],
                    [
                        'pertanyaan' => 'Talempong merupakan alat musik tradisional yang berasal dari ...',
                        'opsi_a' => 'Papua',
                        'opsi_b' => 'Sumatera Barat',
                        'opsi_c' => 'Jawa Timur',
                        'opsi_d' => 'Kalimantan Timur',
                        'jawaban_benar' => 'B',
                    ],
                ],
            ],


            /*
            |--------------------------------------------------------------------------
            | PERTEMUAN 6 — FUNGSI MUSIK TRADISIONAL
            |--------------------------------------------------------------------------
            */

            6 => [
                'judul' => 'Pertemuan 6 — Fungsi Musik Tradisional',
                'deskripsi' => 'Evaluasi pembelajaran tentang fungsi musik tradisional.',
                'questions' => [
                    [
                        'pertanyaan' => 'Salah satu fungsi utama musik tradisional dalam upacara adat adalah ...',
                        'opsi_a' => 'Menggantikan semua kegiatan masyarakat',
                        'opsi_b' => 'Sebagai pengganti bahasa daerah',
                        'opsi_c' => 'Sebagai alat komunikasi digital',
                        'opsi_d' => 'Sebagai bagian dari rangkaian kegiatan adat',
                        'jawaban_benar' => 'D',
                    ],
                    [
                        'pertanyaan' => 'Musik tradisional yang digunakan untuk menemani masyarakat bersantai atau menikmati pertunjukan memiliki fungsi sebagai ...',
                        'opsi_a' => 'Alat ukur',
                        'opsi_b' => 'Upacara wajib',
                        'opsi_c' => 'Alat transportasi',
                        'opsi_d' => 'Hiburan',
                        'jawaban_benar' => 'D',
                    ],
                    [
                        'pertanyaan' => 'Musik tradisional yang dimainkan untuk mengiringi suatu tarian memiliki fungsi sebagai ...',
                        'opsi_a' => 'Pengganti gerakan tari',
                        'opsi_b' => 'Pengiring tari',
                        'opsi_c' => 'Pengganti kostum',
                        'opsi_d' => 'Alat komunikasi tertulis',
                        'jawaban_benar' => 'B',
                    ],
                    [
                        'pertanyaan' => 'Musik tradisional dapat menjadi identitas budaya karena ...',
                        'opsi_a' => 'Selalu menggunakan alat musik modern',
                        'opsi_b' => 'Hanya dimainkan di luar negeri',
                        'opsi_c' => 'Mencerminkan karakter dan budaya masyarakat suatu daerah',
                        'opsi_d' => 'Tidak memiliki hubungan dengan masyarakat',
                        'jawaban_benar' => 'C',
                    ],
                    [
                        'pertanyaan' => 'Salah satu manfaat mempelajari musik tradisional bagi generasi muda adalah ...',
                        'opsi_a' => 'Menghindari kegiatan seni',
                        'opsi_b' => 'Menghilangkan budaya daerah',
                        'opsi_c' => 'Membatasi kreativitas',
                        'opsi_d' => 'Melestarikan dan mengenal budaya daerah',
                        'jawaban_benar' => 'D',
                    ],
                ],
            ],


            /*
            |--------------------------------------------------------------------------
            | PERTEMUAN 7 — ANSAMBEL MUSIK TRADISIONAL
            |--------------------------------------------------------------------------
            */

            7 => [
                'judul' => 'Pertemuan 7 — Ansambel Musik Tradisional',
                'deskripsi' => 'Evaluasi pembelajaran tentang ansambel musik tradisional.',
                'questions' => [
                    [
                        'pertanyaan' => 'Permainan musik yang dilakukan secara bersama-sama dengan menggunakan beberapa alat musik disebut ...',
                        'opsi_a' => 'Unisono',
                        'opsi_b' => 'Ansambel',
                        'opsi_c' => 'Solo',
                        'opsi_d' => 'Improvisasi',
                        'jawaban_benar' => 'B',
                    ],
                    [
                        'pertanyaan' => 'Ansambel yang menggunakan alat musik yang sejenis disebut ...',
                        'opsi_a' => 'Ansambel vokal',
                        'opsi_b' => 'Ansambel campuran',
                        'opsi_c' => 'Ansambel tunggal',
                        'opsi_d' => 'Ansambel sejenis',
                        'jawaban_benar' => 'D',
                    ],
                    [
                        'pertanyaan' => 'Jika dalam sebuah kelompok musik terdapat kendang, gong, saron, dan bonang dengan karakter bunyi berbeda, kelompok tersebut dapat disebut ...',
                        'opsi_a' => 'Ansambel sejenis',
                        'opsi_b' => 'Ansambel campuran',
                        'opsi_c' => 'Duet',
                        'opsi_d' => 'Solo',
                        'jawaban_benar' => 'B',
                    ],
                    [
                        'pertanyaan' => 'Dalam permainan ansambel, sikap yang paling penting agar permainan terdengar kompak adalah ...',
                        'opsi_a' => 'Kerja sama dan saling mendengarkan',
                        'opsi_b' => 'Bermain dengan tempo masing-masing',
                        'opsi_c' => 'Bermain sekeras mungkin',
                        'opsi_d' => 'Mengabaikan pemain lain',
                        'jawaban_benar' => 'A',
                    ],
                    [
                        'pertanyaan' => 'Dalam sebuah ansambel musik tradisional, alat musik ritmis terutama berfungsi untuk ...',
                        'opsi_a' => 'Mengatur atau memperkuat irama',
                        'opsi_b' => 'Menyanyikan lirik lagu',
                        'opsi_c' => 'Menentukan asal daerah lagu',
                        'opsi_d' => 'Mengubah alat musik menjadi vocal',
                        'jawaban_benar' => 'A',
                    ],
                ],
            ],


            /*
            |--------------------------------------------------------------------------
            | PERTEMUAN 8 — EVALUASI AKHIR
            |--------------------------------------------------------------------------
            */

            8 => [
                'judul' => 'Pertemuan 8 — Evaluasi Akhir',
                'deskripsi' => 'Evaluasi akhir pembelajaran musik tradisional.',
                'questions' => [
                    [
                        'pertanyaan' => 'Teknik bernyanyi yang berkaitan dengan ketepatan tinggi rendah nada disebut ...',
                        'opsi_a' => 'Artikulasi',
                        'opsi_b' => 'Frasering',
                        'opsi_c' => 'Dinamika',
                        'opsi_d' => 'Intonasi',
                        'jawaban_benar' => 'D',
                    ],
                    [
                        'pertanyaan' => 'Alat musik tradisional yang dimainkan dengan cara dipetik adalah ...',
                        'opsi_a' => 'Saluang',
                        'opsi_b' => 'Rebab',
                        'opsi_c' => 'Kendang',
                        'opsi_d' => 'Sasando',
                        'jawaban_benar' => 'D',
                    ],
                    [
                        'pertanyaan' => 'Pasangan alat musik dan daerah asal yang tepat adalah ...',
                        'opsi_a' => 'Kolintang — Papua',
                        'opsi_b' => 'Angklung — Jawa Barat',
                        'opsi_c' => 'Sasando — Sumatera Barat',
                        'opsi_d' => 'Talempong — Jawa Tengah',
                        'jawaban_benar' => 'B',
                    ],
                    [
                        'pertanyaan' => 'Fungsi musik tradisional yang berkaitan dengan pelaksanaan ritual atau kegiatan adat adalah ...',
                        'opsi_a' => 'Sarana upacara atau adat',
                        'opsi_b' => 'Sarana perdagangan',
                        'opsi_c' => 'Sarana transportasi',
                        'opsi_d' => 'Sarana pengukuran',
                        'jawaban_benar' => 'A',
                    ],
                    [
                        'pertanyaan' => 'Manakah pernyataan yang paling tepat tentang musik tradisional?',
                        'opsi_a' => 'Musik tradisional merupakan bagian dari budaya masyarakat dan diwariskan antargenerasi',
                        'opsi_b' => 'Musik tradisional tidak memiliki fungsi dalam kehidupan masyarakat',
                        'opsi_c' => 'Musik tradisional hanya boleh dimainkan menggunakan alat musik modern',
                        'opsi_d' => 'Musik tradisional hanya digunakan sebagai hiburan',
                        'jawaban_benar' => 'A',
                    ],
                ],
            ],
        ];


        foreach ($data as $pertemuan => $quizData) {

            $quiz = Quiz::updateOrCreate(
                [
                    'pertemuan' => $pertemuan,
                ],
                [
                    'judul' => $quizData['judul'],
                    'deskripsi' => $quizData['deskripsi'],
                    'aktif' => true,
                ]
            );


            foreach ($quizData['questions'] as $index => $question) {

                $quiz->questions()->updateOrCreate(
                    [
                        'urutan' => $index + 1,
                    ],
                    [
                        'pertanyaan' => $question['pertanyaan'],
                        'opsi_a' => $question['opsi_a'],
                        'opsi_b' => $question['opsi_b'],
                        'opsi_c' => $question['opsi_c'],
                        'opsi_d' => $question['opsi_d'],
                        'jawaban_benar' => $question['jawaban_benar'],
                    ]
                );
            }
        }
    }
}