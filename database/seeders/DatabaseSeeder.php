<?php

namespace Database\Seeders;

use App\Models\InstanceSession;
use App\Models\Session;
use App\Models\Trainer;
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


            $this->call([
                ZoomRoomsSeeder::class,
                FundersSeeder::class,
                CourseSeeder::class,
                CohortSeeder::class,
                InstanceSeeder::class,
                RolesPermissionsSeeder::class,
                UserSeeder::class,
                TrainerSeeder::class,
                SessionSeeder::class,
                InstanceSessionSeeder::class
            ]);
    }
}
