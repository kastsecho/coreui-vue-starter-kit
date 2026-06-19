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
        return inertia('Dashboard', [
            'status' => session('status'),
        ]);
    }
}
