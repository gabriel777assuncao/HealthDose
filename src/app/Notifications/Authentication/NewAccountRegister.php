<?php

namespace App\Notifications\Authentication;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewAccountRegister extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        private readonly object $user,
        private readonly ?string $actionUrl = null,
    ) {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $mailMessage = new MailMessage();
        $mailMessage->subject(__('notifications.account.welcome.subject'));
        $mailMessage->greeting(__('notifications.common.greeting', ['name' => $notifiable->name]));
        $mailMessage->markdown('emails.notification', [
            'title' => __('notifications.account.welcome.subject'),
            'intro' => __('notifications.account.welcome.intro'),
            'details' => __('notifications.account.welcome.details', ['email' => $notifiable->email]),
            'actionUrl' => $this->actionUrl,
            'actionText' => __('notifications.account.welcome.cta'),
        ]);

        return $mailMessage;
    }
}
