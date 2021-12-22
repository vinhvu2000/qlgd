<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('device')->insert([
            'deviceID' => "MC309",
            'deviceName' => "Máy chiếu Viewsonic PA503SB",
            'roomID' => "309",
            'buildingID' => "C"
        ]);
    }
}
