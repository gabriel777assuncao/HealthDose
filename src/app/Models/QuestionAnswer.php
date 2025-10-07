<?php

namespace App\Models;

use Database\Factories\QuestionAnswerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuestionAnswer extends Model
{
    /** @use HasFactory<QuestionAnswerFactory> */
    use HasFactory;
    use softDeletes;

    protected $fillable = [
        'question_id',
        'user_id',
        'answer',
    ];

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
