<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ChatMessageReceivedNotification extends Notification
{
    use Queueable;

    public function __construct(
        public string $senderName,
        public string $messagePreview
    ) {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New message on EduBridge')
            ->greeting("Hello {$notifiable->name},")
            ->line("You received a new chat message from {$this->senderName}.")
            ->line("Message: {$this->messagePreview}")
            ->action('Open Chat', route('chat.index'))
            ->line('Reply from your dashboard when you are available.');
    }
}
