<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoControllerSiswa extends Controller
{
    public function index(Request $request)
    {
        $pertemuan = (int) $request->get('pertemuan', 1);

        if ($pertemuan < 1 || $pertemuan > 8) {
            $pertemuan = 1;
        }

        $videos = Video::where('pertemuan', $pertemuan)
            ->orderBy('urutan')
            ->orderBy('id')
            ->get();

        return view('videos.index', compact(
            'videos',
            'pertemuan'
        ));
    }
}