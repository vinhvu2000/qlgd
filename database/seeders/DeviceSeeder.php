<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=100; $i <= 200; $i++) { 
            $b = "K";
            $r = "100";
            if($i<150) {
                $b = "C";
                $r = "100";
            }
            DB::table('device')->insert([
                'deviceID' => "SPE$i",
                'deviceName' => "Loa JVL245",
                'roomID' => $r,
                'buildingID' => $b
            ]);
        }
    }
}
