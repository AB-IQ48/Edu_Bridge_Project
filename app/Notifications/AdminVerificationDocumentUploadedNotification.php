<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminVerificationDocumentUploadedNotification extends Notification
{
    use Queueable;

    public function __construct(
        public string $counsellorName,
        public string $organizationName,
        public string $documentName
    ) {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('EduBridge: counsellor verification document uploaded')
            ->greeting("Hello {$notifiable->name},")
            ->line("{$this->counsellorName} ({$this->organizationName}) uploaded a document for review.")
            ->line("Document: {$this->documentName}")
            ->action('Review in admin', route('admin.documents.index', ['status' => 'pending']));
    }
}
