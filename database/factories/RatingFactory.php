<?php

namespace Database\Factories;

use App\Models\Rating;
use Illuminate\Database\Eloquent\Factories\Factory;

class RatingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rating::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      return [
          'score' => $this->faker->numberBetween(1,5),
          'user_address' => $this->faker->numberBetween(0,255).'.'.$this->faker->numberBetween(0,255).'.'.$this->faker->numberBetween(0,255),
      ];
    }
}
