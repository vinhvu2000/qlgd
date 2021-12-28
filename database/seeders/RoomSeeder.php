<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<=3;$i++){
            for ($j=1; $j <= 5; $j++) { 
                DB::table('room')->insert([
                    'roomID' => $i.'0'.$j,
                    'buildingID' => "C"
                ]);
            }
        }
        for($i=1;$i<=2;$i++){
            for ($j=1; $j <= 5; $j++) { 
                DB::table('room')->insert([
                    'roomID' => $i.'0'.$j,
                    'buildingID' => "K1"
                ]);
            }
        }
        DB::table('room')->insert([
            'roomID' => '100',
            'buildingID' => "C"
        ]);
        DB::table('room')->insert([
            'roomID' => '100',
            'buildingID' => "K1"
        ]);
    }
}
