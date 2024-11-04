<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Media>
 */
class MediaFactory extends Factory
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
            'title'=> $title,
            'slug'=> Str::slug($title),
            'media_type'=> fake()->randomElement(['image', 'video', 'audio', 'slider']),
            'media_img'=> 'No image found',
            'description'=> fake()->text($maxNbChars = 200),
            'status'=> fake()->randomElement(['ACTIVE', 'DEACTIVE']),
        ];
    }
}
