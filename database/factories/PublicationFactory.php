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
            'cover' => asset('assets/testing/publications/covers/Untitled.png'),
            'title' => $this->faker->sentence,
            'slug' => $this->faker->slug,
            'excerpt' => $this->faker->text,
            'content' => asset('assets/testing/publications/index.html'),
            'user_id' => User::where('role', '!=', 'superadmin')->inRandomOrder()->first()->id
        ];
    }
}
