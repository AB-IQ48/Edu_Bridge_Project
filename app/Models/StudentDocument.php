<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentDocument extends Model
{
    use HasFactory;

    protected $table = 'student_documents';

    protected $fillable = [
        'user_id',
        'document_name',
        'document_path',
        'document_type',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Student documents are visible to the owning student and their assigned counsellor only.
     */
    public function canBeViewedBy(User $viewer): bool
    {
        if ($this->user_id === $viewer->id) {
            return true;
        }

        $owner = $this->relationLoaded('user') ? $this->user : $this->user()->first();
        if (! $owner || ! $owner->isStudent()) {
            return false;
        }

        return $viewer->servesAsCounsellorFor($owner);
    }
}
