<?php

namespace Database\Seeders\production;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profiles')->insert([
            'name' => "Pupukin Official",
            'picture' => "https://storage.googleapis.com/pupukin-bucket/pupukin-logo_648b254dc5bb2.png",
            'birth_date' => "2023-06-15",
            'phone_number' => '081234567890',
            'address' => "Jl. Pupukin Raya, No. 1",
            'latitude' => -6.193548264239904,
            'longitude' => 106.75711239318001,
            'user_id' => 1,
            'created_at' => date('Y-m-d H:i:sO', time()),
            'updated_at' => date('Y-m-d H:i:sO', time())
        ]);

        DB::table('profiles')->insert([
            'name' => "Jeffry Jepherson",
            'picture' => "https://storage.googleapis.com/pupukin-bucket/happy-man-okay-sign-portrait-white-background-showing-31416492_648b3dc4d0e46.webp",
            'birth_date' => "1990-09-22",
            'phone_number' => '081122223333',
            'address' => "Jl. Rumah jepri, Mana hah",
            'latitude' => -6.195244692390197,
            'longitude' => 106.75864021802651,
            'user_id' => 2,
            'created_at' => date('Y-m-d H:i:sO', time()),
            'updated_at' => date('Y-m-d H:i:sO', time())
        ]);
    }
}
