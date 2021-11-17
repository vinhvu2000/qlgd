<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('users')->insert([
            'name' => "Quản trị hệ thống",
            'email' => "superadmin@hnue.edu.vn",
            'password' => Hash::make('12345678'),
            'role' => "superadmin",
            'avatar' => 'assets/images/avatar/user.png'
        ]);
        DB::table('users')->insert([
            'name' => "Quản lí nhà C",
            'email' => "adminC@hnue.edu.vn",
            'password' => Hash::make('12345678'),
            'role' => "admin",
            'avatar' => 'assets/images/avatar/user.png'
        ]);
        DB::table('users')->insert([
            'name' => "K68D CNTT",
            'email' => "K68DCNTT@hnue.edu.vn",
            'password' => Hash::make('12345678'),
            'role' => "user",
            'avatar' => 'assets/images/avatar/user.png'
        ]);
    }
}
