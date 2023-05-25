<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = array(
            "Nitrogen",
            "Fosfor",
            "Kalium",
            "Organik",
            "Hayati",
            "Majemuk",
            "Kandang",
            "Kompos",
            "Urea",
            "NPK",
            "ZA (Zwavelzure Ammoniak)",
            "TSP (Triple Super Phosphate)",
            "Kieserite",
            "Dolomit",
            "ZK (Zwavelzure Kali)",
            "Magnesium",
            "Kalsium",
            "Boron",
            "Besi",
            "Mangan"
        );

        foreach($types as $type){
            DB::table('types')->insert([
                'name' => $type,
                'picture' => 'ini gambar ' . $type,
                'created_at' => date('Y-m-d H:i:sO', time()),
                'updated_at' => date('Y-m-d H:i:sO', time())
            ]);
        }
    }
}
