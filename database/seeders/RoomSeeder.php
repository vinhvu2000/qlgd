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
        DB::table('room')->insert([
            'roomID' => "309",
            'buildingID' => "C"
        ]);
        DB::table('room')->insert([
            'roomID' => "408",
            'buildingID' => "C"
        ]);
        DB::table('room')->insert([
            'roomID' => "416",
            'buildingID' => "C"
        ]);
        DB::table('room')->insert([
            'roomID' => "411",
            'buildingID' => "C"
        ]);
        DB::table('room')->insert([
            'roomID' => "203",
            'buildingID' => "K1"
        ]);
        DB::table('room')->insert([
            'roomID' => "401",
            'buildingID' => "K1"
        ]);
        DB::table('room')->insert([
            'roomID' => "901",
            'buildingID' => "K1"
        ]);
        DB::table('room')->insert([
            'roomID' => "902",
            'buildingID' => "K1"
        ]);
        DB::table('room')->insert([
            'roomID' => "903",
            'buildingID' => "K1"
        ]);
        DB::table('room')->insert([
            'roomID' => "904",
            'buildingID' => "K1"
        ]);
        DB::table('room')->insert([
            'roomID' => "905",
            'buildingID' => "K1"
        ]);
        DB::table('room')->insert([
            'roomID' => "906",
            'buildingID' => "K1"
        ]);
        DB::table('room')->insert([
            'roomID' => "506",
            'buildingID' => "K1"
        ]);
        DB::table('room')->insert([
            'roomID' => "507",
            'buildingID' => "K1"
        ]);
    }
}
