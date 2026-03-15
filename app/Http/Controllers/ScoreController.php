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
            'education_score' => $scores['education_score'],
            'financial_score' => $scores['financial_score'],
            'language_score' => $scores['language_score'],
            'documentation_score' => $scores['documentation_score'],
            'interview_score' => $scores['interview_score'],
            'total_score' => $total,
        ]);

        return redirect()
            ->route('scores.show', $score)
            ->with('message', 'Your visa readiness score is based on your answers. Review "Where you\'re required" to improve.');
    }

    public function create(Request $request): View
    {
        return view('scores.create');
    }

    /**
     * Store a new visa score using weighted calculation.
     * Weights: education 25%, financial 25%, language 20%, documentation 20%, interview 10%.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'education_score' => ['required', 'integer', 'min:0', 'max:100'],
            'financial_score' => ['required', 'integer', 'min:0', 'max:100'],
            'language_score' => ['required', 'integer', 'min:0', 'max:100'],
            'documentation_score' => ['required', 'integer', 'min:0', 'max:100'],
            'interview_score' => ['required', 'integer', 'min:0', 'max:100'],
        ]);

        $total = VisaScore::calculateTotal($data);

        VisaScore::create([
            'student_id' => $request->user()->id,
            'education_score' => $data['education_score'],
            'financial_score' => $data['financial_score'],
            'language_score' => $data['language_score'],
            'documentation_score' => $data['documentation_score'],
            'interview_score' => $data['interview_score'],
            'total_score' => $total,
        ]);

        return redirect()->route('scores.index')->with('message', 'Visa readiness score saved. Check "Where you\'re required" on the score detail.');
    }

    public function show(Request $request, VisaScore $score): View
    {
        if ($score->student_id !== $request->user()->id) {
            abort(403);
        }

        return view('scores.show', ['score' => $score]);
    }
}
