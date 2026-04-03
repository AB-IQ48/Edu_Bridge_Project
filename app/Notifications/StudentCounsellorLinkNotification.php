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
        return ['database', 'mail'];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $body = $this->action === 'attached'
            ? "{$this->studentName} attached to your profile."
            : "{$this->studentName} detached from your profile.";

        return [
            'category' => 'student_link',
            'title' => $this->action === 'attached' ? 'Student connected' : 'Student disconnected',
            'body' => $body,
            'action_url' => route('counsellor.index'),
            'action_label' => 'Dashboard',
        ];
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
