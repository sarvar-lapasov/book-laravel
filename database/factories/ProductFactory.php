<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "category_id" => rand(1,5),
            // "name" => [
            //     "uz" =>'uz'. fake()->word(2),
            //     "en" => fake()->word(2)
            // ],
            // "description" => [
            //     "uz" =>'uz'. fake()->sentence(2),
            //     "en" => fake()->sentence(2)
            // ],
            // "text" => [
            //     "uz" =>'uz'. fake()->paragraph(15),
            //     "en" => fake()->paragraph(15)
            // ],
             "name" =>  fake()->word(2),
            "description" => fake()->sentence(2),
            "text" => fake()->paragraph(15),
            "price" => rand(5, 50),

        ];
    }
}
