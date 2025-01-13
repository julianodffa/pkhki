<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // Membuat 3 Author menggunakan factory
        Author::factory(3)->create();

        // Membuat 5 Category menggunakan factory
        Category::factory(3)->create();

        // Membuat 20 Publication menggunakan factory
        // Publication::factory(2)->create()->each(function ($publication) {
        //     // Mengaitkan kategori acak ke publication
        //     $categories = Category::inRandomOrder()->take(rand(1, 3))->pluck('id');
        //     $publication->categories()->attach($categories);
        // });
    }
}
