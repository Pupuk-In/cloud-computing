<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transaction_statuses')->insert([
            'name' => 'belum konfirmasi',
            'description' => "bla bla bla",
            'created_at' => date('Y-m-d H:i:sO', time()),
            'updated_at' => date('Y-m-d H:i:sO', time())
        ]);

        DB::table('transaction_statuses')->insert([
            'name' => 'sudah konfirmasi',
            'description' => "bla bla bla",
            'created_at' => date('Y-m-d H:i:sO', time()),
            'updated_at' => date('Y-m-d H:i:sO', time())
        ]);

        DB::table('transaction_statuses')->insert([
            'name' => 'dibatalkan',
            'description' => "bla bla bla",
            'created_at' => date('Y-m-d H:i:sO', time()),
            'updated_at' => date('Y-m-d H:i:sO', time())
        ]);

        DB::table('transaction_statuses')->insert([
            'name' => 'dikirim',
            'description' => "bla bla bla",
            'created_at' => date('Y-m-d H:i:sO', time()),
            'updated_at' => date('Y-m-d H:i:sO', time())
        ]);

        DB::table('transaction_statuses')->insert([
            'name' => 'terkirim',
            'description' => "bla bla bla",
            'created_at' => date('Y-m-d H:i:sO', time()),
            'updated_at' => date('Y-m-d H:i:sO', time())
        ]);

        DB::table('transaction_statuses')->insert([
            'name' => 'diterima',
            'description' => "bla bla bla",
            'created_at' => date('Y-m-d H:i:sO', time()),
            'updated_at' => date('Y-m-d H:i:sO', time())
        ]);

        DB::table('transaction_statuses')->insert([
            'name' => 'selesai',
            'description' => "bla bla bla",
            'created_at' => date('Y-m-d H:i:sO', time()),
            'updated_at' => date('Y-m-d H:i:sO', time())
        ]);
    }
}
