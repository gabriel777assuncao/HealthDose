<?php

namespace App\Events\User;

use App\Models\User;

class Created
{
    public function __construct(public readonly User $user)
    {
    }
}
