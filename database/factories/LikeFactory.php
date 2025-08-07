<?php

namespace Database\Factories;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikeFactory extends Factory
{
    protected $model = Like::class;

    public function definition(): array
    {
        return [
            'post_id' => Post::inRandomOrder()->first()->id ?? Post::factory(),
            'ip_address' => $this->faker->ipv4,
        ];
    }
}
