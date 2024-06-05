<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Test User_1',
            'email' => 'test1@gmail.com',
            'password' => Hash::make('123123123')
        ]);
        User::create([
            'name' => 'Test User_2',
            'email' => 'test2@gmail.com',
            'password' => Hash::make('123123123')
        ]);
    }
}
