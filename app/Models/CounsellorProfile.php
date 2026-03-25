<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CounsellorProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'organization_name',
        'city',
        'phone',
        'website',
        'countries_served',
        'languages',
        'specializations',
        'bio',
        'experience_years',
        'verification_status',
        'rejection_reason',
        'reviewed_at',
        'reviewed_by_user_id',
    ];

    protected $casts = [
        'experience_years' => 'integer',
        'reviewed_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }

    public function reviewedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by_user_id');
    }

    /**
     * Students who have attached to this counsellor.
     */
    public function assignedStudents(): HasMany
    {
        return $this->hasMany(User::class, 'assigned_counsellor_profile_id');
    }

    /** @return list<string> */
    public function specializationTags(): array
    {
        if (blank($this->specializations)) {
            return [];
        }

        return array_values(array_unique(array_filter(array_map('trim', preg_split('/[\n,]+/', $this->specializations)))));
    }

    /** @return list<string> */
    public function countryTags(): array
    {
        if (blank($this->countries_served)) {
            return [];
        }

        return array_values(array_filter(array_map('trim', explode(',', $this->countries_served))));
    }

    /** @return list<string> */
    public function languageTags(): array
    {
        if (blank($this->languages)) {
            return [];
        }

        return array_values(array_filter(array_map('trim', explode(',', $this->languages))));
    }
}
