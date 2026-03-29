<?php

namespace App\Models;

use App\Services\VisaContextualAdvice;
use App\Services\VisaQuestionnaire;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VisaScore extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'destination_country',
        'education_score',
        'financial_score',
        'language_score',
        'documentation_score',
        'interview_score',
        'total_score',
        'questionnaire_json',
    ];

    protected $casts = [
        'education_score' => 'integer',
        'financial_score' => 'integer',
        'language_score' => 'integer',
        'documentation_score' => 'integer',
        'interview_score' => 'integer',
        'total_score' => 'integer',
        'questionnaire_json' => 'array',
    ];

    /** Weights for total: academic 25%, financial 25%, language 20%, documentation 20%, interview 10%. */
    public const WEIGHTS = [
        'education_score' => 0.25,
        'financial_score' => 0.25,
        'language_score' => 0.20,
        'documentation_score' => 0.20,
        'interview_score' => 0.10,
    ];

    public static function calculateTotal(array $scores): int
    {
        $total = 0.0;
        foreach (self::WEIGHTS as $key => $weight) {
            $total += ($scores[$key] ?? 0) * $weight;
        }
        return (int) round(min(100, max(0, $total)));
    }

    /** Band label for total score. */
    public function getBandAttribute(): string
    {
        if ($this->total_score >= 75) {
            return 'Ready';
        }
        if ($this->total_score >= 50) {
            return 'Conditionally ready';
        }
        return 'Not yet ready';
    }

    /** Requirements / gaps: what the student needs to improve (low-scoring dimensions). */
    public function getRequirementsAttribute(): array
    {
        $out = [];
        $checks = [
            'education_score' => ['name' => 'Academic eligibility', 'tip' => 'Ensure your GPA and degree meet the destination university requirements. Submit transcripts and degree certificates.'],
            'financial_score' => ['name' => 'Financial proof', 'tip' => 'Upload bank statements, sponsorship letters, or scholarship proof covering the required period (usually 1–2 years).'],
            'language_score' => ['name' => 'Language proficiency', 'tip' => 'Submit valid IELTS, TOEFL, or equivalent test scores meeting the minimum for your course and visa.'],
            'documentation_score' => ['name' => 'Document completeness', 'tip' => 'Upload all required documents: passport, birth certificate, police clearance, and any country-specific forms.'],
            'interview_score' => ['name' => 'Interview readiness', 'tip' => 'Prepare for the visa interview: practise common questions, know your course and funding, and have documents in order.'],
        ];
        foreach ($checks as $key => $info) {
            $value = (int) ($this->{$key} ?? 0);
            if ($value < 75) {
                $out[] = [
                    'dimension' => $info['name'],
                    'score' => $value,
                    'tip' => $info['tip'],
                ];
            }
        }
        return $out;
    }

    /**
     * Personalised tips for the result page (from destination + questionnaire + weak areas).
     *
     * @return list<array{title: string, body: string, priority?: string}>
     */
    public function getContextualTipsAttribute(): array
    {
        return VisaContextualAdvice::tipsFor($this);
    }

    /** Human-readable destination from stored country code. */
    public function getDestinationLabelAttribute(): ?string
    {
        $code = $this->destination_country;
        if ($code === null || $code === '') {
            return null;
        }

        return VisaQuestionnaire::destinationCountries()[$code] ?? $code;
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
