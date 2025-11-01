<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Inertia\Response;
use Laravel\Fortify\Features;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): Response
    {
        return inertia('Home', [
            'canRegister' => Features::enabled(Features::registration()),
            'laravel' => Application::VERSION,
            'php' => PHP_VERSION,
        ]);
    }
}
