<?php

namespace Database\Seeders\production;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stores')->insert([
            'name' => "Pupuk.In Official Store",
            'picture' => "https://storage.googleapis.com/pupukin-bucket/pupukin-logo_648b254dc5bb2.png",
            'address' => "Jl. Pupukin Raya, No. 1",
            // 'latitude' => mt_rand(-90, 90) + (mt_rand() / mt_getrandmax() - 0.5),
            // 'longitude' => mt_rand(-180, 180) + (mt_rand() / mt_getrandmax() - 0.5),
            'latitude' => -6.193548264239904,
            'longitude' => 106.75711239318001,
            'description' => "Pupuk.In Official Store",
            'rating' => 5,
            'profile_id' => 1,
            'created_at' => date('Y-m-d H:i:sO', time()),
            'updated_at' => date('Y-m-d H:i:sO', time())
        ]);
    }
}
