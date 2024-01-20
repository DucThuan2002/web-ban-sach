<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Roles;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Truncate the Roles table
        Roles::truncate();

        // Create new roles
        Roles::create(['name' => 'admin']);
        Roles::create(['name' => 'author']);
        Roles::create(['name' => 'user']);
    }
}
