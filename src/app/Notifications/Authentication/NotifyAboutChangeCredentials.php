<?php

namespace App\Notifications\Authentication;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotifyAboutChangeCredentials extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        private readonly User $user,
        private readonly string $token,
        private readonly ?string $actionUrl = null,
    ) {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return new MailMessage()
            ->subject(__('notifications.credentials.reset.subject'))
            ->greeting(__('notifications.common.greeting', ['name' => $notifiable->name]))
            ->line(__('notifications.credentials.reset.line_1'))
            ->line(__('notifications.credentials.reset.token_is').": **{$this->token}**")
            ->line(__('notifications.credentials.reset.ignore_if_not_requested'))
            ->markdown('emails.notification', []);
    }
}
