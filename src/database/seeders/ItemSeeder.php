<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->insert([
            'name' => Str::random(5),
            'picture' => Str::random(10),
            'description' => Str::random(50),
            'price' => rand(5000, 100000),
            'stock' => rand(50, 200),
            'sold' => 0,
            'rating' => 0,
            'brand' => Str::random(5),
            'store_id' => 1,
        ]);
        DB::table('items')->insert([
            'name' => Str::random(5),
            'picture' => Str::random(10),
            'description' => Str::random(50),
            'price' => rand(5000, 100000),
            'stock' => rand(50, 200),
            'sold' => 0,
            'rating' => 0,
            'brand' => Str::random(5),
            'store_id' => 2,
        ]);
        DB::table('items')->insert([
            'name' => Str::random(5),
            'picture' => Str::random(10),
            'description' => Str::random(50),
            'price' => rand(5000, 100000),
            'stock' => rand(50, 200),
            'sold' => 0,
            'rating' => 0,
            'brand' => Str::random(5),
            'store_id' => 3,
        ]);
        DB::table('items')->insert([
            'name' => Str::random(5),
            'picture' => Str::random(10),
            'description' => Str::random(50),
            'price' => rand(5000, 100000),
            'stock' => rand(50, 200),
            'sold' => 0,
            'rating' => 0,
            'brand' => Str::random(5),
            'store_id' => 4,
        ]);
        DB::table('items')->insert([
            'name' => Str::random(5),
            'picture' => Str::random(10),
            'description' => Str::random(50),
            'price' => rand(5000, 100000),
            'stock' => rand(50, 200),
            'sold' => 0,
            'rating' => 0,
            'brand' => Str::random(5),
            'store_id' => 5,
        ]);
        DB::table('items')->insert([
            'name' => Str::random(5),
            'picture' => Str::random(10),
            'description' => Str::random(50),
            'price' => rand(5000, 100000),
            'stock' => rand(50, 200),
            'sold' => 0,
            'rating' => 0,
            'brand' => Str::random(5),
            'store_id' => 1,
        ]);
        DB::table('items')->insert([
            'name' => Str::random(5),
            'picture' => Str::random(10),
            'description' => Str::random(50),
            'price' => rand(5000, 100000),
            'stock' => rand(50, 200),
            'sold' => 0,
            'rating' => 0,
            'brand' => Str::random(5),
            'store_id' => 2,
        ]);
        DB::table('items')->insert([
            'name' => Str::random(5),
            'picture' => Str::random(10),
            'description' => Str::random(50),
            'price' => rand(5000, 100000),
            'stock' => rand(50, 200),
            'sold' => 0,
            'rating' => 0,
            'brand' => Str::random(5),
            'store_id' => 3,
        ]);
        DB::table('items')->insert([
            'name' => Str::random(5),
            'picture' => Str::random(10),
            'description' => Str::random(50),
            'price' => rand(5000, 100000),
            'stock' => rand(50, 200),
            'sold' => 0,
            'rating' => 0,
            'brand' => Str::random(5),
            'store_id' => 4,
        ]);
        DB::table('items')->insert([
            'name' => Str::random(5),
            'picture' => Str::random(10),
            'description' => Str::random(50),
            'price' => rand(5000, 100000),
            'stock' => rand(50, 200),
            'sold' => 0,
            'rating' => 0,
            'brand' => Str::random(5),
            'store_id' => 5,
        ]);
        DB::table('items')->insert([
            'name' => Str::random(5),
            'picture' => Str::random(10),
            'description' => Str::random(50),
            'price' => rand(5000, 100000),
            'stock' => rand(50, 200),
            'sold' => 0,
            'rating' => 0,
            'brand' => Str::random(5),
            'store_id' => 1,
        ]);
        DB::table('items')->insert([
            'name' => Str::random(5),
            'picture' => Str::random(10),
            'description' => Str::random(50),
            'price' => rand(5000, 100000),
            'stock' => rand(50, 200),
            'sold' => 0,
            'rating' => 0,
            'brand' => Str::random(5),
            'store_id' => 2,
        ]);
        DB::table('items')->insert([
            'name' => Str::random(5),
            'picture' => Str::random(10),
            'description' => Str::random(50),
            'price' => rand(5000, 100000),
            'stock' => rand(50, 200),
            'sold' => 0,
            'rating' => 0,
            'brand' => Str::random(5),
            'store_id' => 3,
        ]);
        DB::table('items')->insert([
            'name' => Str::random(5),
            'picture' => Str::random(10),
            'description' => Str::random(50),
            'price' => rand(5000, 100000),
            'stock' => rand(50, 200),
            'sold' => 0,
            'rating' => 0,
            'brand' => Str::random(5),
            'store_id' => 4,
        ]);
        DB::table('items')->insert([
            'name' => Str::random(5),
            'picture' => Str::random(10),
            'description' => Str::random(50),
            'price' => rand(5000, 100000),
            'stock' => rand(50, 200),
            'sold' => 0,
            'rating' => 0,
            'brand' => Str::random(5),
            'store_id' => 5,
        ]);
        DB::table('items')->insert([
            'name' => Str::random(5),
            'picture' => Str::random(10),
            'description' => Str::random(50),
            'price' => rand(5000, 100000),
            'stock' => rand(50, 200),
            'sold' => 0,
            'rating' => 0,
            'brand' => Str::random(5),
            'store_id' => 1,
        ]);
        DB::table('items')->insert([
            'name' => Str::random(5),
            'picture' => Str::random(10),
            'description' => Str::random(50),
            'price' => rand(5000, 100000),
            'stock' => rand(50, 200),
            'sold' => 0,
            'rating' => 0,
            'brand' => Str::random(5),
            'store_id' => 2,
        ]);
        DB::table('items')->insert([
            'name' => Str::random(5),
            'picture' => Str::random(10),
            'description' => Str::random(50),
            'price' => rand(5000, 100000),
            'stock' => rand(50, 200),
            'sold' => 0,
            'rating' => 0,
            'brand' => Str::random(5),
            'store_id' => 3,
        ]);
        DB::table('items')->insert([
            'name' => Str::random(5),
            'picture' => Str::random(10),
            'description' => Str::random(50),
            'price' => rand(5000, 100000),
            'stock' => rand(50, 200),
            'sold' => 0,
            'rating' => 0,
            'brand' => Str::random(5),
            'store_id' => 4,
        ]);
        DB::table('items')->insert([
            'name' => Str::random(5),
            'picture' => Str::random(10),
            'description' => Str::random(50),
            'price' => rand(5000, 100000),
            'stock' => rand(50, 200),
            'sold' => 0,
            'rating' => 0,
            'brand' => Str::random(5),
            'store_id' => 5,
        ]);
    }
}
