<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizMeetingAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizMeetingAdminController extends Controller
{
    /**
     * Tambah pertemuan Quiz.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pertemuan' => [
                'required',
                'integer',
                'min:1',
                'max:255',
                'unique:quiz_meetings,pertemuan',
            ],
        ], [
            'pertemuan.required' =>
                'Nomor pertemuan wajib diisi.',

            'pertemuan.integer' =>
                'Nomor pertemuan harus berupa angka.',

            'pertemuan.min' =>
                'Nomor pertemuan minimal adalah 1.',

            'pertemuan.unique' =>
                'Pertemuan tersebut sudah tersedia.',
        ]);

        $meeting = QuizMeetingAdmin::create([
            'pertemuan' => $validated['pertemuan'],
        ]);

        return redirect()
            ->route('guru.quizzes.create', [
                'pertemuan' => $meeting->pertemuan,
            ])
            ->with(
                'success',
                "Pertemuan {$meeting->pertemuan} berhasil ditambahkan."
            );
    }


    /**
     * Hapus SATU pertemuan Quiz.
     *
     * Hanya menghapus:
     * - pertemuan yang dipilih
     * - Quiz pada pertemuan tersebut
     * - soal Quiz melalui cascade
     * - hasil pengerjaan siswa melalui cascade
     *
     * Pertemuan Quiz lainnya tidak disentuh.
     * Material tidak disentuh.
     */
    public function destroy(
        QuizMeetingAdmin $quizMeetingAdmin
    ) {
        $pertemuan = (int) $quizMeetingAdmin->pertemuan;

        DB::transaction(function () use (
            $quizMeetingAdmin,
            $pertemuan
        ) {

            /*
            |--------------------------------------------------------------------------
            | HAPUS QUIZ PADA PERTEMUAN INI SAJA
            |--------------------------------------------------------------------------
            */

            Quiz::query()
                ->where('pertemuan', $pertemuan)
                ->delete();


            /*
            |--------------------------------------------------------------------------
            | HAPUS MEETING YANG DIPILIH SAJA
            |--------------------------------------------------------------------------
            */

            $quizMeetingAdmin->delete();
        });

        return redirect()
            ->route('guru.quizzes.index')
            ->with(
                'success',
                "Pertemuan {$pertemuan} dan seluruh data Quiz-nya berhasil dihapus."
            );
    }
}