<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PivotPlantSoil extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i= 0; $i < 40; $i++){
            DB::table('plant_soil')->insert([
                'plant_id' => mt_rand(1,10),
                'soil_id' => mt_rand(1,10)
            ]);
        }
    }
}
