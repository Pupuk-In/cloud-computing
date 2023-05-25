<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SoilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $soils = array(
            "Tanah Liat",
            "Tanah Humus",
            "Tanah Pasir",
            "Tanah Lempung",
            "Tanah Gambut",
            "Tanah Laterit",
            "Tanah Podsolik",
            "Tanah Vulkanik",
            "Tanah Berpasir",
            "Tanah Berlempung"
        );

        function soilDescGen(){
            $soilWords = array(
                "tanah",
                "lahan",
                "struktur",
                "kandungan",
                "kelembaban",
                "pH",
                "porositas",
                "dekomposisi",
                "humus",
                "nutrisi",
                "retensi",
                "partikel",
                "komposisi",
                "agregat",
                "erosi",
                "pertanian",
                "pertanaman",
                "tanaman",
                "rekayasa",
                "pertumbuhan",
                "pupuk",
                "teknik",
                "manajemen",
                "produksi",
                "pengelolaan",
                "optimasi",
                "perbaikan",
                "budidaya",
                "peningkatan",
                "rendah",
                "tinggi",
                "berkelanjutan",
                "irigasi",
                "drainase",
                "keberlanjutan",
                "efisiensi",
                "kualitas",
                "keuntungan",
                "hasil",
                "tanam",
                "berkebun",
                "penyuburan",
                "analisis",
                "pertumbuhan"
            );

            $description = '';

            for ($i = 0; $i < 40; $i++) {
                $randomIndex = array_rand($soilWords);
                $description .= $soilWords[$randomIndex] . ' ';
            }

            return $description;
        }

        foreach($soils as $soil){
            DB::table('soils')->insert([
                'name' => $soil,
                'picture' => 'ini gambar ' . $soil,
                'description' => soilDescGen(),
                'nitrogen' => 20 + mt_rand() / mt_getrandmax() * (200 - 20),
                'phospor' =>  10 + mt_rand() / mt_getrandmax() * (50 - 10),
                'calium' => 100 + mt_rand() / mt_getrandmax() * (400 - 100),
                'ph' =>  5.5 + mt_rand() / mt_getrandmax() * (7.5 - 5.5),
                'temp' => 20 + mt_rand() / mt_getrandmax() * (30 - 20),
                'humidity' => 40 + mt_rand() / mt_getrandmax() * (80 - 40),
                'created_at' => date('Y-m-d H:i:sO', time()),
                'updated_at' => date('Y-m-d H:i:sO', time())
            ]);
        }
    }
}
