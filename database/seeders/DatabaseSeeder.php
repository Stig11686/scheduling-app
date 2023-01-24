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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

            // Trainer::factory(10)->create();
            // Session::factory(100)->create();

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
