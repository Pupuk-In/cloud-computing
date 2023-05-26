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
        $fertilizers = array(
            "Nitrogen",
            "Phosphorus",
            "Potassium",
            "Ammonium nitrate",
            "Urea",
            "Diammonium phosphate",
            "Superphosphate",
            "Potassium nitrate",
            "Calcium nitrate",
            "Ammonium sulfate",
            "Triple superphosphate",
            "Bone meal",
            "Blood meal",
            "Fish emulsion",
            "Compost",
            "Manure",
            "Seaweed fertilizer",
            "Wood ash",
            "Gypsum",
            "Epsom salt",
            "Humic acid",
            "Bat guano",
            "Feather meal",
            "Cottonseed meal",
            "Alfalfa meal",
            "Kelp meal",
            "Rock phosphate",
            "Greensand",
            "Azomite",
            "Sulfur",
            "Boron",
            "Iron",
            "Magnesium",
            "Manganese",
            "Zinc",
            "Copper",
            "Molybdenum",
            "Selenium",
            "Cobalt",
            "Lime",
            "Dolomite",
            "Granite dust",
            "Zeolite",
            "Vermiculite",
            "Perlite",
            "Peat moss",
            "Coco coir",
            "Biochar",
            "Worm castings",
            "Mycorrhizae"
        );

        $brands = array(
            "HarvestPro",
            "GreenGrove",
            "CropTech",
            "FarmFresh",
            "AgriMax",
            "EcoGrow",
            "Nature'sBest",
            "AgroSolutions",
            "FarmersChoice",
            "AgriVital",
            "FarmTech",
            "AgroPro",
            "GrowGuard",
            "FieldMaster",
            "AgriHarvest",
            "AgroElite",
            "CropCare",
            "FarmFirst",
            "AgriEdge",
            "HarvestGuard"
        );

        function itemDescGen(){
            $words = array(
                "agriculture", "farmers", "crops", "harvest", "sustainability",
                "fertilizers", "irrigation", "market", "livestock", "crop rotation",
                "supply chain", "technology", "innovation", "sustainable practices",
                "agritech", "organic farming", "food security", "rural development",
                "agribusiness", "crop protection", "soil health", "greenhouse", "precision farming",
                "drones", "smart farming", "vertical farming", "agronomy", "biotechnology",
                "horticulture", "seed industry", "poultry", "aquaculture", "food processing",
                "rural entrepreneurship", "market access", "commodity trading", "livestock management",
                "agricultural machinery", "agricultural finance", "agricultural research",
                "sustainable agriculture", "agroecology", "agricultural policy", "agricultural education"
            );

            $description = "";
            for ($i = 0; $i < 40; $i++) {
                $randomWord = $words[array_rand($words)];
                $description .= $randomWord . " ";
            }

            $description = trim($description);
            return $description;
        }
        
        for ($i = 0; $i < 50; $i++) {
            DB::table('items')->insert([
                'name' => $fertilizers[array_rand($fertilizers)],
                'picture' => "https://saraswantifertilizer.com/wp-content/uploads/2021/03/Front-Banner-Merk-koka.png",
                'description' => itemDescGen(),
                'price' => mt_rand(5000, 100000),
                'stock' => mt_rand(50, 200),
                'sold' => 0,
                'rating' => (mt_rand(0, 4) + (mt_rand(0, 9)/10)),
                'brand' => $brands[array_rand($brands)],
                'store_id' => rand(1, 5),
                'created_at' => date('Y-m-d H:i:sO', time()),
                'updated_at' => date('Y-m-d H:i:sO', time())
            ]);
        }
    }
}