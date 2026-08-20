<?php

namespace App\Http\Controllers\Guru;

use App\Exports\AttendanceExport;
use App\Exports\FinalGradesExport;
use App\Exports\LKPDExport;
use App\Exports\PracticeExport;
use App\Exports\QuizExport;
use App\Exports\ReflectionExport;
use App\Exports\StudentsExport;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportController extends Controller
{
    /**
     * Menampilkan halaman Export Excel.
     */
    public function index(): View
    {
        $kelas = Student::query()
            ->whereNotNull('kelas')
            ->where('kelas', '!=', '')
            ->select('kelas')
            ->distinct()
            ->orderBy('kelas')
            ->pluck('kelas');

        $pertemuans = Attendance::query()
            ->whereNotNull('pertemuan')
            ->select('pertemuan')
            ->distinct()
            ->orderBy('pertemuan')
            ->pluck('pertemuan');

        return view(
            'guru.exports.index',
            compact(
                'kelas',
                'pertemuans'
            )
        );
    }


    /**
     * Export data siswa berdasarkan kelas.
     */
    public function students(
        Request $request
    ): BinaryFileResponse {
        $validated = $request->validate([
            'kelas' => [
                'nullable',
                'string',
                'max:100',
            ],
        ]);

        $kelas = $validated['kelas'] ?? null;

        if ($kelas) {

            $namaKelas = str_replace(
                ' ',
                '-',
                strtolower($kelas)
            );

            $filename =
                'data-siswa-' .
                $namaKelas .
                '.xlsx';

        } else {

            $filename =
                'data-siswa-semua-kelas.xlsx';
        }

        return Excel::download(
            new StudentsExport($kelas),
            $filename
        );
    }


    /**
     * Export rekap absensi.
     */
    public function attendance(
        Request $request
    ): BinaryFileResponse {
        $validated = $request->validate([
            'kelas' => [
                'nullable',
                'string',
                'max:100',
            ],

            'pertemuan' => [
                'nullable',
                'integer',
                'min:1',
            ],
        ]);

        $kelas =
            $validated['kelas']
            ?? null;

        $pertemuan =
            isset($validated['pertemuan'])
            && $validated['pertemuan'] !== ''
                ? (int) $validated['pertemuan']
                : null;

        $filename =
            'rekap-absensi';

        if ($kelas) {

            $namaKelas = str_replace(
                ' ',
                '-',
                strtolower($kelas)
            );

            $filename .=
                '-' .
                $namaKelas;
        }

        if ($pertemuan !== null) {

            $filename .=
                '-pertemuan-' .
                $pertemuan;

        } else {

            $filename .=
                '-semua-pertemuan';
        }

        $filename .= '.xlsx';

        return Excel::download(
            new AttendanceExport(
                $kelas,
                $pertemuan
            ),
            $filename
        );
    }


    /**
     * Export nilai akhir siswa.
     */
    public function finalGrades(
        Request $request
    ): BinaryFileResponse {
        $validated = $request->validate([
            'kelas' => [
                'nullable',
                'string',
                'max:100',
            ],
        ]);

        $kelas =
            $validated['kelas']
            ?? null;

        if ($kelas) {

            $namaKelas = str_replace(
                ' ',
                '-',
                strtolower($kelas)
            );

            $filename =
                'rekap-nilai-akhir-' .
                $namaKelas .
                '.xlsx';

        } else {

            $filename =
                'rekap-nilai-akhir-semua-kelas.xlsx';
        }

        return Excel::download(
            new FinalGradesExport($kelas),
            $filename
        );
    }


    /**
     * Export nilai LKPD siswa.
     */
    public function lkpd(
        Request $request
    ): BinaryFileResponse {
        $validated = $request->validate([
            'kelas' => [
                'nullable',
                'string',
                'max:100',
            ],
        ]);

        $kelas =
            $validated['kelas']
            ?? null;

        if ($kelas) {

            $namaKelas = str_replace(
                ' ',
                '-',
                strtolower($kelas)
            );

            $filename =
                'rekap-nilai-lkpd-' .
                $namaKelas .
                '.xlsx';

        } else {

            $filename =
                'rekap-nilai-lkpd-semua-kelas.xlsx';
        }

        return Excel::download(
            new LKPDExport($kelas),
            $filename
        );
    }


    /**
     * Export nilai Quiz siswa.
     */
    public function quiz(
        Request $request
    ): BinaryFileResponse {
        $validated = $request->validate([
            'kelas' => [
                'nullable',
                'string',
                'max:100',
            ],
        ]);

        $kelas =
            $validated['kelas']
            ?? null;

        if ($kelas) {

            $namaKelas = str_replace(
                ' ',
                '-',
                strtolower($kelas)
            );

            $filename =
                'rekap-nilai-quiz-' .
                $namaKelas .
                '.xlsx';

        } else {

            $filename =
                'rekap-nilai-quiz-semua-kelas.xlsx';
        }

        return Excel::download(
            new QuizExport($kelas),
            $filename
        );
    }


    /**
     * Export nilai Praktik siswa.
     */
    public function practice(
        Request $request
    ): BinaryFileResponse {
        $validated = $request->validate([
            'kelas' => [
                'nullable',
                'string',
                'max:100',
            ],
        ]);

        $kelas =
            $validated['kelas']
            ?? null;

        if ($kelas) {

            $namaKelas = str_replace(
                ' ',
                '-',
                strtolower($kelas)
            );

            $filename =
                'rekap-nilai-praktik-' .
                $namaKelas .
                '.xlsx';

        } else {

            $filename =
                'rekap-nilai-praktik-semua-kelas.xlsx';
        }

        return Excel::download(
            new PracticeExport($kelas),
            $filename
        );
    }


    /**
     * Export nilai Refleksi siswa.
     */
    public function reflection(
        Request $request
    ): BinaryFileResponse {
        $validated = $request->validate([
            'kelas' => [
                'nullable',
                'string',
                'max:100',
            ],
        ]);

        $kelas =
            $validated['kelas']
            ?? null;

        if ($kelas) {

            $namaKelas = str_replace(
                ' ',
                '-',
                strtolower($kelas)
            );

            $filename =
                'rekap-nilai-refleksi-' .
                $namaKelas .
                '.xlsx';

        } else {

            $filename =
                'rekap-nilai-refleksi-semua-kelas.xlsx';
        }

        return Excel::download(
            new ReflectionExport($kelas),
            $filename
        );
    }
}