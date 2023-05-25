<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $storeNames = array(
            "Mystic Emporium",
            "Enchanted Treasures",
            "Epic Finds",
            "Cosmic Curiosities",
            "Wanderlust Wares",
            "Dreamer's Den",
            "Arcane Artifacts",
            "Celestial Boutique",
            "Magical Mercantile",
            "Dragon's Hoard",
            "Realm of Wonder",
            "Phantom Fashions",
            "Infinity Bazaar",
            "Whispering Winds Market",
            "Mythical Marvels",
            "Sorcerer's Secret",
            "Nebula Nook",
            "Chronicle Curiosity Shop",
            "Starfall Emporium",
            "Ethereal Essence"
        );
        $addresses = array(
            "Jl. Sudirman No. 123, Jakarta",
            "Jl. Diponegoro No. 456, Bandung",
            "Jl. Imam Bonjol No. 789, Surabaya",
            "Jl. Gatot Subroto No. 987, Semarang",
            "Jl. Pemuda No. 321, Medan",
            "Jl. Thamrin No. 555, Makassar",
            "Jl. Kebon Sirih No. 777, Yogyakarta",
            "Jl. M.H. Thamrin No. 999, Palembang",
            "Jl. Asia Afrika No. 246, Bandar Lampung",
            "Jl. Gajah Mada No. 135, Denpasar",
            "Jl. Raya Bogor No. 111, Bogor",
            "Jl. Merdeka No. 222, Solo",
            "Jl. A. Yani No. 333, Malang",
            "Jl. Jenderal Sudirman No. 444, Balikpapan",
            "Jl. Veteran No. 555, Padang",
            "Jl. Diponegoro No. 666, Pekanbaru",
            "Jl. Halmahera No. 777, Manado",
            "Jl. Kartini No. 888, Serang",
            "Jl. Pahlawan No. 999, Cirebon",
            "Jl. Hayam Wuruk No. 1010, Semarang"
        );

        function storeDescGen(){
            $words = array(
            "Stunning", "Magnificent", "Enchanting", "Captivating", "Thrilling",
            "Exquisite", "Mesmerizing", "Breathtaking", "Charming", "Fascinating",
            // Add more words here
            );

            $description = "";
            for ($i = 0; $i < 40; $i++) {
                $randomWord = $words[array_rand($words)];
                $description .= $randomWord . " ";
            }

            $description = trim($description);
            return $description;
        }

        for ($i = 1; $i <= 5; $i++) {
            DB::table('stores')->insert([
                'name' => $storeNames[array_rand($storeNames)],
                'picture' => Str::random(10),
                'address' => $addresses[array_rand($addresses)],
                'latitude' => mt_rand(-90, 90) + (mt_rand() / mt_getrandmax() - 0.5),
                'longitude' => mt_rand(-180, 180) + (mt_rand() / mt_getrandmax() - 0.5),
                'description' => storeDescGen(),
                'rating' => 0,
                'profile_id' => $i,
                'created_at' => date('Y-m-d H:i:sO', time()),
                'updated_at' => date('Y-m-d H:i:sO', time())
            ]);
        }
    }
}
