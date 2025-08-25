<?php

namespace App\Listeners\Authentication;

use App\Events\User\Created;
use App\Notifications\Authentication\NewAccountRegister;
use Illuminate\Contracts\Queue\ShouldQueue;
use Psr\Log\LoggerInterface;

class NotifyUserAboutRegister implements ShouldQueue
{
    public function __construct(private readonly LoggerInterface $logger)
    {
    }

    public function handle(Created $event): void
    {
        $user = $event->user;

        $this->logger->info('User registered', [
            'user_id' => $user->id,
            'email' => $user->email,
        ]);

        $user->notify(new NewAccountRegister($user));
    }
}
