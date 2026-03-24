<?php

namespace App\Http\Controllers;

use App\Models\VisaScore;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentController extends Controller
{
    /**
     * Display student dashboard and visa readiness info.
     */
    public function index(Request $request): View
    {
        $user = $request->user();
        $scores = $user->visaScores()->latest()->paginate(10);
        $documentCount = $user->studentDocuments()->count();
        $latestScore = $user->visaScores()->latest()->first();
        $assignedCounsellor = $user->assignedCounsellorProfile;

        return view('student.index', [
            'scores' => $scores,
            'documentCount' => $documentCount,
            'latestScore' => $latestScore,
            'assignedCounsellor' => $assignedCounsellor,
        ]);
    }

    /**
     * Show form to create or update profile / trigger score calculation (placeholder).
     */
    public function profile(Request $request): View
    {
        return view('student.profile');
    }
}
