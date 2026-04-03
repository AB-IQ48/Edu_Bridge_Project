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
        return ['database', 'mail'];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $isApproved = $this->status === 'approved';
        $title = $isApproved
            ? ($this->itemType === 'profile' ? 'Profile approved' : 'Document approved')
            : ($this->itemType === 'profile' ? 'Profile not approved' : 'Document not approved');

        $body = "{$this->itemName} — " . ucfirst($this->status) . '.';
        if (! $isApproved && $this->reason) {
            $body .= ' Reason: '.$this->reason;
        }

        $actionUrl = $this->itemType === 'document'
            ? route('documents.index')
            : route('counsellor.index');

        return [
            'category' => 'verification',
            'title' => $title,
            'body' => $body,
            'action_url' => $actionUrl,
            'action_label' => $this->itemType === 'document' ? 'My documents' : 'Dashboard',
            'item_type' => $this->itemType,
            'status' => $this->status,
        ];
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

        $dashboardUrl = $this->itemType === 'document'
            ? route('documents.index')
            : route('counsellor.index');

        return $mail
            ->line('You can review your account and update details in the dashboard when needed.')
            ->action('Open your EduBridge dashboard', $dashboardUrl);
    }
}
