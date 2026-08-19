<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Reflection;
use App\Models\Student;
use Illuminate\Http\Request;

class ReflectionController extends Controller
{
    /**
     * Rekap seluruh refleksi siswa.
     */
    public function index(Request $request)
    {
        $kelas = $request->get('kelas');
        $pertemuan = $request->get('pertemuan');

        $classes = Student::where('aktif', true)
            ->whereNotNull('kelas')
            ->where('kelas', '!=', '')
            ->select('kelas')
            ->distinct()
            ->orderBy('kelas')
            ->pluck('kelas');

        $reflections = Reflection::with('student')
            ->when($kelas, function ($query) use ($kelas) {
                $query->whereHas('student', function ($studentQuery) use ($kelas) {
                    $studentQuery->where('kelas', $kelas);
                });
            })
            ->when($pertemuan, function ($query) use ($pertemuan) {
                $query->where('pertemuan', $pertemuan);
            })
            ->orderBy('pertemuan')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('guru.reflections.index', compact(
            'reflections',
            'classes',
            'kelas',
            'pertemuan'
        ));
    }


    /**
     * Detail satu refleksi.
     */
    public function show(Reflection $reflection)
    {
        $reflection->load('student');

        return view(
            'guru.reflections.show',
            compact('reflection')
        );
    }
}