<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'title' => fake()->title() ,
            'cover_art' =>fake()->imageUrl(),
            'developter' => fake()->name(),
            'release_year' =>fake()->year('now'),
            'genre'=> fake()-> text() 
        ];
    }
}
