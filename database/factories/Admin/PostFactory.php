<?php

namespace Database\Factories\Admin;

use App\Models\Admin\Post;
use App\Models\Community;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $community = Community::inRandomOrder()->first();
        $user = User::inRandomOrder()->first();
        return [
            'title' => fake()->realText(45),
            'text' => fake()->realText(400),
            'author' => $user->id,
            'likes' => array_rand(range(0, 2000)),
            'comments' => array_rand(range(0, 2000)),
            'shares' => array_rand(range(0, 2000)),
            'community' => $community->id,
        ];
    }
}
