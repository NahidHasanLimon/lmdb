<?php

namespace Database\Factories;

use App\Models\MovieIndustry;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieIndustryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MovieIndustry::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        ];
    }
}
