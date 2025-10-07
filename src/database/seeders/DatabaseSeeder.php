<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\QuestionAnswerFactory;
use Database\Factories\QuestionFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            QuestionSeeder::class,
            QuestionAnswersSeeder::class,
        ]);
    }
}
