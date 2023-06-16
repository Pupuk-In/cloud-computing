<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use function Database\Seeders\descriptionGen as SeedersDescriptionGen;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->insert([
            'name' => "Meroke - Mutiara Pupuk NPK 16-16-16 Kemasan Pabrik 1 Kg",
            'description' => "Meroke Mutiara Pupuk NPK 16-16-16 kemasan pabrik 1 kg
                    Negara Pembuat: Rusia
                    Habis Masa Edar: FEB 2026

                    Kandungan NPK Mutiara 16-16-16:
                    Nitrogen (N) 16,0 %
                    Fosfat (P2O5) 16,0 %
                    Kalium Oksida (K2O) 16,0%",
            'type_id' => 1,
            'price' => 35000,
            'stock' => 120,
            'sold' => 0, 
            'rating' => 5,
            'brand' => "UthieOrchard",
            'store_id' => 1, 
            'created_at' => date('Y-m-d H:i:sO', time()), 
            'updated_at' => date('Y-m-d H:i:sO', time()) 
        ]);

        DB::table('items')->insert([
            'name' => "Pupuk Penyubur dan Pelebat Buah Pupuk Agro Lestari 1 Liter",
            'description' => "Manfaat Utama :
                    * Menyuburkan ke suluruh akar tanaman, batang, daun, buah dan buah 			  serta membuat tanaman kebal akan hama
                    * Merangsang Pertumbuhan tanaman dan buah
                    * Menjauhkan tanaman dari kelayuan dan rontoh bunga",
            'type_id' => 2,
            'price' => 130000,
            'stock' => 2454,
            'sold' => 0,
            'rating' => 4.9,
            'brand' => "ShopAbadi99",
            'store_id' => 1,
            'created_at' => date('Y-m-d H:i:sO', time()),
            'updated_at' => date('Y-m-d H:i:sO', time())
        ]);

        DB::table('items')->insert([
            'name' => "Pupuk Urea untuk Penyubur Rumput dan Daun - 1 Kg",
            'description' => "Pupuk UREA penyubur daun & rumput",
            'type_id' => 3,
            'price' => 21999,
            'stock' => 81,
            'sold' => 0,
            'rating' => 4.8,
            'brand' => "crystallpot",
            'store_id' => 1,
            'created_at' => date('Y-m-d H:i:sO', time()),
            'updated_at' => date('Y-m-d H:i:sO', time())
        ]);

        DB::table('items')->insert([
            'name' => "PUPUK PN KRISTAL 1 KG KEMASAN PABRIK KNO3 PUTIH PAK TANI",
            'description' => "Pupuk ini dapat digunakan pada tanaman bawang merah/putih, kentang, 			  wortel, cabe, tomat, semangka, melon, kubis, sawi, kol bunga, 			  kedelai, dll",
            'type_id' => 4,
            'price' => 44000,
            'stock' => 988,
            'sold' => 0,
            'rating' => 5,
            'brand' => "Milkyku Shop",
            'store_id' => 1,
            'created_at' => date('Y-m-d H:i:sO', time()),
            'updated_at' => date('Y-m-d H:i:sO', time())
        ]);

        DB::table('items')->insert([
            'name' => "Pupuk NPK mutiara 16-16-16 1Kg",
            'description' => "Pupuk NPK MUTIARA repack lagi Kemasan asli 50kg. :ami packing ulang 			  menjadi kemasan sesuai orderan",
            'type_id' => 5,
            'price' => 19000,
            'stock' => 21709,
            'sold' => 0,
            'rating' => 4.8,
            'brand' => "SAHABAT KARUNG",
            'store_id' => 1,
            'created_at' => date('Y-m-d H:i:sO', time()),
            'updated_at' => date('Y-m-d H:i:sO', time())
        ]);

        DB::table('items')->insert([
            'name' => "Pupuk Vitamin B1 Tanaman Original USA Berhologram 470ml",
            'description' => "Kandungan : Phosphoric acid 2.00% iron (Fe) 0.10% sebagai Fe-EDTA 			  vitamin B1 (thiamine mononitrate) 0.10%

                    Bentuk : Pupuk Cair",
            'type_id' => 6,
            'price' => 25000,
            'stock' => 8200,
            'sold' => 0,
            'rating' => 5,
            'brand' => "bellvania_bonsai",
            'store_id' => 1,
            'created_at' => date('Y-m-d H:i:sO', time()),
            'updated_at' => date('Y-m-d H:i:sO', time())
        ]);

        DB::table('items')->insert([
            'name' => "INFARM - Nutrisi Ab Mix Buah Untuk 100 Liter Pupuk Tanah & Hidroponik",
            'description' => "Pupuk AB – MIX diformulasikan khusus untuk pertumbuhan tanaman, 			  menggunakan bahan bermutu yang larut 100% dalam air. 
                    Mengandung unsur-unsur makro N, P, K, Ca, Mg, S serta unsur-unsur 			  mikro Fe, Mn, Zn, B, Cu, Mo",
            'type_id' => 7,
            'price' => 17500,
            'stock' => 6,
            'sold' => 0,
            'rating' => 4.9,
            'brand' => "infarm",
            'store_id' => 1,
            'created_at' => date('Y-m-d H:i:sO', time()),
            'updated_at' => date('Y-m-d H:i:sO', time())
        ]);

        DB::table('items')->insert([
            'name' => "PETROMART - Pupuk Kalium Sulfat ZK Petro",
            'description' => "Kandungan Unsur Hara
                    - Kalium (K2O) = 50%
                    - Sulfur (S) = 17%",
            'type_id' => 8,
            'price' => 23000,
            'stock' => 39,
            'sold' => 0,
            'rating' => 5,
            'brand' => "Petromart Official Store",
            'store_id' => 1,
            'created_at' => date('Y-m-d H:i:sO', time()),
            'updated_at' => date('Y-m-d H:i:sO', time())
        ]);
    }
}