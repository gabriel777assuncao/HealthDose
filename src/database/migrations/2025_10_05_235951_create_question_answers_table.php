<?php

use App\Models\{Question, User};
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('question_answers', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Question::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->text('body');

            $table->boolean('is_accepted')->default(false);
            $table->unsignedInteger('like_count')->default(0);
            $table->unsignedInteger('dislike_count')->default(0);

            $table->timestamps();
            $table->softDeletes();

            $table->index('question_id');
            $table->index('user_id');
            $table->index('created_at');
            $table->index('is_accepted');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('question_answers');
    }
};
