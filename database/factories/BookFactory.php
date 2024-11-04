<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = fake()->name();
        return [
            'category_id'=> fake()->numberBetween($min = 1, $max = 50),
            'author_id'=> fake()->numberBetween($min = 1, $max = 50),
            'title'=> $title,
            'slug'=> Str::slug($title),
            'availability'=> fake()->randomElement(['In Stock', 'Out Of Stock']),
            'price'=> fake()->numberBetween($min = 1000, $max = 10000),
            'rating'=> fake()->numberBetween(1, 5),
            'publisher'=> fake()->company(),
            'country_of_publisher'=> fake()->country(),
            'isbn'=> fake()->isbn13(),
            'isbn_10'=> fake()->isbn10(),
            'audience'=> fake()->randomElement(['general', 'children', 'teen', 'adult']),
            'format'=> fake()->randomElement(['hardcover', 'paperback', 'ebook']),
            'language'=> fake()->languageCode(),
            'total_pages'=> fake()->numberBetween(100, 1000),
            'downloaded'=> fake()->numberBetween(0, 10000),
            'edition_number'=> fake()->numberBetween(1, 10),
            'recommended'=> fake()->boolean(),
            'description'=> fake()->text($maxNbChars = 200),
            'book_img'=> 'No image found',
            'book_upload'=> fake()->fileExtension(),
            'status'=> fake()->randomElement(['ACTIVE', 'DEACTIVE', 'UPCOMING']),

        ];
    }
}
