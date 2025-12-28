<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    
    public function run(): void
    {
        

        User::factory()->create([
            'name' => 'Admin Wisuda',
            'email' => 'admin@contoh.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
