<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Complaint extends Model
{
    public const STATUS_PENDING = 'pending';

    public const STATUS_IN_REVIEW = 'in_review';

    public const STATUS_RESOLVED = 'resolved';

    public const STATUS_CLOSED = 'closed';

    protected $fillable = [
        'user_id',
        'guest_name',
        'guest_email',
        'submitter_role',
        'category',
        'subject',
        'body',
        'status',
        'admin_response',
        'handled_by_user_id',
        'handled_at',
    ];

    protected $casts = [
        'handled_at' => 'datetime',
    ];

    public function submitter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function isGuestSubmission(): bool
    {
        return $this->user_id === null;
    }

    public function displayContactName(): string
    {
        if ($this->submitter) {
            return $this->submitter->name;
        }

        return (string) ($this->guest_name ?? 'Unknown');
    }

    public function displayContactEmail(): ?string
    {
        if ($this->submitter) {
            return $this->submitter->email;
        }

        return $this->guest_email;
    }

    public function handledBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'handled_by_user_id');
    }

    public static function categories(): array
    {
        return [
            'counsellor_conduct' => 'Counsellor conduct or verification badge misuse',
            'harassment_chat' => 'Harassment or abuse in chat',
            'technical_security' => 'Technical issue or data concern',
            'platform_other' => 'Other platform issue',
        ];
    }
}
