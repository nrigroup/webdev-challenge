<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "date" => $this->faker->date("m/d/Y"),
            "category" => $this->faker->randomElement(["Construction", "Mining", "Plastics & Rubber", "Computer - Hardware", "Computer – Software"]),
            "lot title" => implode(" ", $this->faker->words(3)),
            "lot location" => $this->faker->streetAddress(),
            "lot condition" => $this->faker->randomElement(["Brand New", "Used", "For parts or not working", "Like Brand New"]),
            "pre-tax amount" => $this->faker->randomFloat(null, $min=0, $max=1000),
            "tax name" => $this->faker->randomElement([null, "NY Sales tax", "CA Sales tax"]),
            "tax amount" => $this->faker->randomFloat(null, $min=0, $max=1000)
        ];
    }
}
