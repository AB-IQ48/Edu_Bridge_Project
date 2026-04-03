<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ComplaintController extends Controller
{
    /**
     * @param  'student'|'counsellor'  $panel
     */
    private function assertPanelRole(Request $request, string $panel): void
    {
        $role = $request->user()->role?->name;
        if ($panel === 'student' && $role !== 'student') {
            abort(403);
        }
        if ($panel === 'counsellor' && $role !== 'counsellor') {
            abort(403);
        }
    }

    public function index(Request $request, string $panel): View
    {
        $this->assertPanelRole($request, $panel);

        $complaints = Complaint::query()
            ->where('user_id', $request->user()->id)
            ->latest()
            ->paginate(15);

        return view('complaints.index', [
            'panel' => $panel,
            'complaints' => $complaints,
        ]);
    }

    public function create(Request $request, string $panel): View
    {
        $this->assertPanelRole($request, $panel);

        return view('complaints.create', [
            'panel' => $panel,
            'categories' => Complaint::categories(),
        ]);
    }

    public function store(Request $request, string $panel): RedirectResponse
    {
        $this->assertPanelRole($request, $panel);

        $cats = array_keys(Complaint::categories());
        $data = $request->validate([
            'category' => ['required', 'string', 'in:'.implode(',', $cats)],
            'subject' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string', 'max:8000'],
        ]);

        Complaint::create([
            'user_id' => $request->user()->id,
            'submitter_role' => $panel,
            'category' => $data['category'],
            'subject' => $data['subject'],
            'body' => $data['body'],
            'status' => Complaint::STATUS_PENDING,
        ]);

        $route = $panel === 'student' ? 'student.complaints.index' : 'counsellor.complaints.index';

        return redirect()->route($route)->with('message', 'Your complaint was submitted. Our team will review it.');
    }

    public function show(Request $request, Complaint $complaint): View
    {
        $panel = $request->route('panel');
        if ($panel !== 'student' && $panel !== 'counsellor') {
            abort(404);
        }

        $this->assertPanelRole($request, $panel);

        if ($complaint->user_id !== $request->user()->id) {
            abort(403);
        }

        return view('complaints.show', [
            'panel' => $panel,
            'complaint' => $complaint->load('handledBy'),
        ]);
    }
}
