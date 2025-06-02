<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Activity;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    public function run()
    {
        $fajar = User::where('email', 'fajar@example.com')->first();
        $nina = User::where('email', 'nina@example.com')->first();
        $budi = User::where('email', 'budi@example.com')->first();

        Activity::create([
            'user_id' => $fajar->id,
            'description' => 'menyelesaikan laporan #102',
            'created_at' => now()->subHours(2),
        ]);

        Activity::create([
            'user_id' => $nina->id,
            'description' => 'meninjau laporan #102',
            'created_at' => now()->subMinutes(45),
        ]);

        Activity::create([
            'user_id' => $budi->id,
            'description' => 'membersihkan laporan #103',
            'created_at' => now()->subMinutes(30),
        ]);
    }
}
