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

        $pictures = array(
            "https://storage.googleapis.com/pupukin-bucket/akar_tumbuhan_648b4fbcf15c5.jpg",
            "https://storage.googleapis.com/pupukin-bucket/fungsi_batang_pada_tumbuhan-1.width-800.format-webp_648b5012b77c8.webp",
            "https://storage.googleapis.com/pupukin-bucket/5fb8e0990191a_648b502fe797a.jpg",
            "https://storage.googleapis.com/pupukin-bucket/9fcc6f20-dddd-4dba-8c5e-0e58217010cd_648b505af3075.jpg",
            "https://storage.googleapis.com/pupukin-bucket/tanaman-buah-dalam-ruangan-2_648b507e5ee0d.jpg",
            "https://storage.googleapis.com/pupukin-bucket/TEKNOLOGI-SELEKSI-BENIH-TANAMAN_648b50b09a0fd.jpg"
        );

        for($i=0; $i<6; $i++){
            DB::table('plant_parts')->insert([
            'name' => $plantParts[$i],
            'picture' => $pictures[$i],
            'created_at' => date('Y-m-d H:i:sO', time()),
            'updated_at' => date('Y-m-d H:i:sO', time())
        ]);
        }
    }
}
