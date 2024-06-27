<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'username' => 'zainandhi',
            'password' => bcrypt('111'),
            'email' => 'zainandhi@gmail.com',
            'nama_lengkap' => 'Zainandhi',
            'alamat' => 'di jalan jalan',
            'foto_profil' => 'photoprofile/default_profile.jpg'
        ]);

        User::create([
            'username' => 'hisoka_22',
            'password' => bcrypt('111'),
            'email' => 'hisoka@gmail.com',
            'nama_lengkap' => 'Hisoka',
            'alamat' => 'di jalan jalan',
            'foto_profil' => 'photoprofile/default_profile.jpg'
        ]);
        User::create([
            'username' => 'shizuku06',
            'password' => bcrypt('111'),
            'email' => 'shizuku@gmail.com',
            'nama_lengkap' => 'Shizuku',
            'alamat' => 'di jalan jalan',
            'foto_profil' => 'photoprofile/default_profile.jpg'
        ]);
    }
}