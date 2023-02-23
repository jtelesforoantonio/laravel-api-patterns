<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Jonathan',
            'email' => 'jtelesforo@gmail.com',
            'password' => 'password',
        ]);
        User::factory(5)->create();
        User::factory(5)->trashed()->create();
    }
}
