<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'      => $this->faker->company,
            'address'   => $this->faker->address,
            'logo'      => $this->faker->imageUrl,
            'website'   => $this->faker->url,
        ];
    }
}
