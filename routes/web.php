<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\StudentDashboardController;

use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\Guru\DashboardController;
use App\Http\Controllers\Guru\AttendanceController as GuruAttendanceController;
use App\Http\Controllers\Guru\StudentController;
use App\Http\Controllers\Guru\MaterialController;
use App\Http\Controllers\Guru\MaterialMeetingController;
use App\Http\Controllers\Guru\ClassController;
use App\Http\Controllers\Guru\ReflectionController as GuruReflectionController;
use App\Http\Controllers\Guru\ReflectionMeetingController;
use App\Http\Controllers\Guru\LKPDController as GuruLKPDController;
use App\Http\Controllers\Guru\VideoController as GuruVideoController;
use App\Http\Controllers\Guru\VideoMeetingAdminController;
use App\Http\Controllers\Guru\QuizController as GuruQuizController;
use App\Http\Controllers\Guru\QuizMeetingAdminController;
use App\Http\Controllers\Guru\QuizRankingController;
use App\Http\Controllers\Guru\GameController as GuruGameController;
use App\Http\Controllers\Guru\AssignmentController;
use App\Http\Controllers\Guru\AssignmentGroupController;
use App\Http\Controllers\Guru\AssignmentSubmissionController;
use App\Http\Controllers\Guru\AssignmentMeetingController;
use App\Http\Controllers\Guru\ExportController;

use App\Http\Controllers\MaterialControllerSiswa;
use App\Http\Controllers\ReflectionControllerSiswa;
use App\Http\Controllers\LKPDControllerSiswa;
use App\Http\Controllers\VideoControllerSiswa;
use App\Http\Controllers\QuizControllerSiswa;
use App\Http\Controllers\AssignmentControllerSiswa;
use App\Http\Controllers\QuizRankingControllerSiswa;

use App\Models\Game;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| HALAMAN SISWA
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [
    StudentDashboardController::class,
    'index',
])->name('student.dashboard');


Route::get('/', function () {
    return view('welcome');
})->name('home');


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
| RANKING SISWA
|--------------------------------------------------------------------------
*/

Route::get('/ranking', [
    QuizRankingControllerSiswa::class,
    'index',
])->name('student.ranking.index');


/*
|--------------------------------------------------------------------------
| AUTHENTICATION GURU
|--------------------------------------------------------------------------
*/

Route::get('/login', [
    LoginController::class,
    'showLoginForm',
])->name('login');


Route::post('/login', [
    LoginController::class,
    'login',
])->name('login.submit');


Route::post('/logout', [
    LoginController::class,
    'logout',
])->name('logout');


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
| TUGAS PRAKTIK SISWA
|--------------------------------------------------------------------------
*/

Route::get('/assignments', [
    AssignmentControllerSiswa::class,
    'index',
])->name('assignments.index');


