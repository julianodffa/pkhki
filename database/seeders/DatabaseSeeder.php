<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Category;
use App\Models\Publication;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
        User::create([
            "name" => "Super Admin",
            "username" => "superadmin",
            "email" => "superadmin@pkhki.com",
            "password" => Hash::make("pkhki098"),
            "role" => "superadmin",
        ]);

        User::create([
            "name" => "Customer Support",
            "username" => "admin",
            "email" => "admin@pkhki.com",
            "password" => Hash::make("pkhki098"),
            "role" => "admin",
        ]);

        Category::create([
            "name" => "Berita",
            "slug" => "berita",
        ]);

        Category::create([
            "name" => "Kegiatan",
            "slug" => "kegiatan",
        ]);

        // Stucture Organization
        Role::create([
            "name" => "Dewan Kehormatan",
            "slug" => "dewan-kehormatan",
        ]);

        Role::create([
            "name" => "Pengurus",
            "slug" => "pengurus",
        ]);

        Role::create([
            "name" => "Dewan Standar",
            "slug" => "dewan-standar",
        ]);
    }
}
