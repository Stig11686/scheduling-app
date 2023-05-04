<?php

namespace Database\Seeders;

use App\Models\Trainer;
use App\Models\Learner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

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

        $admin = User::create([
            'name' => 'admin',
            'email' => 'steve@thecodersguild.org.uk',
            'password' => bcrypt('Erding3r!')
        ]);

        $admin->assignRole('admin');

        $trainer = User::create([
            'name' => 'trainer',
            'email' => 'info@bvswebdesign.co.uk',
            'password' => bcrypt('Erding3r!')
        ]);

        $trainer->assignRole('trainer');

        $learner = User::create([
            'name' => 'learner',
            'email' => 'steven.marks@bvswebdesign.co.uk',
            'password' => bcrypt('Erding3r!')
        ]);

        $learner->assignRole('learner');

        $users = User::factory(200)->create([
            'password' => Hash::make('password')
        ]);

        $trainerUsers = $users->take(20);
        $trainerUsers->each(function($user){
            Trainer::factory()->create([
                'user_id' => $user->id
            ]);

            $user->assignRole('trainer');
        });

        $learnerUsers = $users->skip(20)->take(180);

        $learnerUsers->each(function($user){
            Learner::factory()->create([
                'user_id' => $user->id
            ]);

            $user->assignRole('learner');
        });

    }
}
