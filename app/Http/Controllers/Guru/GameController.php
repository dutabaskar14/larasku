<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Halaman pengaturan Game Interaktif guru.
     */
    public function index()
    {
        $game = Game::first();

        return view('guru.games.index', compact('game'));
    }


    /**
     * Menyimpan atau memperbarui link Game Interaktif.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'link' => [
                'required',
                'url',
                'max:2048',
            ],

            'aktif' => [
                'nullable',
                'boolean',
            ],
        ], [
            'link.required' => 'Link game wajib diisi.',
            'link.url' => 'Link game harus berupa URL yang valid.',
        ]);

        Game::updateOrCreate(
            [
                'id' => 1,
            ],
            [
                'judul' => 'Game Interaktif',
                'link' => $validated['link'],
                'aktif' => $request->boolean('aktif'),
            ]
        );

        return redirect()
            ->route('guru.games.index')
            ->with(
                'success',
                'Link Game Interaktif berhasil disimpan.'
            );
    }
}