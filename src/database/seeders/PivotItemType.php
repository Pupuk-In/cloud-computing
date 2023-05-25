<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PivotItemType extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i= 1; $i <= 50; $i++){
            DB::table('items_has_types')->insert([
                'item_id' => $i,
                'type_id' => rand(1,20),
                'created_at' => date('Y-m-d H:i:sO', time()),
                'updated_at' => date('Y-m-d H:i:sO', time())
            ]);
        }
    }
}
