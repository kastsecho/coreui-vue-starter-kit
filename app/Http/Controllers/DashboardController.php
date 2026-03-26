<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Response;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): Response
    {
        $users = User::selectRaw('
            COUNT(*) as total,
            COUNT(email_verified_at) as verified,
            COUNT(*) - COUNT(email_verified_at) as unverified,
            (SELECT name FROM users ORDER BY id DESC LIMIT 1) as latest
        ')->first();

        $recentUsers = User::latest('id')->limit(5)->get();

        return inertia('Dashboard', [
            'status' => session('status'),
            'users' => $users,
            'recentUsers' => $recentUsers,
        ]);
    }
}
