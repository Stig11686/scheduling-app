<?php

namespace Database\Seeders;

use App\Models\Cohort;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CohortSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cohorts = [
            ['name' => 'Software Developers October 22', 'places' => 24],
            ['name' => 'Software Testers October 22', 'places' => 24 ],
            ['name' => 'Software Testers November 22', 'places' => 24],
            ['name' => 'Essential Skills in Agile & Tech October 22', 'places' => 24],
            ['name' => 'Essential Skills for Digital Project Managers October 22', 'places' => 24],
        ];

        foreach($cohorts as $cohort){
           Cohort::create($cohort);
        }
    }
}
