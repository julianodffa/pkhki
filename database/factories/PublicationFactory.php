<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class PublicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cover' => 'assets/testing/publications/covers/Untitled.png',
            'cover_webp' => 'assets/testing/publications/covers/Untitled.webp',
            'title' => $this->faker->sentence,
            'slug' => $this->faker->slug,
            'excerpt' => $this->faker->text,
            'content' => 'assets/testing/publications/index.html',
            'user_id' => User::where('role', '!=', 'superadmin')->inRandomOrder()->first()->id
        ];
    }
}
