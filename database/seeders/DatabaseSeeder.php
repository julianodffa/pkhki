<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Category;
use App\Models\Publication;
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

        Author::create([
            "name" => "Customer Support",
            "slug" => "customer-support",
        ]);

        Category::create([
            "name" => "Berita",
            "slug" => "berita",
        ]);

        Category::create([
            "name" => "Kegiatan",
            "slug" => "kegiatan",
        ]);

        // Publication::factory(20)->create()->each(function ($publication) {
        //     // Mengaitkan kategori acak ke publication
        //     $categories = Category::inRandomOrder()->take(rand(1, 2))->pluck('id');
        //     $publication->categories()->attach($categories);
        // });
    }
}
