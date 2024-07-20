<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Toy;
use App\Models\Category;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory(5)->create();

        Category::create(["name" => "puzzle"]);
        Category::create(["name" => "kartu"]);
        Category::create(["name" => "tradisional"]);

        Toy::factory(20)->create();
    }
}