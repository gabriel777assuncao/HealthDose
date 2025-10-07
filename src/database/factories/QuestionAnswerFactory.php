<?php

namespace Database\Factories;

use App\Models\QuestionAnswer;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionAnswerFactory extends Factory
{
    protected $model = QuestionAnswer::class;

    public function definition(): array
    {
        return [
            'body' => $this->faker->paragraph(),
            'like_count' => $this->faker->numberBetween(0, 10),
            'dislike_count' => $this->faker->numberBetween(0, 5),
            'is_accepted' => false,
        ];
    }
}
