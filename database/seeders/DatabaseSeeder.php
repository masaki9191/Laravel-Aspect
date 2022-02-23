<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'type' => 0,
            'userid' => 'admin',
            'password' => bcrypt('admin12345'),
        ]);
        User::create([
            'type' => 1,
            'userid' => 'user',
            'password' => bcrypt('user12345'),
        ]);
    }
}
