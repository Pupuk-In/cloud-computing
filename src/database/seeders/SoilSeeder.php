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
        DB::table('soils')->insert([
            'name' => 'Regosol',
            'picture' => 'ini gambar Regosol',
            'description' => 'Tanah regosol ini termasuk dari salah satu sub jenis tanah Entisol. Tanah ini bermula dari pelapukan material yang dikeluarkan oleh letusan gunung berapi seperti pasir, lahar, debu dan lipili. Jenis tanah ini belum berkembang dengan sempurna.',
            'nitrogen' => (float)mt_rand(0, 10),
            'phospor' => (float)mt_rand(0, 10),
            'calium' => (float)mt_rand(0, 10),
            'ph' => (float)mt_rand(0, 10),
            'temp' => (float)mt_rand(0, 10),
            'humidity' => (float)mt_rand(0, 10),
        ]);

        DB::table('soils')->insert([
            'name' => 'Latosol',
            'picture' => 'ini gambar Latosol',
            'description' => 'Tanah ini terbentuk  dari proses pelapukan batuan sedimen dan metamorf. Tingkat perkembangan tanah latosol secara horizon berlangsung lambat sampai sedang. Hal ini dikarenakan sebagian besar tanah berasa didaerah yang lembab.',
            'nitrogen' => (float)mt_rand(0, 10),
            'phospor' => (float)mt_rand(0, 10),
            'calium' => (float)mt_rand(0, 10),
            'ph' => (float)mt_rand(0, 10),
            'temp' => (float)mt_rand(0, 10),
            'humidity' => (float)mt_rand(0, 10),
        ]);

        DB::table('soils')->insert([
            'name' => 'Organosol',
            'picture' => 'ini gambar Organosol',
            'description' => 'Tanah yang terbentuk dari proses pelapukan dan pembusukan bahan-bahan organic ini dapat dijumpai di daerah rawa-rawa ataupun daerah yang banyak digenangi air. Maka jenis tanah ini memiliki tekstur yang lembek karena tergenang air.',
            'nitrogen' => (float)mt_rand(0, 10),
            'phospor' => (float)mt_rand(0, 10),
            'calium' => (float)mt_rand(0, 10),
            'ph' => (float)mt_rand(0, 10),
            'temp' => (float)mt_rand(0, 10),
            'humidity' => (float)mt_rand(0, 10),
        ]);

        DB::table('soils')->insert([
            'name' => 'Alluvial',
            'picture' => 'ini gambar Alluvial',
            'description' => 'Tanah yang banyak ditemukan di hilir sungai ini adalah jenis tanah muda yang terbentuk dari pengendapan material halus aliran sungai. Tanah ini memiliki struktur tanah yang lepas-lepas dengan warna kelabu.',
            'nitrogen' => (float)mt_rand(0, 10),
            'phospor' => (float)mt_rand(0, 10),
            'calium' => (float)mt_rand(0, 10),
            'ph' => (float)mt_rand(0, 10),
            'temp' => (float)mt_rand(0, 10),
            'humidity' => (float)mt_rand(0, 10),
        ]);

        DB::table('soils')->insert([
            'name' => 'Laterit',
            'picture' => 'ini gambar Laterit',
            'description' => 'Tanah yang diusung-usung serupa dengan PMK ini memiliki suhu yang jauh lebih tinggi. Unsur hara yang terdapat di tanah ini cukup banyak dan tanah ini juga cukup subur, namun hilang karena larut dibawa air hujan.',
            'nitrogen' => (float)mt_rand(0, 10),
            'phospor' => (float)mt_rand(0, 10),
            'calium' => (float)mt_rand(0, 10),
            'ph' => (float)mt_rand(0, 10),
            'temp' => (float)mt_rand(0, 10),
            'humidity' => (float)mt_rand(0, 10),
        ]);

        DB::table('soils')->insert([
            'name' => 'Rendzina',
            'picture' => 'ini gambar Rendzina',
            'description' => 'Tanah yang memiliki tekstur lembut dan daya permeabilitas yang tinggi ini terbentuk dari batuan basalt, batu kapur dan granit. Karena daya permeabilitas yang dimilikinya cukup tinggi membuat tanah ini mampu untuk menikat air.',
            'nitrogen' => (float)mt_rand(0, 10),
            'phospor' => (float)mt_rand(0, 10),
            'calium' => (float)mt_rand(0, 10),
            'ph' => (float)mt_rand(0, 10),
            'temp' => (float)mt_rand(0, 10),
            'humidity' => (float)mt_rand(0, 10),
        ]);
    }
}
