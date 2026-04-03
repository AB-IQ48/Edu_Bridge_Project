<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\CounsellorProfile;
use App\Models\Document;
use App\Models\User;
use App\Notifications\AdminVerificationDocumentUploadedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Password;

class RegisterCompanyController extends Controller
{
    public function create()
    {
        return view('auth.register_company');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'organization_name' => ['required', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:120'],
            'phone' => ['required', 'string', 'max:40'],
            'website' => ['required', 'string', 'max:255'],
            'countries_served' => ['nullable', 'string', 'max:500'],
            'languages' => ['nullable', 'string', 'max:255'],
            'specializations' => ['nullable', 'string', 'max:2000'],
            'bio' => ['nullable', 'string', 'max:5000'],
            'experience_years' => ['nullable', 'integer', 'min:0', 'max:70'],

            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::defaults()],

            'registration_file' => ['required', 'file', 'max:10240', 'mimes:pdf,jpg,jpeg,png'],
            'certificate_file' => ['nullable', 'file', 'max:10240', 'mimes:pdf,jpg,jpeg,png'],
            'supporting_file' => ['nullable', 'file', 'max:10240', 'mimes:pdf,jpg,jpeg,png'],
        ]);

        $website = $this->normalizeWebsite($data['website']);
        if ($website === null || ! filter_var($website, FILTER_VALIDATE_URL)) {
            return back()->withErrors(['website' => 'Enter a valid website URL (e.g. https://yourcompany.com).'])->withInput();
        }

        $user = DB::transaction(function () use ($data, $website, $request) {
            $user = new User([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
            ]);
            $user->role_id = 2;
            $user->save();

            $profile = CounsellorProfile::create([
                'user_id' => $user->id,
                'organization_name' => $data['organization_name'],
                'city' => $data['city'] ?? null,
                'phone' => trim($data['phone']),
                'website' => $website,
                'countries_served' => $data['countries_served'] ?? null,
                'languages' => $data['languages'] ?? null,
                'specializations' => $data['specializations'] ?? null,
                'bio' => $data['bio'] ?? null,
                'experience_years' => (int) ($data['experience_years'] ?? 0),
                'verification_status' => 'pending',
            ]);

            $slots = [
                ['file' => $request->file('registration_file'), 'label' => 'Business registration / licence'],
                ['file' => $request->file('certificate_file'), 'label' => 'Company certificate or accreditation'],
                ['file' => $request->file('supporting_file'), 'label' => 'Additional supporting document'],
            ];

            foreach ($slots as $slot) {
                $file = $slot['file'];
                if (! $file || ! $file->isValid()) {
                    continue;
                }
                $path = $file->store('counsellor-documents', 'local');
                $document = Document::create([
                    'counsellor_profile_id' => $profile->id,
                    'document_name' => $slot['label'],
                    'document_path' => $path,
                    'status' => 'pending',
                ]);
                $this->notifyAdminsOfDocument($user, $profile, $document);
            }

            return $user;
        });

        Auth::login($user);

        return redirect()
            ->route('counsellor.index')
            ->with('message', 'Your counsellor account is ready. We have received your company details and verification documents for admin review.');
    }

    private function normalizeWebsite(string $url): ?string
    {
        $url = trim($url);
        if ($url === '') {
            return null;
        }
        if (! preg_match('#^https?://#i', $url)) {
            $url = 'https://' . ltrim($url, '/');
        }

        return $url;
    }

    private function notifyAdminsOfDocument(User $counsellorUser, CounsellorProfile $profile, Document $document): void
    {
        $admins = User::query()
            ->whereHas('role', fn ($q) => $q->where('name', 'administrator'))
            ->get();

        foreach ($admins as $admin) {
            try {
                $admin->notify(new AdminVerificationDocumentUploadedNotification(
                    counsellorName: $counsellorUser->name,
                    organizationName: $profile->organization_name,
                    documentName: $document->document_name
                ));
            } catch (\Throwable $e) {
                Log::warning('Failed to notify admin for uploaded verification document.', [
                    'admin_id' => $admin->id,
                    'document_id' => $document->id,
                    'error' => $e->getMessage(),
                ]);
            }
        }
    }
}

