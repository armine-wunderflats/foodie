<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

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
            RolesTablesSeeder::class,
            AdminUserSeeder::class,
        ]);

        if (App::environment('local', 'staging')) {
            $this->call([
                UsersTableSeeder::class,
                RestaurantsTableSeeder::class,
                MealsTableSeeder::class,
            ]);
        }
    }
}
