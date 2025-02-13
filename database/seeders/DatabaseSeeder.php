<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Category;
use App\Models\Member;
use App\Models\Publication;
use App\Models\Role;
use App\Models\StructureOrganization;
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
            "email" => "superadmin@pkhki.com",
            "password" => Hash::make("pkhki098sa"),
            "role" => "superadmin",
        ]);

        User::create([
            "name" => "Customer Support",
            "email" => "admin@pkhki.com",
            "password" => Hash::make("pkhki098"),
            "role" => "admin",
        ]);

        User::create([
            "name" => "Juliano Daffa Adytia",
            "email" => "julianodaffaaa@gmail.com",
            "password" => Hash::make("Juliano332"),
            "role" => "admin",
        ]);

        // Publications
        Category::create([
            "name" => "Berita",
            "slug" => "berita",
        ]);

        Category::create([
            "name" => "Kegiatan",
            "slug" => "kegiatan",
        ]);

        // Membuat 51 Publication menggunakan factory
        // Publication::factory(51)->create()->each(function ($publication) {
        //     $categories = Category::inRandomOrder()->take(rand(1, 3))->pluck('id');
        //     $publication->categories()->attach($categories);
        // });

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

        StructureOrganization::create([
            'name' => 'Jufrian Murzal',
            'position' => 'Ketua Umum',
            'lawfirm' => 'Murzal and Partners',
            'email' => 'jufrianmurzal@pkhki.com',
            'role_id' => 1
        ]);

        StructureOrganization::create([
            'name' => 'James Junior',
            'position' => 'Wakil Ketua Umum Bidang Pendidikan dan Sertifikasi',
            'lawfirm' => 'Murzal and Partners',
            'email' => 'jamesjunior@pkhki.com',
            'role_id' => 1
        ]);

        StructureOrganization::create([
            'name' => 'Yanma Aditya Pratama',
            'position' => 'Wakil Ketua Umum Bidang Pendidikan dan Sertifikasi',
            'lawfirm' => 'Murzal and Partners',
            'email' => 'yanmap@pkhki.com',
            'role_id' => 1
        ]);

        StructureOrganization::create([
            'name' => 'Salsabila',
            'position' => 'Wakil Ketua Umum Bidang Pendidikan dan Sertifikasi',
            'lawfirm' => 'Murzal and Partners',
            'email' => 'salsabila@pkhki.com',
            'role_id' => 1
        ]);

        // Registrants
        // Member::factory(51)->create();

    }
}
