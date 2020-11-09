<?php

namespace Database\Factories;

use App\Models\OTTProvider;
use Illuminate\Database\Eloquent\Factories\Factory;

class OTTProviderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OTTProvider::class;

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
