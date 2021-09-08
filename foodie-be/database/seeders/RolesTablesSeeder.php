<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Reset cached roles
        app()['cache']->forget('spatie.permission.cache');

        $role = Role::create(['name' => 'admin']);
        $role = Role::create(['name' => 'visitor']);
        $role = Role::create(['name' => 'owner']);
    }
}
