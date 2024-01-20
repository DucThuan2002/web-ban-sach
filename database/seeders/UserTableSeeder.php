<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Roles;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Truncate the Roles table
        User::truncate();

        // tạo roles
        $adminRole = Roles::where('name', 'admin')->first();
        $authorRole = Roles::where('name', 'author')->first();
        $userRole = Roles::where('name', 'user')->first();

        // tạo user
        $admin = User::create([
            'name' => 'thuanadmin',
            'email' => 'thuank7b3@gmail.com',
            'password' => Hash::make('1234')
        ]);

        $author = User::create([
            'name' => 'thuanauthor',
            'email' => 'thuank7b@gmail.com',
            'password' => Hash::make('1234')
        ]);

        $user = User::create([
            'name' => 'thuanuser',
            'email' => '20521993@gm.uit.edu.vn',
            'password' => Hash::make('1234')
        ]);

        // gán quyền
        $admin->roles()->attach($adminRole);
        $author->roles()->attach($authorRole);
        $user->roles()->attach($userRole);


    }
}
