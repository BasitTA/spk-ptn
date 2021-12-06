<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KriteriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'kode'=>$this->faker->randomElements(['C1','C2','C3','C4','C5']),
            'nama'=>$this->faker->word(),
            'pembobotan_kriteria'=>$this->faker->words()
        ];
    }
}
