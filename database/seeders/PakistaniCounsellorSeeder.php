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
                'city' => 'Lahore',
                'phone' => '+92 300 1234567',
                'website' => 'lahoreglobaledu.example.org',
                'countries_served' => 'United Kingdom, Canada, Australia',
                'languages' => 'English, Urdu, Punjabi',
                'specializations' => "UK master's and foundation pathways\nCanada SDS study permit\nScholarship applications\nStatement of purpose coaching",
                'bio' => 'I have guided hundreds of students from Punjab and beyond into UK and Canadian universities. I focus on transparent documentation, realistic visa timelines, and course choices that match your career goals. I work closely with families on financial planning and interview preparation.',
            ],
            [
                'name' => 'Usman Ali',
                'email' => 'usman@northstar.pk',
                'password' => 'password',
                'organization_name' => 'NorthStar Student Advisory, Islamabad',
                'experience_years' => 6,
                'verification_status' => 'approved',
                'city' => 'Islamabad',
                'phone' => '+92 321 9876543',
                'website' => 'northstar.pk',
                'countries_served' => 'Canada, Germany, Netherlands',
                'languages' => 'English, Urdu',
                'specializations' => "Canada study permit & PGWP\nEU public universities\nSTEM and business programmes\nVisa interview readiness",
                'bio' => 'Based in Islamabad, I help students who want strong technical and business programmes in Canada and Europe. I walk you through each step, from picking a programme to building your visa file, so you know what you need and why.',
            ],
            [
                'name' => 'Fatima Noor',
                'email' => 'fatima@karachiabroad.pk',
                'password' => 'password',
                'organization_name' => 'Karachi Abroad Mentors',
                'experience_years' => 7,
                'verification_status' => 'pending',
                'city' => 'Karachi',
                'phone' => null,
                'website' => null,
                'countries_served' => 'United Kingdom, United States',
                'languages' => 'English, Urdu',
                'specializations' => "US F-1 guidance\nUK undergraduate admissions\nLiberal arts and social sciences",
                'bio' => 'Karachi-based consultant focused on US and UK pathways for ambitious students. Profile still pending admin check (sample data for development).',
            ],
            [
                'name' => 'Bilal Ahmed',
                'email' => 'bilal@punjabvisa.pk',
                'password' => 'password',
                'organization_name' => 'Punjab Visa Readiness Center',
                'experience_years' => 10,
                'verification_status' => 'approved',
                'city' => 'Multan',
                'phone' => '+92 333 5550199',
                'website' => null,
                'countries_served' => 'United Kingdom, United Arab Emirates, Malaysia',
                'languages' => 'English, Urdu, Saraiki',
                'specializations' => "UK spouse & student routes\nUAE pathway planning\nMalaysia affordable degrees\nFinancial documentation review",
                'bio' => 'Ten years of experience helping families from Punjab and South Punjab navigate study and work routes. I specialise in preparing complete visa files with emphasis on financial evidence and consistency across documents.',
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
                    'city' => $item['city'] ?? null,
                    'phone' => $item['phone'] ?? null,
                    'website' => $item['website'] ?? null,
                    'countries_served' => $item['countries_served'] ?? null,
                    'languages' => $item['languages'] ?? null,
                    'specializations' => $item['specializations'] ?? null,
                    'bio' => $item['bio'] ?? null,
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
