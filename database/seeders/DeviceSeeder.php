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
            $b = "K1";
            if($i<150) {
                $b = "C";
            }
            DB::table('device')->insert([
                'deviceID' => "SPE$i",
                'deviceName' => "Loa JVL245",
                'roomID' => 100,
                'buildingID' => $b
            ]);
            DB::table('device')->insert([
                'deviceID' => "CAB$i",
                'deviceName' => "Cable HDMI 2.1",
                'roomID' => 100,
                'buildingID' => $b
            ]);
        }
        for($i=1;$i<=3;$i++){
            for ($j=1; $j <= 5; $j++) { 
                DB::table('device')->insert([
                    'deviceID' => "KEYC-$i"."0$j",
                    'deviceName' => "Chìa khóa phòng",
                    'roomID' => $i.'0'.$j,
                    'buildingID' => "C"
                ]);
                DB::table('device')->insert([
                    'deviceID' => "MICC-$i"."0$j",
                    'deviceName' => "Microphone",
                    'roomID' => $i.'0'.$j,
                    'buildingID' => "C"
                ]);
                DB::table('device')->insert([
                    'deviceID' => "REMC-$i"."0$j",
                    'deviceName' => "Điều khiển máy chiếu",
                    'roomID' => $i.'0'.$j,
                    'buildingID' => "C"
                ]);
                DB::table('device')->insert([
                    'deviceID' => "PJTC-$i"."0$j",
                    'deviceName' => "Máy chiếu ViewPanasonic K12",
                    'roomID' => $i.'0'.$j,
                    'buildingID' => "C"
                ]);
            }
        }
        for($i=1;$i<=2;$i++){
            for ($j=1; $j <= 5; $j++) { 
                DB::table('device')->insert([
                    'deviceID' => "KEYK1-$i"."0$j",
                    'deviceName' => "Chìa khóa phòng",
                    'roomID' => $i.'0'.$j,
                    'buildingID' => "K1"
                ]);
                DB::table('device')->insert([
                    'deviceID' => "MICK1-$i"."0$j",
                    'deviceName' => "Microphone",
                    'roomID' => $i.'0'.$j,
                    'buildingID' => "K1"
                ]);
                DB::table('device')->insert([
                    'deviceID' => "REMK1-$i"."0$j",
                    'deviceName' => "Điều khiển máy chiếu",
                    'roomID' => $i.'0'.$j,
                    'buildingID' => "K1"
                ]);
                DB::table('device')->insert([
                    'deviceID' => "PJTK1-$i"."0$j",
                    'deviceName' => "Máy chiếu ViewPanasonic K12",
                    'roomID' => $i.'0'.$j,
                    'buildingID' => "K1"
                ]);
            }
        }
    }
}
