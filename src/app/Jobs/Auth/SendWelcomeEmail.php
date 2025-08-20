<?php

namespace App\Jobs\Auth;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendWelcomeEmail implements ShouldQueue
{
    use Queueable;

    public function __construct()
    {
        //
    }

    public function handle(): void
    {
        //
    }
}
