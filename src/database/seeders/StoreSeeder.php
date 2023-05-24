<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stores')->insert([
            'name' => Str::random(4),
            'picture' => Str::random(10),
            'address' => 'Jl. '.Str::random(10),
            'latitude' => (float)mt_rand(0, 120),
            'longitude' => (float)mt_rand(0, 120),
            'description' => Str::random(50),
            'rating' => 0,
            'profile_id' => 1
        ]);

        DB::table('stores')->insert([
            'name' => Str::random(4),
            'picture' => Str::random(10),
            'address' => 'Jl. '.Str::random(10),
            'latitude' => (float)mt_rand(0, 120),
            'longitude' => (float)mt_rand(0, 120),
            'description' => Str::random(50),
            'rating' => 0,
            'profile_id' => 2
        ]);

        DB::table('stores')->insert([
            'name' => Str::random(4),
            'picture' => Str::random(10),
            'address' => 'Jl. '.Str::random(10),
            'latitude' => (float)mt_rand(0, 120),
            'longitude' => (float)mt_rand(0, 120),
            'description' => Str::random(50),
            'rating' => 0,
            'profile_id' => 3
        ]);

        DB::table('stores')->insert([
            'name' => Str::random(4),
            'picture' => Str::random(10),
            'address' => 'Jl. '.Str::random(10),
            'latitude' => (float)mt_rand(0, 120),
            'longitude' => (float)mt_rand(0, 120),
            'description' => Str::random(50),
            'rating' => 0,
            'profile_id' => 4
        ]);

        DB::table('stores')->insert([
            'name' => Str::random(4),
            'picture' => Str::random(10),
            'address' => 'Jl. '.Str::random(10),
            'latitude' => (float)mt_rand(0, 120),
            'longitude' => (float)mt_rand(0, 120),
            'description' => Str::random(50),
            'rating' => 0,
            'profile_id' => 5
        ]);
    }
}
