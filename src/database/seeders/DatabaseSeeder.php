<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\PaymentMethod;
use Database\Seeders\production\UserSeeder;
use Database\Seeders\production\ProfileSeeder;
use Database\Seeders\production\StoreSeeder;
use Database\Seeders\production\CartSeeder;
use Database\Seeders\production\SoilSeeder;
use Database\Seeders\production\PivotPlantSoil;
use Database\Seeders\production\WishlistSeeder;

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
            CartSeeder::class,
            PaymentMethodSeeder::class,
            PaymentStatus::class,
            TransactionStatusSeeder::class,

            // SoilSeeder::class,
            PlantSeeder::class,
            TypeSeeder::class,
            PlantPartSeeder::class,
            ItemSeeder::class,
            // PivotPlantSoil::class,
            PivotItemPlant::class,
            PivotItemPlantPart::class,
            // WishlistSeeder::class,
            ItemPicture::class,
        ]);
    }
}
