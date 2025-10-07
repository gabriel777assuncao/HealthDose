<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->string('title', 150);
            $table->text('body');

            $table->unsignedInteger('view_count')->default(0);
            $table->unsignedInteger('like_count')->default(0);
            $table->unsignedInteger('dislike_count')->default(0);
            $table->unsignedInteger('reply_count')->default(0);

            $table->timestamps();
            $table->softDeletes();

            $table->index('reply_count');
            $table->index('like_count');
            $table->index('dislike_count');
            $table->index('view_count');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
