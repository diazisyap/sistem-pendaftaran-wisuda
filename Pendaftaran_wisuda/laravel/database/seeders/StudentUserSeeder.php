<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::updateOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name' => 'Mahasiswa Wisuda',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'user',
            ]
        );
    }
}
