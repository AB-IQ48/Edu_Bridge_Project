<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'role_id',
        'assigned_counsellor_profile_id',
        'name',
        'email',
        'password',
    ];

    protected $with = ['role'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function counsellorProfile(): HasOne
    {
        return $this->hasOne(CounsellorProfile::class);
    }

    public function studentProfile(): HasOne
    {
        return $this->hasOne(StudentProfile::class);
    }

    public function visaScores(): HasMany
    {
        return $this->hasMany(VisaScore::class, 'student_id');
    }

    public function assignedCounsellorProfile(): BelongsTo
    {
        return $this->belongsTo(CounsellorProfile::class, 'assigned_counsellor_profile_id');
    }

    public function studentDocuments(): HasMany
    {
        return $this->hasMany(StudentDocument::class);
    }

    public function isStudent(): bool
    {
        return $this->role && $this->role->name === 'student';
    }

    public function isCounsellor(): bool
    {
        return $this->role && $this->role->name === 'counsellor';
    }

    public function isAdministrator(): bool
    {
        return $this->role && $this->role->name === 'administrator';
    }
}
