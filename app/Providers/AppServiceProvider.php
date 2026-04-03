<?php

namespace App\Providers;

use App\Models\Complaint;
use App\Models\CounsellorProfile;
use App\Models\Document;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(
            ['layout.header', 'layout.auth', 'layout.panel'],
            function ($view) {
                if (! auth()->check() || ! auth()->user()->isCounsellor()) {
                    return;
                }

                $view->with(
                    'counsellorUnreadNotificationsCount',
                    auth()->user()->unreadNotifications()->count()
                );
            }
        );

        View::composer('layout.admin', function ($view) {
            if (! auth()->check() || ! auth()->user()->isAdministrator()) {
                return;
            }

            $view->with('adminNavPending', [
                'counsellors' => CounsellorProfile::where('verification_status', 'pending')->count(),
                'documents' => Document::where('status', 'pending')->count(),
                'complaints' => Complaint::where('status', Complaint::STATUS_PENDING)->count(),
            ]);
        });

        View::composer(['index', 'pages.verification'], function ($view) {
            $profile = CounsellorProfile::query()
                ->where('verification_status', 'approved')
                ->with('user')
                ->orderBy('id')
                ->first();

            $name = $profile?->user?->name ?? 'Ayesha Khan';
            $org = $profile?->organization_name ?? 'Lahore Global Education';
            $city = $profile?->city ?? 'Lahore';
            $years = (int) ($profile?->experience_years ?? 9);
            $parts = preg_split('/\s+/', trim($name));
            $initials = '';
            foreach (array_slice($parts, 0, 2) as $p) {
                if ($p !== '') {
                    $initials .= strtoupper(mb_substr($p, 0, 1));
                }
            }
            if ($initials === '') {
                $initials = 'EB';
            }

            $view->with('featuredCounsellor', (object) [
                'profile' => $profile,
                'name' => $name,
                'initials' => $initials,
                'organization' => $org,
                'city' => $city,
                'years' => $years,
                'has_real_profile' => $profile !== null,
            ]);
        });
    }
}
