<?php

namespace App\Services;

use App\Models\VisaScore;

/**
 * Visa readiness questionnaire: real questions mapped to dimension scores.
 * Each question's options have a point value (0-100); we average per dimension and round.
 */
class VisaQuestionnaire
{
    /** Option key => display label for forms */
    public static function optionLabels(): array
    {
        return [
            'secondary' => 'Secondary school',
            'bachelor' => 'Bachelor’s degree',
            'master' => 'Master’s degree',
            'phd' => 'PhD',
            'diploma' => 'Diploma',
            'below_2_5' => 'Below 2.5 / 4.0',
            '2_5_to_3' => '2.5 – 3.0',
            '3_to_3_5' => '3.0 – 3.5',
            'above_3_5_or_first' => 'Above 3.5 or First class',
            'language_course' => 'Language course only',
            'yes' => 'Yes',
            'no' => 'No',
            'applied_awaiting' => 'Applied, awaiting response',
            'yes_same_field' => 'Yes, same field',
            'related' => 'Related field',
            'unrelated' => 'Unrelated',
            'self' => 'Self-funded',
            'family_sponsorship' => 'Family sponsorship',
            'scholarship' => 'Scholarship',
            'loan' => 'Education loan',
            'mixed' => 'Mixed (e.g. scholarship + family)',
            'yes_full' => 'Yes, full coverage',
            'partial' => 'Partial coverage',
            'my_name' => 'My name',
            'sponsor' => 'Sponsor’s name',
            'joint' => 'Joint',
            'partially' => 'Partially',
            'ielts' => 'IELTS',
            'toefl' => 'TOEFL',
            'pte' => 'PTE',
            'none_yet' => 'None yet',
            'other' => 'Other',
            'exceeds' => 'Yes, exceeds minimum',
            'meets' => 'Meets minimum',
            'below' => 'Below minimum',
            'not_taken' => 'Not taken',
            'na' => 'N/A',
            'yes_12_plus_months' => 'Yes, valid 12+ months',
            'yes_less_12' => 'Yes, but less than 12 months validity',
            'in_progress' => 'In progress',
            'thoroughly' => 'Yes, thoroughly',
            'somewhat' => 'Somewhat',
        ];
    }

    public static function optionLabel(string $key): string
    {
        return self::optionLabels()[$key] ?? str_replace('_', ' ', $key);
    }

