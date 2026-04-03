<?php

namespace App\Services;

use App\Models\CounsellorProfile;
use App\Models\Document;
use App\Models\User;
use App\Notifications\CounsellorVerificationStatusNotification;
use Illuminate\Support\Facades\Log;

class VerificationReviewService
{
    public function reviewProfile(User $admin, CounsellorProfile $profile, string $status, ?string $reason = null): void
    {
        $profile->update([
            'verification_status' => $status,
            'rejection_reason' => $status === 'rejected' ? $reason : null,
            'reviewed_at' => now(),
            'reviewed_by_user_id' => $admin->id,
        ]);

        $this->sendStatusNotification(
            counsellor: $profile->user,
            itemType: 'profile',
            itemName: $profile->organization_name,
            status: $status,
            reason: $reason
        );
    }

    public function reviewDocument(User $admin, Document $document, string $status, ?string $reason = null): void
    {
        $document->update([
            'status' => $status,
            'rejection_reason' => $status === 'rejected' ? $reason : null,
            'reviewed_at' => now(),
            'reviewed_by_user_id' => $admin->id,
        ]);

        $counsellor = $document->counsellorProfile?->user;
        if (! $counsellor) {
            return;
        }

        $this->sendStatusNotification(
            counsellor: $counsellor,
            itemType: 'document',
            itemName: $document->document_name,
            status: $status,
            reason: $reason
        );
    }

    private function sendStatusNotification(User $counsellor, string $itemType, string $itemName, string $status, ?string $reason): void
    {
        try {
            $counsellor->notify(new CounsellorVerificationStatusNotification(
                itemType: $itemType,
                itemName: $itemName,
                status: $status,
                reason: $reason
            ));
        } catch (\Throwable $e) {
            Log::warning('Failed to send counsellor verification notification.', [
                'user_id' => $counsellor->id,
                'item_type' => $itemType,
                'status' => $status,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
