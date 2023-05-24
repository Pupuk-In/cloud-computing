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
        DB::table('types')->insert([
            'name' => 'urea',
            'picture' => 'ini gambar urea'
        ]);

        DB::table('types')->insert([
            'name' => 'npk',
            'picture' => 'ini gambar npk'
        ]);

        DB::table('types')->insert([
            'name' => 'phonska',
            'picture' => 'ini gambar phonska'
        ]);

        DB::table('types')->insert([
            'name' => 'kcl',
            'picture' => 'ini gambar kcl'
        ]);

        DB::table('types')->insert([
            'name' => 'sp-36',
            'picture' => 'ini gambar sp-36'
        ]);
    }
}
