<?php

namespace Database\Seeders;

use App\Models\{Question, QuestionAnswer, User};
use Illuminate\Database\Seeder;

class QuestionAnswersSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $questions = Question::all();

        QuestionAnswer::factory()->count(10)->create([
            'question_id' => fn () => $questions->random()->id,
            'user_id' => fn () => $users->random()->id,
        ]);
    }
}
