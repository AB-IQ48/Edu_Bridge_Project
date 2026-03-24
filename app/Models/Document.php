<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'counsellor_profile_id',
        'document_name',
        'document_path',
        'status',
        'rejection_reason',
        'reviewed_at',
        'reviewed_by_user_id',
    ];

    protected $casts = [
        'reviewed_at' => 'datetime',
    ];

    public function counsellorProfile(): BelongsTo
    {
        return $this->belongsTo(CounsellorProfile::class);
    }

    public function reviewedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by_user_id');
    }
}
