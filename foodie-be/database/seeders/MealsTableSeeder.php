<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class MealsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('meals')->insert([
            'name' => 'Pepperoni Pizza',
            'price' => '12',
            'restaurant_id' => '1',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'New York-Style Pizza',
            'price' => '16',
            'restaurant_id' => '1',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Margherita Pizza',
            'price' => '15',
            'restaurant_id' => '1',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Veggie Pizza',
            'price' => '22',
            'restaurant_id' => '1',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Sicilian Pizza',
            'price' => '14',
            'restaurant_id' => '1',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Hamburger',
            'price' => '7',
            'restaurant_id' => '2',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Cheeseburger',
            'price' => '7',
            'restaurant_id' => '2',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Big Mac',
            'price' => '10',
            'restaurant_id' => '2',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Double Cheeseburger',
            'price' => '12',
            'restaurant_id' => '2',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Double Hamburger',
            'price' => '12',
            'restaurant_id' => '2',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Orange Chicken',
            'price' => '10',
            'restaurant_id' => '3',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Kung Pao Chicken',
            'price' => '15',
            'restaurant_id' => '3',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Beijing Beef',
            'price' => '17',
            'restaurant_id' => '3',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Honey Walnut Shrimp',
            'price' => '15',
            'restaurant_id' => '3',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Dumplings',
            'price' => '10',
            'restaurant_id' => '4',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Rice Porridge',
            'price' => '8',
            'restaurant_id' => '4',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Egg Rolls',
            'price' => '8',
            'restaurant_id' => '4',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Hot and Sour Soup',
            'price' => '8',
            'restaurant_id' => '4',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Pork Noodles',
            'price' => '10',
            'restaurant_id' => '4',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Double Cheese Pizza',
            'price' => '10',
            'restaurant_id' => '5',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Hawaiian Pizza',
            'price' => '10',
            'restaurant_id' => '5',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Fiery Chicken Pizza',
            'price' => '10',
            'restaurant_id' => '5',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Chicago Pizza',
            'price' => '10',
            'restaurant_id' => '5',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Pepperoni Pizza',
            'price' => '14',
            'restaurant_id' => '5',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Burrito Bowl',
            'price' => '9',
            'restaurant_id' => '6',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Quesadillas',
            'price' => '9',
            'restaurant_id' => '6',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Nachos',
            'price' => '10',
            'restaurant_id' => '6',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Pork Chops',
            'price' => '18',
            'restaurant_id' => '7',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Veal Chops',
            'price' => '18',
            'restaurant_id' => '7',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Lamb Chops',
            'price' => '20',
            'restaurant_id' => '7',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Lobster',
            'price' => '24',
            'restaurant_id' => '7',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Rib Eye',
            'price' => '20',
            'restaurant_id' => '7',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Tomato Soup',
            'price' => '16',
            'restaurant_id' => '7',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Philadelphia Roll',
            'price' => '15',
            'restaurant_id' => '8',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Makizushi',
            'price' => '20',
            'restaurant_id' => '8',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Unagizushi',
            'price' => '24',
            'restaurant_id' => '8',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'California Roll',
            'price' => '25',
            'restaurant_id' => '8',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Nigirizushi',
            'price' => '28',
            'restaurant_id' => '8',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Shrimp Tempura Roll',
            'price' => '25',
            'restaurant_id' => '8',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Spicy Tuna Roll',
            'price' => '25',
            'restaurant_id' => '8',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Rainbow Roll',
            'price' => '20',
            'restaurant_id' => '8',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Hot Tuna Roll',
            'price' => '23',
            'restaurant_id' => '8',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'King Crab Roll',
            'price' => '19',
            'restaurant_id' => '8',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Naan',
            'price' => '10',
            'restaurant_id' => '9',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Curry Bowl',
            'price' => '15',
            'restaurant_id' => '9',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Paneer Chilli',
            'price' => '16',
            'restaurant_id' => '9',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Dahi Papadi',
            'price' => '21',
            'restaurant_id' => '9',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Taboule',
            'price' => '16',
            'restaurant_id' => '10',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Armenian BBQ',
            'price' => '25',
            'restaurant_id' => '10',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Veal Dolma',
            'price' => '20',
            'restaurant_id' => '10',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Vegetarian Dolma',
            'price' => '22',
            'restaurant_id' => '10',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Lavash',
            'price' => '8',
            'restaurant_id' => '10',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Lentil soup',
            'price' => '12',
            'restaurant_id' => '10',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Lahmajun',
            'price' => '16',
            'restaurant_id' => '10',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Trout BBQ',
            'price' => '19',
            'restaurant_id' => '10',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Trout BBQ',
            'price' => '19',
            'restaurant_id' => '10',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Chicker and Corn Soup',
            'price' => '12',
            'restaurant_id' => '11',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Vegetarian Wonton Soup',
            'price' => '16',
            'restaurant_id' => '11',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Braised Beef',
            'price' => '20',
            'restaurant_id' => '11',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Egg Fried Rice',
            'price' => '20',
            'restaurant_id' => '11',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Cha Jiang Rice with Minced Pork',
            'price' => '20',
            'restaurant_id' => '11',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Gyoza',
            'price' => '18',
            'restaurant_id' => '12',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Yakisoba',
            'price' => '16',
            'restaurant_id' => '12',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Udon Soup',
            'price' => '16',
            'restaurant_id' => '12',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Miso Ramen',
            'price' => '16',
            'restaurant_id' => '12',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Okonomiyaki',
            'price' => '15',
            'restaurant_id' => '12',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Tamagoyaki',
            'price' => '15',
            'restaurant_id' => '12',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Takoyaki',
            'price' => '16',
            'restaurant_id' => '12',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Sashimi',
            'price' => '20',
            'restaurant_id' => '12',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Pork Khorovats',
            'price' => '22',
            'restaurant_id' => '13',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Lamb Khorovats',
            'price' => '25',
            'restaurant_id' => '13',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Harisa',
            'price' => '18',
            'restaurant_id' => '13',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Khash',
            'price' => '20',
            'restaurant_id' => '13',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Hummus',
            'price' => '8',
            'restaurant_id' => '13',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Sorrel Soup',
            'price' => '10',
            'restaurant_id' => '13',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Fied Pork',
            'price' => '17',
            'restaurant_id' => '13',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Summer Dolma',
            'price' => '18',
            'restaurant_id' => '13',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Pakhlava',
            'price' => '9',
            'restaurant_id' => '13',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Kimchi Stew',
            'price' => '10',
            'restaurant_id' => '14',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Tubu Chorim',
            'price' => '10',
            'restaurant_id' => '14',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Pullogs',
            'price' => '12',
            'restaurant_id' => '14',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Beef with Vegetables',
            'price' => '12',
            'restaurant_id' => '14',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);

        DB::table('meals')->insert([
            'name' => 'Kimbap',
            'price' => '15',
            'restaurant_id' => '14',
            'description' => "Lorem ipsum posuere commodo cursus dictumst habitasse curae dolor commodo, sollicitudin vestibulum sed tempor integer feugiat vitae at aenean sapien ullamcorper nostra malesuada blandit.",
        ]);
    }
}
