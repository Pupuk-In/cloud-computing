<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($y=0; $y<10; $y++) {
            for ($i=1; $i<6; $i++) {
                DB::table('cart_items')->insert([
                    'cart_id' => $i,
                    'item_id' => mt_rand(1,100),
                    'quantity' => mt_rand(1,10),
                ]);
            }
        }
    }
}
