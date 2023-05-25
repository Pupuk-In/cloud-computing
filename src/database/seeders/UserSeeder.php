<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => "testuser1",
            'email' => '1@gmail.com',
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'username' => "testuser2",
            'email' => '2@gmail.com',
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'username' => "testuser3",
            'email' => '3@gmail.com',
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'username' => "testuser4",
            'email' => '4@gmail.com',
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'username' => "testuser5",
            'email' => '5@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
