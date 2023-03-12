<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $male = ['male', 'female'];
        $profs = ['Graphic Designer', 'Engineer', 'Driver', 'Home', 'Developer'];
        $countries = ['England', 'Poland', 'Ukraine', 'Russia', 'France', 'Germany'];
        $hobbies = ['', 'Tourism', 'Painting', 'Music', 'Travelling', 'Internet', 'Gaming'];
        return [
            'name' => fake()->firstName(rand(0, 1)),
            'last_name' => fake()->lastName(),
            'avatar' => 'Bwx2LHsq2LoRdRFMol6Gvmr4SCbRpecHDk7WEUWg.jpg',
            'fon_image' => '5TbxC07fPyIo7T7shc45Z1PiCJpqw5G9pWyFDI6f.jpg',
            'email' => fake()->unique()->safeEmail(),
            'gender' => $male[array_rand($male)],
            'profession' => $profs[array_rand($profs)],
            'hobby' => $hobbies[array_rand($hobbies)],
            'birthday' => fake()->date(),
            'about' => fake()->realText(100),
            'country' => $countries[array_rand($countries)],
            'email_verified_at' => now(),
            'password' => '90Tazuna',
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
