<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Attributes\Controllers\Middleware;
use Inertia\Response;
use Throwable;

#[Middleware('auth')]
#[Middleware('verified')]
class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @throws Throwable
     */
    public function __invoke(Request $request): Response
    {
        $user = $request->user();

        $users = User::selectRaw('
            COUNT(*) as total,
            COUNT(email_verified_at) as verified,
            COUNT(*) - COUNT(email_verified_at) as unverified
        ')->first()->withoutAppends();

        $recentUsers = $user->currentTeam->members()
            ->latest('id')
            ->limit(5)
            ->get();

        return inertia('Dashboard', [
            'status' => session('status'),
            'recentUsers' => $recentUsers->toResourceCollection(),
            'users' => $users,
        ]);
    }
}
