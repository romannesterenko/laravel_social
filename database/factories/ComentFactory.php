<?php

namespace Database\Factories;

use App\Models\Admin\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coment>
 */
class ComentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $post = Post::inRandomOrder()->first();
        $user = User::inRandomOrder()->first();
        return [
            'text' => fake()->realText(200),
            'post' => $post->id,
            'user' => $user->id,
            'parent_id' => array_rand(range(1, 800)),
            'likes' => 0,
            'level' => array_rand(range(1, 3)),
            'dislikes' => 0
        ];
    }
}
