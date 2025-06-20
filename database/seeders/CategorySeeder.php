<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('categories')->delete();
        \App\Models\Category::create([
            'name' => 'Fahsion',
            'slug' => 'fahsion',
        ]);

        \App\Models\Category::create([
            'name' => 'Teknologi',
            'slug' => 'teknologi',
        ]);
    }
}
