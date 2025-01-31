<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->email(),
            'address' => $this->faker->address(),
            'institution' => $this->faker->company(),
            'position' => $this->faker->jobTitle(),
            'company_email' => $this->faker->companyEmail(),
            'is_member_of_other_legal_association' => false,
            'is_accepted_as_member' => false,
        ];
    }
}
