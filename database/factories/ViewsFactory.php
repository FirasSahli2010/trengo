<?php

namespace Database\Factories;

use App\Models\Views;
use Illuminate\Database\Eloquent\Factories\Factory;

class ViewsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Views::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'user_address' => $this->faker->numberBetween(0,255).'.'.$this->faker->numberBetween(0,255).'.'.$this->faker->numberBetween(0,255),
        ];
    }
}
