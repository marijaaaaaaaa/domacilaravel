<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Attraction;
use App\Models\City;
use App\Models\Country;
use App\Models\User;
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
        User::truncate();
        Country::truncate();
        City::truncate();
        Attraction::truncate();

        User::factory(2)->create();

        Country::factory(5)
            ->has(City::factory(5)
                ->has(Attraction::factory(5)))
            ->create();
    }
}