    /** @return array<string, array{label: string, dimension: string, options: array<string, int>}> */
    public static function questions(): array
    {
        return [
            'highest_qualification' => [
                'label' => 'What is your highest completed qualification?',
                'dimension' => 'education_score',
                'options' => [
                    'secondary' => 35,
                    'bachelor' => 65,
                    'master' => 85,
                    'phd' => 95,
                    'diploma' => 50,
                ],
            ],
            'gpa_or_grade' => [
                'label' => 'What is your GPA or grade classification?',
                'dimension' => 'education_score',
                'options' => [
                    'below_2_5' => 30,
                    '2_5_to_3' => 50,
                    '3_to_3_5' => 75,
                    'above_3_5_or_first' => 95,
                ],
            ],
            'degree_applying_for' => [
                'label' => 'What level are you applying to study?',
                'dimension' => 'education_score',
                'options' => [
                    'bachelor' => 70,
                    'master' => 80,
                    'phd' => 90,
                    'diploma' => 55,
                    'language_course' => 45,
                ],
            ],
            'offer_letter' => [
                'label' => 'Have you received an offer letter from a designated institution?',
                'dimension' => 'education_score',
                'options' => [
                    'yes' => 95,
                    'applied_awaiting' => 55,
                    'no' => 25,
                ],
            ],
            'degree_relevance' => [
                'label' => 'Is your previous qualification relevant to your chosen course?',
                'dimension' => 'education_score',
                'options' => [
                    'yes_same_field' => 90,
                    'related' => 70,
                    'unrelated' => 40,
                ],
            ],
            'funding_source' => [
                'label' => 'How will you fund your studies?',
                'dimension' => 'financial_score',
                'options' => [
                    'self' => 85,
                    'family_sponsorship' => 80,
                    'scholarship' => 90,
                    'loan' => 65,
                    'mixed' => 75,
                ],
            ],
            'bank_coverage' => [
                'label' => 'Do you have bank statements covering the required period (e.g. 12–24 months)?',
                'dimension' => 'financial_score',
                'options' => [
                    'yes_full' => 95,
                    'partial' => 55,
                    'no' => 20,
                ],
            ],
            'funds_in_whose_name' => [
                'label' => 'Are the funds in your name or a sponsor’s?',
                'dimension' => 'financial_score',
                'options' => [
                    'my_name' => 90,
                    'sponsor' => 75,
                    'joint' => 85,
                ],
            ],
            'tuition_paid' => [
                'label' => 'Have you paid the first year tuition (if required by the institution)?',
                'dimension' => 'financial_score',
                'options' => [
                    'yes' => 95,
                    'partially' => 60,
                    'no' => 30,
                ],
            ],
            'english_test_taken' => [
                'label' => 'Which English language test have you taken?',
                'dimension' => 'language_score',
                'options' => [
                    'ielts' => 90,
                    'toefl' => 90,
                    'pte' => 85,
                    'none_yet' => 15,
                    'other' => 70,
                ],
            ],
            'test_meets_minimum' => [
                'label' => 'Does your score meet the minimum for your course and visa?',
                'dimension' => 'language_score',
                'options' => [
                    'exceeds' => 98,
                    'meets' => 85,
                    'below' => 35,
                    'not_taken' => 10,
                ],
            ],
            'test_validity' => [
                'label' => 'Is your test result within the validity period (usually 2 years)?',
                'dimension' => 'language_score',
                'options' => [
                    'yes' => 95,
                    'no' => 40,
                    'na' => 50,
                ],
            ],
            'passport_valid' => [
                'label' => 'Do you have a valid passport?',
                'dimension' => 'documentation_score',
                'options' => [
                    'yes_12_plus_months' => 95,
                    'yes_less_12' => 70,
                    'no' => 15,
                ],
            ],
            'police_clearance' => [
                'label' => 'Do you have a police clearance / character certificate (if required)?',
                'dimension' => 'documentation_score',
                'options' => [
                    'yes' => 95,
                    'in_progress' => 60,
                    'no' => 25,
                ],
            ],
            'transcripts_ready' => [
                'label' => 'Are all academic transcripts and certificates ready and attested where required?',
                'dimension' => 'documentation_score',
                'options' => [
                    'yes' => 95,
                    'partially' => 55,
                    'no' => 25,
                ],
            ],
            'identity_docs' => [
                'label' => 'Do you have birth certificate and other required identity documents?',
                'dimension' => 'documentation_score',
                'options' => [
                    'yes' => 95,
                    'partially' => 55,
                    'no' => 25,
                ],
            ],
            'interview_prepared' => [
                'label' => 'Have you prepared for the visa interview?',
                'dimension' => 'interview_score',
                'options' => [
                    'thoroughly' => 95,
                    'somewhat' => 60,
                    'no' => 25,
                ],
            ],
            'study_plan_clear' => [
                'label' => 'Can you clearly explain your study plan and career goals?',
                'dimension' => 'interview_score',
                'options' => [
                    'yes' => 95,
                    'partially' => 55,
                    'no' => 25,
                ],
            ],
            'originals_ready' => [
                'label' => 'Do you have all original documents ready for the interview?',
                'dimension' => 'interview_score',
                'options' => [
                    'yes' => 95,
                    'partially' => 55,
                    'no' => 25,
                ],
            ],
        ];
    }

    /**
     * Compute dimension scores (0-100) from submitted answers.
     * @param array<string, string> $answers Map of question key => option key
     * @return array{education_score: int, financial_score: int, language_score: int, documentation_score: int, interview_score: int}
     */
    public static function scoreFromAnswers(array $answers): array
    {
        $questions = self::questions();
        $dimensionSums = [
            'education_score' => [],
            'financial_score' => [],
            'language_score' => [],
            'documentation_score' => [],
            'interview_score' => [],
        ];

        foreach ($questions as $key => $config) {
            $option = $answers[$key] ?? null;
            if ($option === null || ! isset($config['options'][$option])) {
                continue;
            }
            $dimensionSums[$config['dimension']][] = $config['options'][$option];
        }

        $result = [];
        foreach ($dimensionSums as $dim => $points) {
            $result[$dim] = empty($points)
                ? 0
                : (int) round(min(100, max(0, array_sum($points) / count($points))));
        }

        return $result;
    }

    /** Validation rules for all question keys. */
    public static function validationRules(): array
    {
        $rules = [];
        foreach (self::questions() as $key => $config) {
            $rules[$key] = ['required', 'string', 'in:' . implode(',', array_keys($config['options']))];
        }
        return $rules;
    }
}
