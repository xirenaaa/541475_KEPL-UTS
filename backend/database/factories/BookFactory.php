<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'       => fake()->sentence(3),
            'author'      => fake()->name(),
            'isbn'        => fake()->unique()->isbn13(),
            'publisher'   => fake()->company(),
            'year'        => fake()->numberBetween(1950, 2026),
            'description' => fake()->paragraph(),
        ];
    }
}
