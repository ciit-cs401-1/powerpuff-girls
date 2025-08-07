<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition(): array
    {
        return [
            'post_id' => Post::inRandomOrder()->first()->id ?? Post::factory(),
            'name' => $this->faker->name,
            'body' => $this->faker->paragraph,
        ];
    }
}
