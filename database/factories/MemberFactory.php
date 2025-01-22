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
            'ktp' => asset('assets/testing/members/ktp/ktp.png'),
            'photo' => asset('assets/testing/members/photo/photo.png'),
            'institution' => $this->faker->company(),
            'position' => $this->faker->jobTitle(),
            'company_email' => $this->faker->companyEmail(),
            'is_member_of_other_legal_association' => false,
            'immigration_law_consultant_certificate' => asset('assets/testing/members/ilc_certificate/SKL-JulianoDA-2018230089.pdf'),
            'other_certificates' => [asset('assets/testing/members/other_certificate/PKHKI.pdf')],
            'is_accepted_as_member' => false,
        ];
    }
}
