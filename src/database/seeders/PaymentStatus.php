<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentStatus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_statuses')->insert([
            'name' => 'Belum Bayar',
            'description' => "bla bla bla",
            'created_at' => date('Y-m-d H:i:sO', time()),
            'updated_at' => date('Y-m-d H:i:sO', time())
        ]);

        DB::table('payment_statuses')->insert([
            'name' => 'Sudah Bayar',
            'description' => "bla bla bla",
            'created_at' => date('Y-m-d H:i:sO', time()),
            'updated_at' => date('Y-m-d H:i:sO', time())
        ]);
    }
}
