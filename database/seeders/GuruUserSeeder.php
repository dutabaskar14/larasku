<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class GuruUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => 'dellasalsabila',
            ],
            [
                'name' => 'dellasalsabila',
                'password' => Hash::make('ppgupi1234'),
            ]
        );
    }
}