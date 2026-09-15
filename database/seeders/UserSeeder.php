<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('users')->insert(
            ['name' => 'Test','Email' => env('ADMIN_EMAIL'),'password' => Hash::make(env('ADMIN_PASS')), 'role_id' => 2, 'is_login'=>'0', 'is_active'=>'1','remember_token'=>null]
        );
    }
}
