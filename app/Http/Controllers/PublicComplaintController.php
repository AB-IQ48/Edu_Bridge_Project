<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PublicComplaintController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $cats = array_keys(Complaint::categories());
        $data = $request->validate([
            'guest_name' => ['required', 'string', 'max:120'],
            'guest_email' => ['required', 'string', 'email', 'max:255'],
            'category' => ['required', 'string', 'in:'.implode(',', $cats)],
            'subject' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string', 'max:8000'],
        ]);

        Complaint::create([
            'user_id' => null,
            'guest_name' => $data['guest_name'],
            'guest_email' => $data['guest_email'],
            'submitter_role' => 'guest',
            'category' => $data['category'],
            'subject' => $data['subject'],
            'body' => $data['body'],
            'status' => Complaint::STATUS_PENDING,
        ]);

        return redirect()->route('home')
            ->withFragment('make-complaint')
            ->with('complaint_submitted', true);
    }
}
