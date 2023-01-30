<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Database\Factories\UserFactory;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super_admin = User::create([
            'name' => 'Steve',
            'email' => 'stevenmarks75@gmail.com',
            'password' => bcrypt('Erding3r!')
        ]);

        $super_admin->assignRole('super-admin');

        $tcg_admin = User::create([
            'name' => 'tcg-admin',
            'email' => 'steve@thecodersguild.org.uk',
            'password' => bcrypt('Erding3r!')
        ]);

        $tcg_admin->assignRole('tcg-admin');

        $tcg_trainer = User::create([
            'name' => 'tcg-trainer',
            'email' => 'info@bvswebdesign.co.uk',
            'password' => bcrypt('Erding3r!')
        ]);

        $tcg_trainer->assignRole('tcg-trainer');

        $tcg_learner = User::create([
            'name' => 'tcg-learner',
            'email' => 'steven.marks@bvswebdesign.co.uk',
            'password' => bcrypt('Erding3r!')
        ]);

        $tcg_learner->assignRole('tcg-learner');

        User::factory(200)->create();
    }
}
