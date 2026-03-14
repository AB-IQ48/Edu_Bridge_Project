<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VisaScore extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'education_score',
        'financial_score',
        'documentation_score',
        'total_score',
    ];

    protected $casts = [
        'education_score' => 'integer',
        'financial_score' => 'integer',
        'documentation_score' => 'integer',
        'total_score' => 'integer',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
