<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CounsellorVerificationStatusNotification extends Notification
{
    use Queueable;

    public function __construct(
        public string $itemType,
        public string $itemName,
        public string $status,
        public ?string $reason = null
    ) {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $subject = $this->status === 'approved'
            ? 'Verification approved'
            : 'Verification rejected';

        $mail = (new MailMessage)
            ->subject("EduBridge: {$subject}")
            ->greeting("Hello {$notifiable->name},")
            ->line("Your {$this->itemType} review has been updated.")
            ->line("Item: {$this->itemName}")
            ->line('Status: ' . ucfirst($this->status));

        if ($this->status === 'rejected' && $this->reason) {
            $mail->line("Reason: {$this->reason}");
        }

        return $mail
            ->line('You can update your details and submit again.')
            ->action('Login to EduBridge', route('login'));
    }
}
