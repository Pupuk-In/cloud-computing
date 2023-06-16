<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $crops = array(
            "Padi",
            "Jagung",
            "Kedelai",
            "Kentang",
            "Tebu",
            "Kelapa Sawit",
            "Cabai",
            "Tomat",
            "Bawang Merah",
        );

        $pictures = array(
            "https://storage.googleapis.com/pupukin-bucket/manfaat-padi_648b4d64641a6.webp",
            "https://storage.googleapis.com/pupukin-bucket/tips-memilih-jagungjpg-20220828092415_648b4decc2e05.jpg",
            "https://storage.googleapis.com/pupukin-bucket/20120729PanenRayaKedelaiDiSidoarjo-EricIreng280712-4_648b4e1a103f7.jpg",
            "https://storage.googleapis.com/pupukin-bucket/yetI9s3q30_648b4e42d65bb.jpg",
            "https://storage.googleapis.com/pupukin-bucket/Tebu_648b4e77a4a44.jpg",
            "https://storage.googleapis.com/pupukin-bucket/9e96908c9d02a8de0f90eea061b315f7_648b4e9c5cfaf.jpg",
            "https://storage.googleapis.com/pupukin-bucket/varwwwhtmldinkescommonupload88Manfaat-Cabai_648b4ec4a3e35.jpg",
            "https://storage.googleapis.com/pupukin-bucket/tomat-biasa_648b4ee25f027.webp",
            "https://storage.googleapis.com/pupukin-bucket/bawang_648b4f107dd52.jpg",

        );

        for($i = 0; $i < count($crops); $i++) {
            DB::table('plants')->insert([
                'name' => $crops[$i],
                'picture' => $pictures[$i],
                'created_at' => date('Y-m-d H:i:sO', time()),
                'updated_at' => date('Y-m-d H:i:sO', time())
            ]);
        }
    }
}
