<?php

namespace App\Http\Controllers;

use App\Models\CounsellorProfile;
use App\Models\Document;
use App\Models\User;
use App\Models\VisaScore;
use App\Services\VerificationReviewService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function __construct(private readonly VerificationReviewService $reviewService)
    {
    }

    /**
     * Admin dashboard: stats and pending items.
     */
    public function index(Request $request): View
    {
        $pendingProfiles = CounsellorProfile::where('verification_status', 'pending')
            ->with('user')
            ->latest()
            ->limit(5)
            ->get();

        $pendingDocuments = Document::where('status', 'pending')
            ->with('counsellorProfile.user')
            ->latest()
            ->limit(5)
            ->get();

        $stats = [
            'counsellors_total' => CounsellorProfile::count(),
            'counsellors_pending' => CounsellorProfile::where('verification_status', 'pending')->count(),
            'counsellors_approved' => CounsellorProfile::where('verification_status', 'approved')->count(),
            'counsellors_rejected' => CounsellorProfile::where('verification_status', 'rejected')->count(),
            'documents_pending' => Document::where('status', 'pending')->count(),
            'students_total' => User::whereHas('role', fn ($q) => $q->where('name', 'student'))->count(),
            'scores_total' => VisaScore::count(),
        ];

        return view('admin.dashboard', [
            'pendingProfiles' => $pendingProfiles,
            'pendingDocuments' => $pendingDocuments,
            'stats' => $stats,
        ]);
    }

    /**
     * List all counsellors with optional status filter.
     */
    public function counsellorsIndex(Request $request): View
    {
        $request->validate([
            'status' => ['nullable', 'in:pending,approved,rejected'],
            'search' => ['nullable', 'string', 'max:120'],
        ]);

        $query = CounsellorProfile::with('user')->latest();

        if ($request->filled('status')) {
            $query->where('verification_status', $request->status);
        }

        if ($request->filled('search')) {
            $term = $request->search;
            $query->where(function ($q) use ($term) {
                $q->where('organization_name', 'like', "%{$term}%")
                    ->orWhereHas('user', fn ($u) => $u->where('name', 'like', "%{$term}%")->orWhere('email', 'like', "%{$term}%"));
            });
        }

        $counsellors = $query->paginate(15)->withQueryString();

        return view('admin.counsellors.index', [
            'counsellors' => $counsellors,
        ]);
    }

    /**
     * Show single counsellor: profile details and documents for review.
     */
    public function counsellorShow(CounsellorProfile $counsellorProfile): View
    {
        $counsellorProfile->load(['user', 'documents.reviewedBy']);

        return view('admin.counsellors.show', [
            'profile' => $counsellorProfile,
        ]);
    }

    /**
     * List all documents (counsellor verification docs) with optional status filter.
     */
    public function documentsIndex(Request $request): View
    {
        $request->validate([
            'status' => ['nullable', 'in:pending,approved,rejected'],
        ]);

        $query = Document::with('counsellorProfile.user')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $documents = $query->paginate(15)->withQueryString();

        return view('admin.documents.index', [
            'documents' => $documents,
        ]);
    }

    /**
     * Approve or reject counsellor profile verification.
     */
    public function reviewProfile(Request $request, CounsellorProfile $counsellorProfile): RedirectResponse
    {
        $data = $request->validate([
            'verification_status' => ['required', 'in:approved,rejected'],
            'rejection_reason' => ['nullable', 'string', 'max:1000', 'required_if:verification_status,rejected'],
        ]);

        $this->reviewService->reviewProfile(
            admin: $request->user(),
            profile: $counsellorProfile->loadMissing('user'),
            status: $data['verification_status'],
            reason: $data['rejection_reason'] ?? null
        );

        $status = $data['verification_status'] === 'approved' ? 'approved' : 'rejected';

        return back()->with('message', "Counsellor profile {$status} successfully.");
    }

    /**
     * Approve or reject a document.
     */
    public function reviewDocument(Request $request, Document $document): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', 'in:approved,rejected'],
            'rejection_reason' => ['nullable', 'string', 'max:1000', 'required_if:status,rejected'],
        ]);

        $this->reviewService->reviewDocument(
            admin: $request->user(),
            document: $document->loadMissing('counsellorProfile.user'),
            status: $data['status'],
            reason: $data['rejection_reason'] ?? null
        );

        $status = $data['status'] === 'approved' ? 'approved' : 'rejected';

        return back()->with('message', "Document {$status} successfully.");
    }

    /**
     * Admin profile settings form.
     */
    public function profile(Request $request): View
    {
        return view('admin.profile', [
            'admin' => $request->user(),
        ]);
    }

    /**
     * Update admin profile securely (name, email, optional password).
     */
    public function updateProfile(Request $request): RedirectResponse
    {
        $admin = $request->user();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($admin->id),
            ],
            'password' => ['nullable', 'confirmed', Password::min(8)],
        ]);

        $updateData = [
            'name' => $data['name'],
            'email' => $data['email'],
        ];

        if (! empty($data['password'])) {
            $updateData['password'] = $data['password'];
        }

        $admin->update($updateData);

        return back()->with('message', 'Admin profile updated successfully.');
    }
}
