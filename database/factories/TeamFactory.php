<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'fullname'=> fake()->name(),       
            'designation'=> fake()->jobTitle(),       
            'telephone'=> fake()->phoneNumber(),       
            'mobile'=> fake()->phoneNumber(),       
            'email' => fake()->unique()->safeEmail,       
            'facebook_id'=> fake()->safeEmail(),       
            'twitter_id'=> fake()->safeEmail(),       
            'pinterest_id'=> fake()->safeEmail(),       
            'profile'=> fake()->paragraph(),       
            'team_img'=> 'No image found',       
            'status'=> fake()->randomElement(['ACTIVE', 'DEACTIVE']),       
        ];
    }
}
