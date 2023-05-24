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
        DB::table('plants_has_soils')->insert([
            'plant_id' => rand(1,6),
            'soil_id' => rand(1,6)
        ]);
        DB::table('plants_has_soils')->insert([
            'plant_id' => rand(1,6),
            'soil_id' => rand(1,6)
        ]);
        DB::table('plants_has_soils')->insert([
            'plant_id' => rand(1,6),
            'soil_id' => rand(1,6)
        ]);
        DB::table('plants_has_soils')->insert([
            'plant_id' => rand(1,6),
            'soil_id' => rand(1,6)
        ]);
        DB::table('plants_has_soils')->insert([
            'plant_id' => rand(1,6),
            'soil_id' => rand(1,6)
        ]);
        DB::table('plants_has_soils')->insert([
            'plant_id' => rand(1,6),
            'soil_id' => rand(1,6)
        ]);
        DB::table('plants_has_soils')->insert([
            'plant_id' => rand(1,6),
            'soil_id' => rand(1,6)
        ]);
        DB::table('plants_has_soils')->insert([
            'plant_id' => rand(1,6),
            'soil_id' => rand(1,6)
        ]);
        DB::table('plants_has_soils')->insert([
            'plant_id' => rand(1,6),
            'soil_id' => rand(1,6)
        ]);
        DB::table('plants_has_soils')->insert([
            'plant_id' => rand(1,6),
            'soil_id' => rand(1,6)
        ]);
    }
}
