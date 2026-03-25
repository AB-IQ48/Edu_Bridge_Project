<?php

namespace Database\Seeders;

use App\Models\CounsellorProfile;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class PakistaniCounsellorSeeder extends Seeder
{
    /**
     * Dummy counsellor credentials for testing dashboard:
     * counsellor@edubridge.pk / password
     */
    public function run(): void
    {
        $counsellorRole = Role::where('name', 'counsellor')->first();
        $studentRole = Role::where('name', 'student')->first();

        if (! $counsellorRole || ! $studentRole) {
            return;
        }

        $counsellors = [
            [
                'name' => 'Ayesha Khan',
                'email' => 'counsellor@edubridge.pk',
                'password' => 'password',
                'organization_name' => 'Lahore Global Education',
                'experience_years' => 9,
                'verification_status' => 'approved',
            ],
            [
                'name' => 'Usman Ali',
                'email' => 'usman@northstar.pk',
                'password' => 'password',
                'organization_name' => 'NorthStar Student Advisory, Islamabad',
                'experience_years' => 6,
                'verification_status' => 'approved',
            ],
            [
                'name' => 'Fatima Noor',
                'email' => 'fatima@karachiabroad.pk',
                'password' => 'password',
                'organization_name' => 'Karachi Abroad Mentors',
                'experience_years' => 7,
                'verification_status' => 'pending',
            ],
            [
                'name' => 'Bilal Ahmed',
                'email' => 'bilal@punjabvisa.pk',
                'password' => 'password',
                'organization_name' => 'Punjab Visa Readiness Center',
                'experience_years' => 10,
                'verification_status' => 'approved',
            ],
        ];

        $approvedCounsellorProfile = null;

        foreach ($counsellors as $item) {
            $user = User::firstOrNew(['email' => $item['email']]);
            $user->name = $item['name'];
            $user->email = $item['email'];
            $user->role_id = $counsellorRole->id;
            $user->password = $item['password'];
            $user->save();

            $profile = CounsellorProfile::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'organization_name' => $item['organization_name'],
                    'experience_years' => $item['experience_years'],
                    'verification_status' => $item['verification_status'],
                    'rejection_reason' => null,
                    'reviewed_at' => now(),
                    'reviewed_by_user_id' => null,
                ]
            );

            if (! $approvedCounsellorProfile && $item['verification_status'] === 'approved') {
                $approvedCounsellorProfile = $profile;
            }
        }

        // Demo student so counsellor can see a contact in chat.
        if ($approvedCounsellorProfile) {
            $student = User::firstOrNew(['email' => 'student.demo@edubridge.pk']);
            $student->name = 'Ali Raza (Demo Student)';
            $student->email = 'student.demo@edubridge.pk';
            $student->role_id = $studentRole->id;
            $student->password = 'password';
            $student->assigned_counsellor_profile_id = $approvedCounsellorProfile->id;
            $student->save();
        }
    }
}
