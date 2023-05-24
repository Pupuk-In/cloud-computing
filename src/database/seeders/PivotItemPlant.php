<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PivotItemPlant extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items_has_plants')->insert([
            'item_id' => rand(1,3),
            'plant_id' => rand(1,6)
        ]);
        DB::table('items_has_plants')->insert([
            'item_id' => rand(1,3),
            'plant_id' => rand(1,6)
        ]);
        DB::table('items_has_plants')->insert([
            'item_id' => rand(1,3),
            'plant_id' => rand(1,6)
        ]);
        DB::table('items_has_plants')->insert([
            'item_id' => rand(1,3),
            'plant_id' => rand(1,6)
        ]);
        DB::table('items_has_plants')->insert([
            'item_id' => rand(1,3),
            'plant_id' => rand(1,6)
        ]);
        DB::table('items_has_plants')->insert([
            'item_id' => rand(1,3),
            'plant_id' => rand(1,6)
        ]);
    }
}
