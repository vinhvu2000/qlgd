<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(BuildingSeeder::class);
        $this->call(RoomSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(DeviceSeeder::class);
        $this->call(ScheduleSeeder::class);
    }
}
