<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'username' => 'fajar123',
                'first_name' => 'Fajar',
                'last_name' => 'Setiawan',
                'email' => 'fajar@example.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ],
            [
                'username' => 'nina456',
                'first_name' => 'Nina',
                'last_name' => 'Pratiwi',
                'email' => 'nina@example.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ],
            [
                'username' => 'budi789',
                'first_name' => 'Budi',
                'last_name' => 'Santoso',
                'email' => 'budi@example.com',
                'password' => Hash::make('password123'),
                'role' => 'super_admin',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
