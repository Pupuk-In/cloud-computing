<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            ProfileSeeder::class,
            StoreSeeder::class,
            SoilSeeder::class,
            PlantSeeder::class,
            TypeSeeder::class,
            PlantPartSeeder::class,
            ItemSeeder::class,
            PivotPlantSoil::class,
            PivotItemPlant::class,
            PivotItemPlantPart::class,
            WishlistSeeder::class,
        ]);
    }
}
