<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $firstNames = array(
            "Andi",
            "Budi",
            "Citra",
            "Dewi",
            "Eka",
            "Fitri",
            "Gita",
            "Hadi",
            "Indra",
            "Joko"
        );
        $lastNames = array(
            "Santoso",
            "Wijaya",
            "Kusuma",
            "Lestari",
            "Suryadi",
            "Haryanto",
            "Saputra",
            "Siregar",
            "Hutomo",
            "Wibowo"
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

        for ($i=1; $i <= 5; $i++) { 
            DB::table('profiles')->insert([
                'name' => $firstNames[array_rand($firstNames)].' '.$lastNames[array_rand($lastNames)],
                'picture' => Str::random(10),
                'birth_date' => rand(1990, 2023).'-'.rand(1,12).'-'.rand(1,29),
                'phone_number' => '08'.rand(1000000000,9999999999),
                'address' => $addresses[array_rand($addresses)],
                'latitude' => mt_rand(-90, 90) + (mt_rand() / mt_getrandmax() - 0.5),
                'longitude' => mt_rand(-180, 180) + (mt_rand() / mt_getrandmax() - 0.5),
                'user_id' => $i,
                'created_at' => date('Y-m-d H:i:sO', time()),
                'updated_at' => date('Y-m-d H:i:sO', time())
            ]);
        }
    }
}
