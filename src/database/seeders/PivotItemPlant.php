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
        for ($i = 0; $i < 8; $i++) {
            for ($j = 0; $j < 2; $j++) {
                DB::table('item_plant')->insert([
                    'item_id' => $i+1,
                    'plant_id' => mt_rand(1,9),
                    'created_at' => date('Y-m-d H:i:sO', time()),
                    'updated_at' => date('Y-m-d H:i:sO', time())
                ]);
            }
        }
    }
}
