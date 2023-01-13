<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        {
            DB::table('users')->insert([
                'id'         => 1,
                'name' => 'ゲストユーザー',
                'email' => 'guest@guest.com',
                'password' => 'guest123',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
