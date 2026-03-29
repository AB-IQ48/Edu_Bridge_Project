<?php

namespace App\Services;

use App\Models\VisaScore;

/**
 * Official immigration / study visa entry points for result pages (not legal advice).
 * Keys must match {@see VisaQuestionnaire::destinationCountries()} codes.
 */
class VisaContextualAdvice
{
    /**
     * Personalised tips for the score detail view: title, Markdown body, optional priority.
     *
     * @return list<array{title: string, body: string, priority?: string}>
     */
    public static function tipsFor(VisaScore $score): array
    {
        $tips = [];
        $answers = $score->questionnaire_json;
        $answers = is_array($answers) ? $answers : [];

        $dest = $score->destination_country;
        if ($dest !== null && $dest !== '') {
            $name = VisaQuestionnaire::destinationCountries()[$dest] ?? $dest;
            $tips[] = [
                'title' => "{$name}: confirm current rules",
                'body' => "Immigration rules and document lists change. Use the **official** source for **{$name}** and double-check funds, English tests, and biometrics for your intake.",
            ];
        }

        if (($answers['offer_letter'] ?? '') === 'no') {
            $tips[] = [
                'title' => 'Offer letter',
                'body' => 'You indicated **no offer** yet. Most student routes need an acceptance or **CAS/LOA** from a recognised institution before you can finalise the visa application.',
                'priority' => 'high',
            ];
        }

        if (in_array($answers['bank_coverage'] ?? '', ['partial', 'no'], true)) {
            $tips[] = [
                'title' => 'Bank and funding evidence',
                'body' => 'Gaps in bank history are a common reason for delays. Aim for **continuous** statements covering the period your destination requires, with a clear paper trail if a **sponsor** funds you.',
                'priority' => 'high',
            ];
        }

        if (($answers['english_test_taken'] ?? '') === 'none_yet') {
            $tips[] = [
                'title' => 'English test planning',
                'body' => 'Book **IELTS/TOEFL/PTE** early: test dates fill up. Your score must meet both **university** and **visa** thresholds where they differ.',
            ];
        }

        if (($answers['passport_valid'] ?? '') !== 'yes_12_plus_months') {
            $tips[] = [
                'title' => 'Passport validity',
                'body' => 'Many countries expect your passport to stay valid **beyond** your course. Renew in good time if expiry is within roughly **12 months** of travel.',
            ];
        }

        if (in_array($answers['police_clearance'] ?? '', ['no', 'in_progress'], true)) {
            $tips[] = [
                'title' => 'Police clearance / character certificate',
                'body' => 'If your destination requires it, start police clearance **early**. Processing times vary and can block submission.',
            ];
        }

        if (in_array($answers['interview_prepared'] ?? '', ['no', 'somewhat'], true)) {
            $tips[] = [
                'title' => 'Interview clarity',
                'body' => 'Be ready to explain **why this course**, **how you fund it**, and **what you do after** in a straightforward way. Bring **originals** that match your uploads.',
            ];
        }

        $weakDims = 0;
        foreach (['education_score', 'financial_score', 'language_score', 'documentation_score', 'interview_score'] as $k) {
            if ((int) ($score->{$k} ?? 0) < 75) {
                $weakDims++;
            }
        }
        if ($weakDims >= 3) {
            $tips[] = [
                'title' => 'Multiple gaps',
                'body' => 'Several score areas are below the strong band. Prioritise **complete documents** and **funding proof** first, then language evidence and interview preparation.',
            ];
        }

        return $tips;
    }

    /**
     * @return array<string, array{label: string, url: string}>
     */
    public static function officialLinks(): array
    {
        return [
            'uk' => [
                'label' => 'UK Student visa (official)',
                'url' => 'https://www.gov.uk/student-visa',
            ],
            'usa' => [
                'label' => 'US Student visa (travel.state.gov)',
                'url' => 'https://travel.state.gov/content/travel/en/us-visas/study/student-visa.html',
            ],
            'canada' => [
                'label' => 'Canada study permit (IRCC)',
                'url' => 'https://www.canada.ca/en/immigration-refugees-citizenship/services/study-canada/study-permit.html',
            ],
            'australia' => [
                'label' => 'Australia Student visa (subclass 500)',
                'url' => 'https://immi.homeaffairs.gov.au/visas/getting-a-visa/visa-listing/student-500',
            ],
            'germany' => [
                'label' => 'Germany: visa for study (Make it in Germany)',
                'url' => 'https://www.make-it-in-germany.com/en/visa/kinds-of-visa/study/',
            ],
            'france' => [
                'label' => 'France: student visa (France-Visas)',
                'url' => 'https://france-visas.gouv.fr/en/web/france-visas/student-visa',
            ],
            'netherlands' => [
                'label' => 'Netherlands: residence permit for study',
                'url' => 'https://www.netherlandsworldwide.nl/visa/residence/study',
            ],
            'ireland' => [
                'label' => 'Ireland: study visa (INIS)',
                'url' => 'https://www.irishimmigration.ie/coming-to-study-in-ireland/',
            ],
            'new_zealand' => [
                'label' => 'New Zealand: student visa',
                'url' => 'https://www.immigration.govt.nz/new-zealand-visas/apply-for-a-visa/about-visa/fee-paying-student-visa',
            ],
            'italy' => [
                'label' => 'Italy: visa information (Visti)',
                'url' => 'https://vistoperitalia.esteri.it/home/en',
            ],
            'spain' => [
                'label' => 'Spain: study visa (MAEC)',
                'url' => 'https://www.exteriores.gob.es/en/ServiciosAlCiudadano/Paginas/Consular/Visas.aspx',
            ],
            'sweden' => [
                'label' => 'Sweden: residence permit for studies',
                'url' => 'https://www.migrationsverket.se/English/Private-individuals/Studying-in-Sweden.html',
            ],
            'uae' => [
                'label' => 'UAE: residence visa for study',
                'url' => 'https://u.ae/en/information-and-services/visa-and-emirates-id/residence-visas/study',
            ],
            'malaysia' => [
                'label' => 'Malaysia: Student Pass (IMI)',
                'url' => 'https://www.imi.gov.my/index.php/en/main-services/visa/student-pass',
            ],
            'other' => [
                'label' => 'Find your embassy or consulate',
                'url' => 'https://www.embassy-worldwide.com/',
            ],
        ];
    }
}
