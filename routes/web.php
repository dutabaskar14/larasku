<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\StudentDashboardController;

use App\Http\Controllers\Guru\DashboardController;
use App\Http\Controllers\Guru\AttendanceController as GuruAttendanceController;
use App\Http\Controllers\Guru\StudentController;
use App\Http\Controllers\Guru\MaterialController;
use App\Http\Controllers\Guru\ClassController;
use App\Http\Controllers\Guru\ReflectionController as GuruReflectionController;
use App\Http\Controllers\Guru\LKPDController as GuruLKPDController;
use App\Http\Controllers\Guru\VideoController as GuruVideoController;
use App\Http\Controllers\Guru\QuizController as GuruQuizController;
use App\Http\Controllers\Guru\QuizRankingController;
use App\Http\Controllers\Guru\GameController as GuruGameController;

use App\Http\Controllers\MaterialControllerSiswa;
use App\Http\Controllers\ReflectionControllerSiswa;
use App\Http\Controllers\LKPDControllerSiswa;
use App\Http\Controllers\VideoControllerSiswa;
use App\Http\Controllers\QuizControllerSiswa;

use App\Models\Game;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| HALAMAN SISWA
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| DASHBOARD SISWA
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [
    StudentDashboardController::class,
    'index',
])->name('student.dashboard');


/*
|--------------------------------------------------------------------------
| HALAMAN AWAL / ABSENSI
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('attendance.index');
});

Route::get('/absensi', [
    AttendanceController::class,
    'index',
])->name('attendance.index');

Route::post('/absensi', [
    AttendanceController::class,
    'store',
])->name('attendance.store');


/*
|--------------------------------------------------------------------------
| MATERI SISWA
|--------------------------------------------------------------------------
*/

Route::get('/materi', [
    MaterialControllerSiswa::class,
    'index',
])->name('materials.index');

Route::get('/materi/{material}', [
    MaterialControllerSiswa::class,
    'show',
])->name('materials.show');


/*
|--------------------------------------------------------------------------
| VIDEO SISWA
|--------------------------------------------------------------------------
*/

Route::get('/video', [
    VideoControllerSiswa::class,
    'index',
])->name('videos.index');


/*
|--------------------------------------------------------------------------
| REFLEKSI SISWA
|--------------------------------------------------------------------------
*/

Route::get('/refleksi', [
    ReflectionControllerSiswa::class,
    'index',
])->name('reflections.index');

Route::post('/refleksi', [
    ReflectionControllerSiswa::class,
    'store',
])->name('reflections.store');


/*
|--------------------------------------------------------------------------
| LKPD SISWA
|--------------------------------------------------------------------------
*/

Route::get('/lkpd', [
    LKPDControllerSiswa::class,
    'index',
])->name('lkpd.index');

Route::post('/lkpd', [
    LKPDControllerSiswa::class,
    'store',
])->name('lkpd.store');


/*
|--------------------------------------------------------------------------
| QUIZ SISWA
|--------------------------------------------------------------------------
*/

Route::get('/quiz', [
    QuizControllerSiswa::class,
    'index',
])->name('quiz.index');

Route::post('/quiz/{quiz}/submit', [
    QuizControllerSiswa::class,
    'submit',
])->name('quiz.submit');

Route::get('/quiz/{quiz}/hasil', [
    QuizControllerSiswa::class,
    'result',
])->name('quiz.result');


/*
|--------------------------------------------------------------------------
| GAME INTERAKTIF SISWA
|--------------------------------------------------------------------------
*/

Route::get('/game', function () {

    $game = Game::first();

    return view(
        'game.index',
        compact('game')
    );

})->name('game.index');


/*
|--------------------------------------------------------------------------
| PANEL GURU
|--------------------------------------------------------------------------
*/

