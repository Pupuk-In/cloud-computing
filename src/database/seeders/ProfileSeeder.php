<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profiles')->insert([
            'name' => Str::random(3),
            'picture' => Str::random(10),
            'birth_date' => rand(1990, 2023).'-'.rand(1,12).'-'.rand(1,30),
            'age' => rand(1,30),
            'address' => 'Jl. '.Str::random(10),
            'phone_number' => '08'.rand(1000000000,9999999999),
            'user_id' => 1
        ]);

        DB::table('profiles')->insert([
            'name' => Str::random(3),
            'picture' => Str::random(3).'@gmail.com',
            'birth_date' => rand(1990, 2023).'-'.rand(1,12).'-'.rand(1,30),
            'age' => rand(1,30),
            'address' => 'Jl. '.Str::random(10),
            'phone_number' => '08'.rand(1000000000,9999999999),
            'user_id' => 2
        ]);

        DB::table('profiles')->insert([
            'name' => Str::random(3),
            'picture' => Str::random(3).'@gmail.com',
            'birth_date' => rand(1990, 2023).'-'.rand(1,12).'-'.rand(1,30),
            'age' => rand(1,30),
            'address' => 'Jl. '.Str::random(10),
            'phone_number' => '08'.rand(1000000000,9999999999),
            'user_id' => 3
        ]);

        DB::table('profiles')->insert([
            'name' => Str::random(3),
            'picture' => Str::random(3).'@gmail.com',
            'birth_date' => rand(1990, 2023).'-'.rand(1,12).'-'.rand(1,30),
            'age' => rand(1,30),
            'address' => 'Jl. '.Str::random(10),
            'phone_number' => '08'.rand(1000000000,9999999999),
            'user_id' => 4
        ]);

        DB::table('profiles')->insert([
            'name' => Str::random(3),
            'picture' => Str::random(3).'@gmail.com',
            'birth_date' => rand(1990, 2023).'-'.rand(1,12).'-'.rand(1,30),
            'age' => rand(1,30),
            'address' => 'Jl. '.Str::random(10),
            'phone_number' => '08'.rand(1000000000,9999999999),
            'user_id' => 5
        ]);
    }
}
