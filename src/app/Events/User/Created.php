<?php

namespace App\Events\User;

use Illuminate\Broadcasting\{InteractsWithSockets};
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Created
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;
}
