<?php

namespace Database\Seeders\production;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => "pupukin",
            'email' => 'pupukin@gmail.com',
            'password' => Hash::make('password'),
            'created_at' => date('Y-m-d H:i:sO', time()),
            'updated_at' => date('Y-m-d H:i:sO', time())
        ]);

        DB::table('users')->insert([
            'username' => "Jeffry",
            'email' => 'jeffry@gmail.com',
            'password' => Hash::make('password'),
            'created_at' => date('Y-m-d H:i:sO', time()),
            'updated_at' => date('Y-m-d H:i:sO', time())
        ]);
    }
}
