<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\LKPD;
use App\Models\Student;
use Illuminate\Http\Request;

class LKPDController extends Controller
{
    /**
     * Rekap pengumpulan LKPD.
     */
    public function index(Request $request)
    {
        $kelas = $request->get('kelas', '');
        $pertemuan = $request->get('pertemuan', '');

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
        | Rekap LKPD
        |--------------------------------------------------------------------------
        */

        $lkpds = LKPD::with('student')
            ->when($kelas !== '', function ($query) use ($kelas) {
                $query->whereHas('student', function ($studentQuery) use ($kelas) {
                    $studentQuery->where('kelas', $kelas);
                });
            })
            ->when($pertemuan !== '', function ($query) use ($pertemuan) {
                $query->where(
                    'pertemuan',
                    (int) $pertemuan
                );
            })
            ->orderBy('pertemuan')
            ->orderBy('created_at', 'desc')
            ->get();


        return view('guru.lkpd.index', compact(
            'lkpds',
            'classes',
            'kelas',
            'pertemuan'
        ));
    }


    /**
     * Detail tugas LKPD.
     */
    public function show(LKPD $lkpd)
    {
        $lkpd->load('student');

        return view(
            'guru.lkpd.show',
            compact('lkpd')
        );
    }


    /**
     * Simpan persetujuan guru.
     */
    public function approve(Request $request, LKPD $lkpd)
    {
        $approved = $request->boolean('disetujui');

        if ($approved) {

            $lkpd->update([
                'disetujui' => true,
                'disetujui_at' => now(),
            ]);

            $message = 'Tugas LKPD berhasil disetujui.';

        } else {

            $lkpd->update([
                'disetujui' => false,
                'disetujui_at' => null,
            ]);

            $message = 'Persetujuan tugas dibatalkan.';
        }


        return redirect()
            ->route('guru.lkpd.show', $lkpd)
            ->with('success', $message);
    }
}