<?php

namespace Database\Seeders;

use App\Models\{Question, QuestionAnswer, User};
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
                    ->state(fn () => ['user_id' => $users->random()->id]),
                'answers'
            )
            ->create();
    }
}
