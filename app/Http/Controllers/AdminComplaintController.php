<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminComplaintController extends Controller
{
    public function index(Request $request): View
    {
        $request->validate([
            'status' => ['nullable', 'in:pending,in_review,resolved,closed'],
            'search' => ['nullable', 'string', 'max:120'],
        ]);

        $query = Complaint::query()
            ->with(['submitter.role'])
            ->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $term = $request->search;
            $query->where(function ($q) use ($term) {
                $q->where('subject', 'like', "%{$term}%")
                    ->orWhere('body', 'like', "%{$term}%")
                    ->orWhereHas('submitter', function ($u) use ($term) {
                        $u->where('name', 'like', "%{$term}%")
                            ->orWhere('email', 'like', "%{$term}%");
                    });
            });
        }

        $complaints = $query->paginate(20)->withQueryString();

        return view('admin.complaints.index', [
            'complaints' => $complaints,
        ]);
    }

    public function show(Complaint $complaint): View
    {
        $complaint->load(['submitter.role', 'handledBy']);

        return view('admin.complaints.show', [
            'complaint' => $complaint,
        ]);
    }

    public function update(Request $request, Complaint $complaint): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', 'in:pending,in_review,resolved,closed'],
            'admin_response' => ['nullable', 'string', 'max:5000'],
        ]);

        $complaint->status = $data['status'];
        $complaint->admin_response = $data['admin_response'] ?? null;
        $complaint->handled_by_user_id = $request->user()->id;
        $complaint->handled_at = now();
        $complaint->save();

        return back()->with('message', 'Complaint updated.');
    }
}
