<?php

namespace Database\Factories;

use App\Models\Movie;
use App\Models\Country;
use App\Models\Industry;
use App\Models\OTTProvider;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Movie::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'name' => $this->faker->word,
            'release_year' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'description' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'photo' => $this->faker->imageUrl($width = 640, $height = 480),
            'imdb_link' => $this->faker->url,
            'imdb_rating' => $this->faker->randomFloat($nbMaxDecimals = NULL, $min = 1, $max =5),
            'rotten_tomatoes_link' => $this->faker->url,
            'rotten_tomatoes_rating' => $this->faker->randomFloat($nbMaxDecimals = NULL, $min = 1, $max =5),
            'industry_id' => Industry::all()->random()->id,
            'o_t_t_provider_id' => OTTProvider::all()->random()->id
        ];
    }
}
