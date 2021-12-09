<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->name(mt_rand(1,3)),
            'jk' => $this->faker->randomElement(['L', 'P']),
            'ttl' => $this->faker->dateTime(),
            'alamat' => $this->faker->address()
        ];
    }
}