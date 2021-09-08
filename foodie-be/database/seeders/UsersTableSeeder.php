<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'visitor1',
            'email' => 'visitor1@gmail.com',
            'password' => Hash::make('visitor1'),
        ]);
        $user->assignRole('visitor');

        $user = User::create([
            'name' => 'visitor2',
            'email' => 'visitor2@gmail.com',
            'password' => Hash::make('visitor2'),
        ]);
        $user->assignRole('visitor');

        $user = User::create([
            'name' => 'LittleSicily',
            'email' => 'LittleSicily@gmail.com',
            'password' => Hash::make('LittleSicily'),
        ]);
        $user->assignRole('owner');

        $user = User::create([
            'name' => 'McDonalds',
            'email' => 'McDonalds@gmail.com',
            'password' => Hash::make('McDonalds'),
        ]);
        $user->assignRole('owner');

        $user = User::create([
            'name' => 'PandaExpress',
            'email' => 'PandaExpress@gmail.com',
            'password' => Hash::make('PandaExpress'),
        ]);
        $user->assignRole('owner');

        $user = User::create([
            'name' => 'DragonPalace',
            'email' => 'DragonPalace@gmail.com',
            'password' => Hash::make('DragonPalace'),
        ]);
        $user->assignRole('owner');

        $user = User::create([
            'name' => 'PizzaHut',
            'email' => 'PizzaHut@gmail.com',
            'password' => Hash::make('PizzaHut'),
        ]);
        $user->assignRole('owner');

        $user = User::create([
            'name' => 'Chipotle',
            'email' => 'Chipotle@gmail.com',
            'password' => Hash::make('Chipotle'),
        ]);
        $user->assignRole('owner');

        $user = User::create([
            'name' => 'BlackAngus',
            'email' => 'BlackAngus@gmail.com',
            'password' => Hash::make('BlackAngus'),
        ]);
        $user->assignRole('owner');

        $user = User::create([
            'name' => 'Murakami',
            'email' => 'Murakami@gmail.com',
            'password' => Hash::make('Murakami'),
        ]);
        $user->assignRole('owner');

        $user = User::create([
            'name' => 'TajMahal',
            'email' => 'TajMahal@gmail.com',
            'password' => Hash::make('TajMahal'),
        ]);
        $user->assignRole('owner');

        $user = User::create([
            'name' => 'Dolma',
            'email' => 'Dolma@gmail.com',
            'password' => Hash::make('Dolma'),
        ]);
        $user->assignRole('owner');

        $user = User::create([
            'name' => 'Tamrap',
            'email' => 'Tamrap@gmail.com',
            'password' => Hash::make('Tamrap'),
        ]);
        $user->assignRole('owner');

        $user = User::create([
            'name' => 'NihonRyori',
            'email' => 'NihonRyori@gmail.com',
            'password' => Hash::make('NihonRyori'),
        ]);
        $user->assignRole('owner');

        $user = User::create([
            'name' => 'AraratTavern',
            'email' => 'AraratTavern@gmail.com',
            'password' => Hash::make('AraratTavern'),
        ]);
        $user->assignRole('owner');

        $user = User::create([
            'name' => 'SeoulBBQ',
            'email' => 'SeoulBBQ@gmail.com',
            'password' => Hash::make('SeoulBBQ'),
        ]);
        $user->assignRole('owner');
    }
}
