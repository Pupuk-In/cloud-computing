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
        );

        $pictures = array(
            "https://storage.googleapis.com/pupukin-bucket/1950ce71d496069104c0de8c353fa918_648b481935bde.jpg",
            "https://storage.googleapis.com/pupukin-bucket/pupuk_fosfat_primatan_50kg_1676215138_034f4446_648b492d8919e.jpg",
            "https://storage.googleapis.com/pupukin-bucket/d9714d6c-6037-415e-9d9a-995919865040.jpg_648b495b81e62.webp",
            "https://storage.googleapis.com/pupukin-bucket/1dd16c04-8548-4ca5-8fef-3f2f303626be_648b4985832b4.jpg",
            "https://storage.googleapis.com/pupukin-bucket/107408797_8ab71458-e344-4aea-82b4-70dd16bc3117_800_800_648b49bd1feee.jpg",
            "https://storage.googleapis.com/pupukin-bucket/f2d242c9-4af1-4eca-85b0-cf77899b9245_648b49e834b15.png",
            "https://storage.googleapis.com/pupukin-bucket/data.jpeg_648b4a20d5eef.webp",
            "https://storage.googleapis.com/pupukin-bucket/147dd189-8d96-483a-81d5-c6cf83e1076b_648b4a57dd3a7.jpg",
            "https://storage.googleapis.com/pupukin-bucket/c2e0d982-5d91-4be2-9463-0540dcabe335_648b4a85427bf.jpg",
            "https://storage.googleapis.com/pupukin-bucket/b4e594ed-e6a9-48e1-bfe7-520b39e10d1b_648b4ab63608a.jpg",
            "https://storage.googleapis.com/pupukin-bucket/Murah_Pupuk_Meroke_Za_Zwavelzure_Ammoniak_Amonium_Sulfat_Utk_648b4aec142cf.jpg",
            "https://storage.googleapis.com/pupukin-bucket/rug-1605232602010-0_648b4b36a1e42.jpeg",
            "https://storage.googleapis.com/pupukin-bucket/kisrit-scaled_648b4b5e22552.jpg",
            "https://storage.googleapis.com/pupukin-bucket/f80532af-84ac-44b2-a30a-ba0543a7ec2c_648b4baf30bea.webp",
            "https://storage.googleapis.com/pupukin-bucket/Screenshot_1_648b4be5d0b3a.jpg",
            "https://storage.googleapis.com/pupukin-bucket/data_648b4c369f69f.jpg",
            "https://storage.googleapis.com/pupukin-bucket/846e699a-7416-49e2-a1cf-747eba366198_648b4c6ec1139.jpg",
            "https://storage.googleapis.com/pupukin-bucket/3eadf5ac-fa75-4058-bf94-3beb863392f1_648b4cac15749.jpg",

        );

        for($i=0; $i<count($types); $i++){
            DB::table('types')->insert([
                'name' => $types[$i],
                'picture' => $pictures[$i],
                'created_at' => date('Y-m-d H:i:sO', time()),
                'updated_at' => date('Y-m-d H:i:sO', time())
            ]);
        }
    }
}
