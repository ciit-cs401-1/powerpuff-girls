<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class PostFactory extends Factory
{
    public function definition(): array
    {
        $animal = $this->faker->randomElement([
            'dog', 'cat', 'puppy', 'kitten', 'rabbit', 'bird'
        ]);
        $location = $this->faker->streetName();

        $conditions = [
            'injured', 'sick', 'hungry', 'lost', 'alone',
            'wandering', 'tied up', 'dirty', 'cold', 'abandoned'
        ];

        $adjectives = [
            'friendly', 'scared', 'aggressive', 'timid',
            'playful', 'weak', 'alert', 'confused',
            'calm', 'dirty', 'young', 'shy', 'noisy', 'quiet', 'small'
        ];

        $situations = [
            "was seen near {$location}",
            "was found roaming around {$location}",
            "was reported by a local near {$location}",
            "was rescued from {$location}",
            "is staying around {$location}",
            "has been staying around {$location} for days",
        ];

        $isStray = $this->faker->boolean(70); // 70% stray, 30% pet
        $condition = $this->faker->randomElement($conditions);
        $adjective = $this->faker->randomElement($adjectives);
        $situation = $this->faker->randomElement($situations);

        $article = in_array(strtolower($adjective[0]), ['a', 'e', 'i', 'o', 'u']) ? 'an' : 'a';

        $title = $isStray
            ? "Stray {$animal} spotted near {$location}"
            : ucfirst($animal) . " sighting near {$location}";

        $content = $isStray
            ? ucfirst("{$article} {$adjective} and possibly {$condition} {$animal} {$situation}. Locals are encouraged to offer help and contact shelters.")
            : ucfirst("{$article} {$adjective} {$animal} {$situation}. If this is your pet, please check the area or post about it in your local group.");

        $postTypes = ['devlog', 'home'];
        $postType = $this->faker->randomElement($postTypes);

        return [
            'title' => $title,
            'content' => $content,
            'post_type' => $postType,
            'created_at' => Carbon::now('Asia/Manila'),
            'updated_at' => Carbon::now('Asia/Manila'),
        ];
    }
}
