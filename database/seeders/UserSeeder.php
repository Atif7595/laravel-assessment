<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
    * Seed the database with an admin user.
     */
    public function run(): void
    {
        User::create([
        'name' => 'admin',
        'email' => 'admin@gmail.com',
        'role'=> User::ADMIN,
        'password' => Hash::make('admin@1234'),
        ]);
    }
}
