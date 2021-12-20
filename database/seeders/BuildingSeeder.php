<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('building')->insert([
            'buildingID' => "C",
            'status' => "Đang hoạt động"
        ]);
        DB::table('building')->insert([
            'buildingID' => "K1",
            'status' => "Đang hoạt động"
        ]);
    }
}