Route::prefix('guru')
    ->name('guru.')
    ->group(function () {


        /*
        |--------------------------------------------------------------------------
        | DASHBOARD GURU
        |--------------------------------------------------------------------------
        */

        Route::get('/', [
            DashboardController::class,
            'index',
        ])->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | DATA SISWA
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'students',
            StudentController::class
        );


        /*
        |--------------------------------------------------------------------------
        | MANAJEMEN KELAS
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'classes',
            ClassController::class
        )->except([
            'show',
        ]);


        /*
|--------------------------------------------------------------------------
| ABSENSI GURU
|--------------------------------------------------------------------------
*/

Route::get('/attendance', [
    GuruAttendanceController::class,
    'index',
])->name('attendance.index');


Route::get('/attendance/rekap', [
    GuruAttendanceController::class,
    'rekap',
])->name('attendance.rekap');


/*
|--------------------------------------------------------------------------
| BUKA PERTEMUAN
|--------------------------------------------------------------------------
|
| Guru membuka pertemuan untuk kelas tertentu.
|
| Jika guru membuka Pertemuan 3:
|
| Pertemuan 1 = terbuka
| Pertemuan 2 = terbuka
| Pertemuan 3 = terbuka
| Pertemuan 4-8 = terkunci
|
*/

Route::post('/attendance/open-meeting', [
    GuruAttendanceController::class,
    'openMeeting',
])->name('attendance.open-meeting');


/*
|--------------------------------------------------------------------------
| SIMPAN ABSENSI
|--------------------------------------------------------------------------
*/

Route::post('/attendance', [
    GuruAttendanceController::class,
    'update',
])->name('attendance.update');

        /*
        |--------------------------------------------------------------------------
        | MATERI PEMBELAJARAN GURU
        |--------------------------------------------------------------------------
        */

        /*
        |--------------------------------------------------------------------------
        | Upload gambar untuk Rich Text Editor
        |--------------------------------------------------------------------------
        */

        Route::post('/materials/upload-image', [
            MaterialController::class,
            'uploadImage',
        ])->name('materials.upload-image');


        /*
        |--------------------------------------------------------------------------
        | CRUD Materi
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'materials',
            MaterialController::class
        );


        /*
        |--------------------------------------------------------------------------
        | VIDEO PEMBELAJARAN GURU
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'videos',
            GuruVideoController::class
        )->except([
            'show',
        ]);


        /*
        |--------------------------------------------------------------------------
        | QUIZ GURU
        |--------------------------------------------------------------------------
        */

        Route::get('/quizzes', [
            GuruQuizController::class,
            'index',
        ])->name('quizzes.index');

        Route::get('/quizzes/{quiz}', [
            GuruQuizController::class,
            'show',
        ])->name('quizzes.show');

        Route::get('/quizzes/{quiz}/edit', [
            GuruQuizController::class,
            'edit',
        ])->name('quizzes.edit');

        Route::put('/quizzes/{quiz}', [
            GuruQuizController::class,
            'update',
        ])->name('quizzes.update');


        /*
        |--------------------------------------------------------------------------
        | PERINGKAT SISWA
        |--------------------------------------------------------------------------
        |
        | Nilai Quiz    = 80%
        | Kehadiran     = 20%
        |
        */

        Route::get('/quiz-ranking', [
            QuizRankingController::class,
            'index',
        ])->name('quiz-ranking.index');


        /*
        |--------------------------------------------------------------------------
        | GAME INTERAKTIF GURU
        |--------------------------------------------------------------------------
        */

        Route::get('/games', [
            GuruGameController::class,
            'index',
        ])->name('games.index');

        Route::put('/games', [
            GuruGameController::class,
            'update',
        ])->name('games.update');


        /*
        |--------------------------------------------------------------------------
        | REKAP REFLEKSI GURU
        |--------------------------------------------------------------------------
        */

        Route::get('/reflections', [
            GuruReflectionController::class,
            'index',
        ])->name('reflections.index');

        Route::get('/reflections/{reflection}', [
            GuruReflectionController::class,
            'show',
        ])->name('reflections.show');


        /*
        |--------------------------------------------------------------------------
        | REKAP LKPD GURU
        |--------------------------------------------------------------------------
        */

        Route::get('/lkpd', [
            GuruLKPDController::class,
            'index',
        ])->name('lkpd.index');

        Route::get('/lkpd/{lkpd}', [
            GuruLKPDController::class,
            'show',
        ])->name('lkpd.show');

        Route::post('/lkpd/{lkpd}/approve', [
            GuruLKPDController::class,
            'approve',
        ])->name('lkpd.approve');

    });