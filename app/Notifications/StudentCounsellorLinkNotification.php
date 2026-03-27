<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StudentCounsellorLinkNotification extends Notification
{
    use Queueable;

    public function __construct(
        public string $studentName,
        public string $action
    ) {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $line = $this->action === 'attached'
            ? "{$this->studentName} has attached to your profile."
            : "{$this->studentName} has detached from your profile.";

        return (new MailMessage)
            ->subject('Student connection update')
            ->greeting("Hello {$notifiable->name},")
            ->line($line)
            ->action('Open Counsellor Dashboard', route('counsellor.index'));
    }
}
