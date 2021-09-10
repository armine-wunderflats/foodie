<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class RestaurantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('restaurants')->insert([
            'name' => 'Little Sicily',
            'food_type' => 'Italian',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit, vehicula iaculis turpis feugiat aptent curabitur, class sapien laoreet sagittis.",
            'owner_id' => 4,
        ]);

        DB::table('restaurants')->insert([
            'name' => 'McDonald\'s',
            'food_type' => 'Fast Food',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit, vehicula iaculis turpis feugiat aptent curabitur, class sapien laoreet sagittis.",
            'owner_id' => 5,
        ]);

        DB::table('restaurants')->insert([
            'name' => 'Panda Express',
            'food_type' => 'Fast Food, Asian',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit, vehicula iaculis turpis feugiat aptent curabitur, class sapien laoreet sagittis.",
            'owner_id' => 6,
        ]);

        DB::table('restaurants')->insert([
            'name' => 'Dragon Palace',
            'food_type' => 'Chinese',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit, vehicula iaculis turpis feugiat aptent curabitur, class sapien laoreet sagittis.",
            'owner_id' => 7,
        ]);

        DB::table('restaurants')->insert([
            'name' => 'Pizza Hut',
            'food_type' => 'Fast Food',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit, vehicula iaculis turpis feugiat aptent curabitur, class sapien laoreet sagittis.",
            'owner_id' => 8,
        ]);

        DB::table('restaurants')->insert([
            'name' => 'Chipotle',
            'food_type' => 'Mexican',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit, vehicula iaculis turpis feugiat aptent curabitur, class sapien laoreet sagittis.",
            'owner_id' => 9,
        ]);

        DB::table('restaurants')->insert([
            'name' => 'Black Angus',
            'food_type' => 'American, Steakhouse',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit, vehicula iaculis turpis feugiat aptent curabitur, class sapien laoreet sagittis.",
            'owner_id' => 10,
        ]);

        DB::table('restaurants')->insert([
            'name' => 'Murakami',
            'food_type' => 'Japanese, Sushi',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit, vehicula iaculis turpis feugiat aptent curabitur, class sapien laoreet sagittis.",
            'owner_id' => 11,
        ]);

        DB::table('restaurants')->insert([
            'name' => 'Taj Mahal',
            'food_type' => 'Indian',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit, vehicula iaculis turpis feugiat aptent curabitur, class sapien laoreet sagittis.",
            'owner_id' => 12,
        ]);

        DB::table('restaurants')->insert([
            'name' => 'Dolma',
            'food_type' => 'Armenian',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit, vehicula iaculis turpis feugiat aptent curabitur, class sapien laoreet sagittis.",
            'owner_id' => 13,
        ]);

        DB::table('restaurants')->insert([
            'name' => 'Tamrap',
            'food_type' => 'Tai Food',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit, vehicula iaculis turpis feugiat aptent curabitur, class sapien laoreet sagittis.",
            'owner_id' => 14,
        ]);

        DB::table('restaurants')->insert([
            'name' => 'Nihon Ryori',
            'food_type' => 'Japanese',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit, vehicula iaculis turpis feugiat aptent curabitur, class sapien laoreet sagittis.",
            'owner_id' => 15,
        ]);

        DB::table('restaurants')->insert([
            'name' => 'Ararat Tavern',
            'food_type' => 'Armenian',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit, vehicula iaculis turpis feugiat aptent curabitur, class sapien laoreet sagittis.",
            'owner_id' => 16,
        ]);

        DB::table('restaurants')->insert([
            'name' => 'Seoul BBQ',
            'food_type' => 'Korean, BBQ',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit, vehicula iaculis turpis feugiat aptent curabitur, class sapien laoreet sagittis.",
            'owner_id' => 17,
        ]);
    }
}
