<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Redirect administrators to the admin dashboard; show normal dashboard for others.
     */
    public function __invoke(Request $request): View|RedirectResponse
    {
        if ($request->user()->isAdministrator()) {
            return redirect()->route('admin.index');
        }

        return view('dashboard');
    }
}

