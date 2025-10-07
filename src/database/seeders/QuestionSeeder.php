<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\QuestionAnswer;
use App\Models\User;
use Database\Factories\QuestionAnswerFactory;
use Database\Factories\QuestionFactory;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        Question::factory()
            ->count(10)
            ->for($users->random(), 'user')
            ->has(
                QuestionAnswer::factory()
                    ->count(3)
                    ->state(fn () => ['user_id' => $users->random()->id]),'answers')
            ->create();
    }
}
