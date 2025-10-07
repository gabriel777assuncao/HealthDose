<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

class Question extends Model
{
    use HasFactory;
    use softDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'body',
        'is_accepted',
    ];

    public function answers(): HasMany
    {
        return $this->hasMany(QuestionAnswer::class, 'question_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
