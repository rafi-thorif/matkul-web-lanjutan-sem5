<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // updateOrCreate mencegah duplikasi jika seeder dijalankan ulang
        User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name'     => 'Super Admin',
                'email'    => 'admin@admin.com',
                // password
                'password' => Hash::make('secret123'),
                'role'     => 'admin',
            ]
        );
    }
}