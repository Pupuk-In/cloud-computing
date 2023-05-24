<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlantPartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('plant_parts')->insert([
            'name' => 'Daun',
            'picture' => 'ini gambar Daun'
        ]);

        DB::table('plant_parts')->insert([
            'name' => 'Bunga',
            'picture' => 'ini gambar Bunga'
        ]);

        DB::table('plant_parts')->insert([
            'name' => 'Buah',
            'picture' => 'ini gambar Buah'
        ]);

        DB::table('plant_parts')->insert([
            'name' => 'Tangkai',
            'picture' => 'ini gambar Tangkai'
        ]);

        DB::table('plant_parts')->insert([
            'name' => 'Akar',
            'picture' => 'ini gambar Akar'
        ]);

        DB::table('plant_parts')->insert([
            'name' => 'Rusuk',
            'picture' => 'ini gambar Rusuk'
        ]);
    }
}
