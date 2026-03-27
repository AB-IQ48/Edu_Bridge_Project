<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\CounsellorProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
            'experience_years' => ['nullable', 'integer', 'min:0', 'max:70'],

            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = User::create([
            'role_id' => 2, // counsellor
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        CounsellorProfile::create([
            'user_id' => $user->id,
            'organization_name' => $data['organization_name'],
            'experience_years' => (int) ($data['experience_years'] ?? 0),
            'verification_status' => 'pending',
        ]);

        Auth::login($user);

        return redirect()
            ->route('dashboard')
            ->with('message', 'Your counsellor account has been created. Please complete your profile and upload documents for verification.');
    }
}

