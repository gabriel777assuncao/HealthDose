<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    protected $model = Question::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'body' => $this->faker->paragraph(),
            'view_count' => $this->faker->numberBetween(0, 50),
            'like_count' => $this->faker->numberBetween(0, 20),
            'dislike_count' => $this->faker->numberBetween(0, 10),
            'reply_count' => 0,
        ];
    }
}
