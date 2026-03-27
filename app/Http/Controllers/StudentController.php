<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
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
        $unreadChatCount = 0;
        if ($assignedCounsellor && $assignedCounsellor->user) {
            $unreadChatCount = ChatMessage::query()
                ->where('sender_id', $assignedCounsellor->user->id)
                ->where('receiver_id', $user->id)
                ->whereNull('read_at')
                ->count();
        }

        return view('student.index', [
            'scores' => $scores,
            'documentCount' => $documentCount,
            'latestScore' => $latestScore,
            'assignedCounsellor' => $assignedCounsellor,
            'unreadChatCount' => $unreadChatCount,
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
