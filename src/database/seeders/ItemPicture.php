<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemPicture extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pictures = array(
            "https://storage.googleapis.com/pupukin-bucket/1_648b570844704.jpg",
            "https://storage.googleapis.com/pupukin-bucket/2_648b572add6fe.jpg",
            "https://storage.googleapis.com/pupukin-bucket/3_648b5748dee2d.jpg",
            "https://storage.googleapis.com/pupukin-bucket/4_648b57567d5f0.jpg",
            "https://storage.googleapis.com/pupukin-bucket/5_648b57699f59a.jpeg",
            "https://storage.googleapis.com/pupukin-bucket/6_648b5775370df.jpg",
            "https://storage.googleapis.com/pupukin-bucket/7_648b5785d1d8e.jpg",
            "https://storage.googleapis.com/pupukin-bucket/8_648b5792eb329.jpg"
        );

        for ($i = 0; $i < 8; $i++) {
            DB::table('item_pictures')->insert([
                'item_id' => $i + 1,
                'picture' => $pictures[$i],
                'created_at' => date('Y-m-d H:i:sO', time()),
                'updated_at' => date('Y-m-d H:i:sO', time())
            ]);
        }
    }
}
