<?php

namespace App\Http\Controllers;

use App\Models\VisaScore;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ScoreController extends Controller
{
    /**
     * Display visa readiness score for the authenticated student.
     */
    public function index(Request $request): View
    {
        $scores = $request->user()->visaScores()->latest()->paginate(10);

        return view('scores.index', [
            'scores' => $scores,
        ]);
    }

    /**
     * Show form to calculate / recalculate score (input placeholders).
     */
    public function create(Request $request): View
    {
        return view('scores.create');
    }

    /**
     * Store a new visa score (calculate and save).
     * Uses transparent rule: total = (education + financial + documentation) / 3.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'education_score' => ['required', 'integer', 'min:0', 'max:100'],
            'financial_score' => ['required', 'integer', 'min:0', 'max:100'],
            'documentation_score' => ['required', 'integer', 'min:0', 'max:100'],
        ]);

        $total = (int) round(
            ($data['education_score'] + $data['financial_score'] + $data['documentation_score']) / 3
        );

        VisaScore::create([
            'student_id' => $request->user()->id,
            'education_score' => $data['education_score'],
            'financial_score' => $data['financial_score'],
            'documentation_score' => $data['documentation_score'],
            'total_score' => min(100, max(0, $total)),
        ]);

        return redirect()->route('scores.index')->with('message', 'Visa readiness score recorded.');
    }

    /**
     * Show a single score record.
     */
    public function show(Request $request, VisaScore $score): View
    {
        if ($score->student_id !== $request->user()->id) {
            abort(403);
        }

        return view('scores.show', ['score' => $score]);
    }
}
