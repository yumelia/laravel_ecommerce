<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('users')->delete();

        \App\Models\User::create([
            'name'=> 'Admin',
            'email'=> 'admin@gmail.com',
            'password'=> bcrypt('rahasia'),
            'isAdmin'=> 1,
        ]);

\App\Models\User::create([
    'name'=> 'Member',
    'email'=> 'member@gmail.com',
    'password'=> bcrypt('rahasia'),
    'isAdmin'=> 0,
]);
    }
}
