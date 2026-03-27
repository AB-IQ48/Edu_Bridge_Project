<?php

namespace App\Http\Controllers;

use App\Models\VisaScore;
use App\Services\VisaQuestionnaire;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ScoreController extends Controller
{
    public function index(Request $request): View
    {
        $scores = $request->user()->visaScores()->latest()->paginate(10);

        return view('scores.index', [
            'scores' => $scores,
        ]);
    }

    /**
     * Show the questionnaire-based visa readiness assessment (real questions).
     */
    public function assess(Request $request): View
    {
        return view('scores.assess', [
            'questions' => VisaQuestionnaire::questions(),
            'countries' => VisaQuestionnaire::destinationCountries(),
        ]);
    }

    /**
     * Process questionnaire answers, compute scores, save and redirect to result.
     */
    public function storeFromQuestionnaire(Request $request): RedirectResponse
    {
        $validated = $request->validate(VisaQuestionnaire::validationRules());

        $scores = VisaQuestionnaire::scoreFromAnswers($validated);
        $total = VisaScore::calculateTotal($scores);

        $score = VisaScore::create([
            'student_id' => $request->user()->id,
            'destination_country' => $validated['destination_country'],
            'education_score' => $scores['education_score'],
            'financial_score' => $scores['financial_score'],
            'language_score' => $scores['language_score'],
            'documentation_score' => $scores['documentation_score'],
            'interview_score' => $scores['interview_score'],
            'total_score' => $total,
            'questionnaire_json' => $validated,
        ]);

        return redirect()
            ->route('scores.show', $score)
            ->with('message', 'Your score is ready. Review personalised tips and dimension gaps below.');
    }

    public function show(Request $request, VisaScore $score): View
    {
        if ($score->student_id !== $request->user()->id) {
            abort(403);
        }

        return view('scores.show', ['score' => $score]);
    }
}