Route::post('/assignments/{assignment}/submit', [
    AssignmentControllerSiswa::class,
    'submit',
])->name('assignments.submit');


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
    ->middleware('auth')
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
        | EXPORT EXCEL
        |--------------------------------------------------------------------------
        */

        Route::get('/exports', [
            ExportController::class,
            'index',
        ])->name('exports.index');


        Route::get('/exports/students', [
            ExportController::class,
            'students',
        ])->name('exports.students');

        /*
        |--------------------------------------------------------------------------
        | EXPORT ABSENSI
        |--------------------------------------------------------------------------
        */

        Route::get('/exports/attendance', [
            ExportController::class,
            'attendance',
        ])->name('exports.attendance');

        /*
        |--------------------------------------------------------------------------
        | ⭐ EXPORT NILAI AKHIR
        |--------------------------------------------------------------------------
        */

        Route::get('/exports/final-grades', [
            ExportController::class,
            'finalGrades',
        ])->name('exports.final-grades');

        /*
        |--------------------------------------------------------------------------
        | ⭐ EXPORT NILAI LKPD
        |--------------------------------------------------------------------------
        */

        Route::get('/exports/lkpd', [
            ExportController::class,
            'lkpd',
        ])->name('exports.lkpd');

        /*
        |--------------------------------------------------------------------------
        | ⭐ EXPORT NILAI QUIZ
        |--------------------------------------------------------------------------
        */

        Route::get('/exports/quiz', [
            ExportController::class,
            'quiz',
        ])->name('exports.quiz');

        /*
        |--------------------------------------------------------------------------
        | ⭐ EXPORT NILAI PRAKTIK
        |--------------------------------------------------------------------------
        */

        Route::get('/exports/practice', [
            ExportController::class,
            'practice',
        ])->name('exports.practice');

        /*
        |--------------------------------------------------------------------------
        | EXPORT NILAI REFLEKSI
        |--------------------------------------------------------------------------
        */

        Route::get('/exports/reflection', [
            ExportController::class,
            'reflection',
        ])->name('exports.reflection');

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


        Route::post('/attendance/open-meeting', [
            GuruAttendanceController::class,
            'openMeeting',
        ])->name('attendance.open-meeting');


        Route::post('/attendance', [
            GuruAttendanceController::class,
            'update',
        ])->name('attendance.update');


        /*
        |--------------------------------------------------------------------------
        | MATERI PEMBELAJARAN GURU
        |--------------------------------------------------------------------------
        */

        Route::post('/materials/upload-image', [
            MaterialController::class,
            'uploadImage',
        ])->name('materials.upload-image');


        /*
        |--------------------------------------------------------------------------
        | MATERIAL MEETINGS
        |--------------------------------------------------------------------------
        */

        Route::post('/materials/meetings', [
            MaterialMeetingController::class,
            'store',
        ])->name('materials.meetings.store');


        Route::patch('/materials/meetings/{materialMeeting}/toggle', [
            MaterialMeetingController::class,
            'toggle',
        ])->name('materials.meetings.toggle');


        Route::delete('/materials/meetings/{materialMeeting}', [
            MaterialMeetingController::class,
            'destroy',
        ])->name('materials.meetings.destroy');


        /*
        |--------------------------------------------------------------------------
        | CRUD MATERI
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
        | PERTEMUAN VIDEO GURU
        |--------------------------------------------------------------------------
        */

        Route::post('/videos/meetings', [
            VideoMeetingAdminController::class,
            'store',
        ])->name('videos.meetings.store');


        Route::delete('/videos/meetings/{videoMeetingAdmin}', [
            VideoMeetingAdminController::class,
            'destroy',
        ])->name('videos.meetings.destroy');


        Route::patch('/videos/meetings/{videoMeetingAdmin}/toggle', [
            VideoMeetingAdminController::class,
            'toggle',
        ])->name('videos.meetings.toggle');


        /*
        |--------------------------------------------------------------------------
        | QUIZ GURU
        |--------------------------------------------------------------------------
        */

        Route::get('/quizzes', [
            GuruQuizController::class,
            'index',
        ])->name('quizzes.index');


        Route::get('/quizzes/create', [
            GuruQuizController::class,
            'create',
        ])->name('quizzes.create');


        Route::post('/quizzes', [
            GuruQuizController::class,
            'store',
        ])->name('quizzes.store');


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
        | PERTEMUAN QUIZ GURU
        |--------------------------------------------------------------------------
        */

        Route::post('/quizzes/meetings', [
            QuizMeetingAdminController::class,
            'store',
        ])->name('quizzes.meetings.store');


        Route::delete('/quizzes/meetings/{quizMeetingAdmin}', [
            QuizMeetingAdminController::class,
            'destroy',
        ])->name('quizzes.meetings.destroy');


        /*
        |--------------------------------------------------------------------------
        | PERINGKAT SISWA
        |--------------------------------------------------------------------------
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
        | TUGAS PENGUMPULAN GURU
        |--------------------------------------------------------------------------
        */

        Route::get('/assignments/create', [
            AssignmentController::class,
            'create',
        ])->name('assignments.create');


        Route::get('/assignments/{assignment}/edit', [
            AssignmentController::class,
            'edit',
        ])->name('assignments.edit');


        Route::resource(
            'assignments',
            AssignmentController::class
        )->except([
            'create',
            'edit',
        ]);


        /*
        |--------------------------------------------------------------------------
        | PERTEMUAN TUGAS GURU
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/assignments-meetings',
            [
                AssignmentMeetingController::class,
                'index',
            ]
        )->name('assignments.meetings.index');


        Route::post(
            '/assignments-meetings',
            [
                AssignmentMeetingController::class,
                'store',
            ]
        )->name('assignments.meetings.store');


        Route::patch(
            '/assignments-meetings/{assignmentMeeting}/toggle',
            [
                AssignmentMeetingController::class,
                'toggle',
            ]
        )->name('assignments.meetings.toggle');


        Route::delete(
            '/assignments-meetings/{assignmentMeeting}',
            [
                AssignmentMeetingController::class,
                'destroy',
            ]
        )->name('assignments.meetings.destroy');


        /*
        |--------------------------------------------------------------------------
        | AKTIF / NONAKTIF TUGAS
        |--------------------------------------------------------------------------
        */

        Route::patch('/assignments/{assignment}/toggle', [
            AssignmentController::class,
            'toggle',
        ])->name('assignments.toggle');


        /*
        |--------------------------------------------------------------------------
        | CARI SISWA UNTUK ANGGOTA KELOMPOK
        |--------------------------------------------------------------------------
        */

        Route::get('/assignments/{assignment}/students/search', [
            AssignmentController::class,
            'searchStudents',
        ])->name('assignments.students.search');


        /*
        |--------------------------------------------------------------------------
        | KELOMPOK TUGAS
        |--------------------------------------------------------------------------
        */

        Route::post('/assignments/{assignment}/groups', [
            AssignmentGroupController::class,
            'store',
        ])->name('assignments.groups.store');


        Route::delete('/assignments/{assignment}/groups/{group}', [
            AssignmentGroupController::class,
            'destroy',
        ])->name('assignments.groups.destroy');


        /*
        |--------------------------------------------------------------------------
        | ANGGOTA KELOMPOK
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/assignments/{assignment}/groups/{group}/members',
            [
                AssignmentGroupController::class,
                'addMember',
            ]
        )->name('assignments.groups.members.store');


        Route::post(
            '/assignments/{assignment}/groups/{group}/members/bulk',
            [
                AssignmentGroupController::class,
                'addMembers',
            ]
        )->name('assignments.groups.members.bulk');


        Route::delete(
            '/assignments/{assignment}/groups/{group}/members/{member}',
            [
                AssignmentGroupController::class,
                'removeMember',
            ]
        )->name('assignments.groups.members.destroy');


        /*
        |--------------------------------------------------------------------------
        | PENGUMPULAN TUGAS
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/assignments/{assignment}/submissions',
            [
                AssignmentSubmissionController::class,
                'index',
            ]
        )->name('assignments.submissions.index');


        Route::get(
            '/assignments/{assignment}/submissions/{submission}',
            [
                AssignmentSubmissionController::class,
                'show',
            ]
        )->name('assignments.submissions.show');


        /*
        |--------------------------------------------------------------------------
        | PENILAIAN
        |--------------------------------------------------------------------------
        */

        Route::patch(
            '/assignments/{assignment}/submissions/{submission}/grade',
            [
                AssignmentSubmissionController::class,
                'grade',
            ]
        )->name('assignments.submissions.grade');


        Route::patch(
            '/assignments/{assignment}/submissions/{submission}/complete',
            [
                AssignmentSubmissionController::class,
                'complete',
            ]
        )->name('assignments.submissions.complete');


        Route::delete(
            '/assignments/{assignment}/submissions/{submission}',
            [
                AssignmentSubmissionController::class,
                'destroy',
            ]
        )->name('assignments.submissions.destroy');


        /*
        |--------------------------------------------------------------------------
        | REFLEKSI GURU
        |--------------------------------------------------------------------------
        */

        Route::get('/reflections', [
            GuruReflectionController::class,
            'index',
        ])->name('reflections.index');


        Route::get('/reflections/create', [
            GuruReflectionController::class,
            'create',
        ])->name('reflections.create');


        Route::post('/reflections', [
            GuruReflectionController::class,
            'store',
        ])->name('reflections.store');


        Route::get('/reflections/{reflection}', [
            GuruReflectionController::class,
            'show',
        ])->name('reflections.show');


        Route::get('/reflections/{reflection}/edit', [
            GuruReflectionController::class,
            'edit',
        ])->name('reflections.edit');


        Route::put('/reflections/{reflection}', [
            GuruReflectionController::class,
            'update',
        ])->name('reflections.update');


        /*
        |--------------------------------------------------------------------------
        | HAPUS REFLEKSI
        |--------------------------------------------------------------------------
        */

        Route::delete('/reflections/{reflection}', [
            GuruReflectionController::class,
            'destroy',
        ])->name('reflections.destroy');


        /*
        |--------------------------------------------------------------------------
        | PENILAIAN REFLEKSI
        |--------------------------------------------------------------------------
        */

        Route::post('/reflections/{reflection}/grade', [
            GuruReflectionController::class,
            'grade',
        ])->name('reflections.grade');


        /*
        |--------------------------------------------------------------------------
        | PERTEMUAN REFLEKSI GURU
        |--------------------------------------------------------------------------
        */

        Route::post('/reflections/meetings', [
            ReflectionMeetingController::class,
            'store',
        ])->name('reflections.meetings.store');


        Route::delete('/reflections/meetings/{reflectionMeeting}', [
            ReflectionMeetingController::class,
            'destroy',
        ])->name('reflections.meetings.destroy');


        /*
        |--------------------------------------------------------------------------
        | LKPD GURU
        |--------------------------------------------------------------------------
        */

        Route::get('/lkpd', [
            GuruLKPDController::class,
            'index',
        ])->name('lkpd.index');


        Route::get('/lkpd/create', [
            GuruLKPDController::class,
            'create',
        ])->name('lkpd.create');


        Route::post('/lkpd', [
            GuruLKPDController::class,
            'store',
        ])->name('lkpd.store');


        Route::get('/lkpd/{lkpd}', [
            GuruLKPDController::class,
            'show',
        ])->name('lkpd.show');


        Route::get('/lkpd/{lkpd}/edit', [
            GuruLKPDController::class,
            'edit',
        ])->name('lkpd.edit');


        Route::put('/lkpd/{lkpd}', [
            GuruLKPDController::class,
            'update',
        ])->name('lkpd.update');


        Route::post('/lkpd/{lkpd}/grade', [
            GuruLKPDController::class,
            'grade',
        ])->name('lkpd.grade');


        Route::post('/lkpd/{lkpd}/finalize', [
            GuruLKPDController::class,
            'finalize',
        ])->name('lkpd.finalize');


        Route::delete('/lkpd/{lkpd}', [
            GuruLKPDController::class,
            'destroy',
        ])->name('lkpd.destroy');

    });