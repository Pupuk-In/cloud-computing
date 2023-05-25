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
        $plantParts = array(
            "Akar",
            "Batang",
            "Daun",
            "Bunga",
            "Buah",
            "Biji"
        );

        foreach($plantParts as $plantpart){
            DB::table('plant_parts')->insert([
            'name' => $plantpart,
            'picture' => 'ini gambar ' . $plantpart,
            'created_at' => date('Y-m-d H:i:sO', time()),
            'updated_at' => date('Y-m-d H:i:sO', time())
        ]);
        }
    }
}
