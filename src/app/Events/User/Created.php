<?php

namespace App\Events\User;

use App\Models\User;
use Illuminate\Broadcasting\{InteractsWithSockets};
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Created
{
    public function __construct(public readonly User $user){
    }
}
