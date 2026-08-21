<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Guru\QuizRankingController as GuruQuizRankingController;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QuizRankingControllerSiswa extends Controller
{
    /**
     * Menampilkan ranking siswa.
     *
     * PENTING:
     * Ranking siswa menggunakan kalkulasi yang sama persis
     * dengan ranking Guru agar:
     *
     * - bobot nilai sama
     * - sumber database sama
     * - status kelengkapan sama
     * - urutan ranking sama
     * - filter kelas sama
     *
     * Data dihitung oleh QuizRankingController Guru,
     * kemudian hanya view-nya yang diganti menjadi view siswa.
     */
    public function index(Request $request): View
    {
        /*
        |--------------------------------------------------------------------------
        | GUNAKAN ENGINE RANKING GURU
        |--------------------------------------------------------------------------
        */

        $guruRankingController =
            app(GuruQuizRankingController::class);


        $guruView =
            $guruRankingController->index($request);


        /*
        |--------------------------------------------------------------------------
        | AMBIL DATA YANG SUDAH DIHITUNG
        |--------------------------------------------------------------------------
        |
        | Tidak menghitung ulang ranking di sini.
        | Dengan cara ini ranking Guru dan Siswa benar-benar sama.
        |
        */

        $data =
            $guruView->getData();


        /*
        |--------------------------------------------------------------------------
        | VIEW SISWA
        |--------------------------------------------------------------------------
        */

        return view(
            'student.ranking.index',
            $data
        );
    }
}
