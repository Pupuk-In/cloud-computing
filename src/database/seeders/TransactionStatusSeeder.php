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
            'name' => 'Belum Konfirmasi',
            'description' => "bla bla bla",
            'created_at' => date('Y-m-d H:i:sO', time()),
            'updated_at' => date('Y-m-d H:i:sO', time())
        ]);

        DB::table('transaction_statuses')->insert([
            'name' => 'Sudah Konfirmasi',
            'description' => "bla bla bla",
            'created_at' => date('Y-m-d H:i:sO', time()),
            'updated_at' => date('Y-m-d H:i:sO', time())
        ]);

        DB::table('transaction_statuses')->insert([
            'name' => 'Dibatalkan',
            'description' => "bla bla bla",
            'created_at' => date('Y-m-d H:i:sO', time()),
            'updated_at' => date('Y-m-d H:i:sO', time())
        ]);

        DB::table('transaction_statuses')->insert([
            'name' => 'Dikirim',
            'description' => "bla bla bla",
            'created_at' => date('Y-m-d H:i:sO', time()),
            'updated_at' => date('Y-m-d H:i:sO', time())
        ]);

        DB::table('transaction_statuses')->insert([
            'name' => 'Terkirim',
            'description' => "bla bla bla",
            'created_at' => date('Y-m-d H:i:sO', time()),
            'updated_at' => date('Y-m-d H:i:sO', time())
        ]);

        DB::table('transaction_statuses')->insert([
            'name' => 'Diterima',
            'description' => "bla bla bla",
            'created_at' => date('Y-m-d H:i:sO', time()),
            'updated_at' => date('Y-m-d H:i:sO', time())
        ]);

        DB::table('transaction_statuses')->insert([
            'name' => 'Selesai',
            'description' => "bla bla bla",
            'created_at' => date('Y-m-d H:i:sO', time()),
            'updated_at' => date('Y-m-d H:i:sO', time())
        ]);
    }
}
