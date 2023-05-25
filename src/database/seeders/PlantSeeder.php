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
            "Cabe",
            "Tomat",
            "Bawang Merah",
            "Cabai"
        );

        foreach ($crops as $crop) {
            DB::table('plants')->insert([
                'name' => $crop,
                'picture' => 'ini gambar ' . $crop,
                'created_at' => date('Y-m-d H:i:sO', time()),
                'updated_at' => date('Y-m-d H:i:sO', time())
            ]);
        }
    }
}
