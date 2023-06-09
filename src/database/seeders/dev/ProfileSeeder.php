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

        $pictures = array(
            "https://storage.googleapis.com/pupukin-bucket/4f6dd4f000029da89507cb092aa6bacf_6479bf385aea6.png",
            "https://storage.googleapis.com/pupukin-bucket/fujiikaze_6479b8df6a4f6.jpeg",
            "https://storage.googleapis.com/pupukin-bucket/mustache_6479c8c244242.png",
            "https://storage.googleapis.com/pupukin-bucket/go_6479d5354e298.png",
            "https://storage.googleapis.com/pupukin-bucket/vitogeraldolraldo_6479d5a7f1211.gif"
        );

        $lat = array(
            -6.193548264239904,
            -6.195244692390197,
            -6.19339944026126,
            -6.19080265894966,
            -6.195263476299061
        );

        $lon = array(
            106.75711239318001,
            106.75864021802651,
            106.76067869681414,
            106.75855451813845,
            106.75554411102871
        );


        for ($i=1; $i <= 5; $i++) { 
            DB::table('profiles')->insert([
                'name' => $firstNames[array_rand($firstNames)].' '.$lastNames[array_rand($lastNames)],
                'picture' => $pictures[array_rand($pictures)],
                'birth_date' => mt_rand(1990, 2023).'-'.mt_rand(1,12).'-'.mt_rand(1,28),
                'phone_number' => '08'.rand(1000000000,9999999999),
                'address' => $addresses[array_rand($addresses)],
                // 'latitude' => mt_rand(-90, 90) + (mt_rand() / mt_getrandmax() - 0.5),
                // 'longitude' => mt_rand(-180, 180) + (mt_rand() / mt_getrandmax() - 0.5),
                'latitude' => $lat[$i-1],
                'longitude' => $lon[$i-1],
                'user_id' => $i,
                'created_at' => date('Y-m-d H:i:sO', time()),
                'updated_at' => date('Y-m-d H:i:sO', time())
            ]);
        }
    }
}
