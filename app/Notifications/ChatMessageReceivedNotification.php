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
        public string $messagePreview,
        public ?int $senderUserId = null
    ) {
    }

    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $actionUrl = $this->senderUserId !== null
            ? route('chat.show', ['user' => $this->senderUserId])
            : route('chat.index');

        return [
            'category' => 'chat',
            'title' => 'New chat message',
            'body' => "{$this->senderName}: {$this->messagePreview}",
            'action_url' => $actionUrl,
            'action_label' => 'Open chat',
        ];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $chatUrl = $this->senderUserId !== null
            ? route('chat.show', ['user' => $this->senderUserId])
            : route('chat.index');

        return (new MailMessage)
            ->subject('New message on EduBridge')
            ->greeting("Hello {$notifiable->name},")
            ->line("You received a new chat message from {$this->senderName}.")
            ->line("Message: {$this->messagePreview}")
            ->action('Open Chat', $chatUrl)
            ->line('Reply from your dashboard when you are available.');
    }
}
