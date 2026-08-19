<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Tampilkan halaman login Guru.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }


    /**
     * Proses login Guru.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => [
                'required',
                'string',
            ],

            'password' => [
                'required',
                'string',
            ],
        ], [
            'username.required' =>
                'Username wajib diisi.',

            'password.required' =>
                'Password wajib diisi.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | LOGIN
        |--------------------------------------------------------------------------
        |
        | Database menggunakan kolom "email".
        | Username Guru disimpan pada kolom tersebut.
        |
        */

        if (
            Auth::attempt([
                'email' => $credentials['username'],
                'password' => $credentials['password'],
            ])
        ) {

            $request->session()->regenerate();


            return redirect()
                ->intended('/guru');
        }


        return back()
            ->withErrors([
                'username' =>
                    'Username atau password salah.',
            ])
            ->onlyInput('username');
    }


    /**
     * Logout Guru.
     */
    public function logout(Request $request)
    {
        Auth::logout();


        $request->session()->invalidate();

        $request->session()->regenerateToken();


        return redirect()
            ->route('home');
    }
}