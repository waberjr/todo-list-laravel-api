<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'first_name' => 'Waber',
            'last_name' => 'Junior',
            'email' => 'waberjunior@hotmail.com',
            'password' => bcrypt('password'),
            'confirmation_token' => Str::random(60)
        ]);

        User::factory(5)->create();
    }
}
