<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('plants')->insert([
            'name' => 'Jagung',
            'picture' => 'ini gambar Jagung',
        ]);

        DB::table('plants')->insert([
            'name' => 'Kentang',
            'picture' => 'ini gambar Kentang',
        ]);

        DB::table('plants')->insert([
            'name' => 'Wortel',
            'picture' => 'ini gambar Wortel',
        ]);

        DB::table('plants')->insert([
            'name' => 'Kol',
            'picture' => 'ini gambar Kol',
        ]);

        DB::table('plants')->insert([
            'name' => 'Ubi',
            'picture' => 'ini gambar Ubi',
        ]);

        DB::table('plants')->insert([
            'name' => 'Semangka',
            'picture' => 'ini gambar Semangka',
        ]);
    }
}
