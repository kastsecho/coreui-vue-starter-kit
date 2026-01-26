<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Events\DiagnosingHealth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class HealthUpController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): JsonResponse|Response
    {
        $exception = null;

        try {
            Event::dispatch(new DiagnosingHealth);
        } catch (Throwable $e) {
            throw_if(app()->hasDebugModeEnabled(), $e);

            report($e);

            $exception = $e->getMessage();
        }

        return inertia('HealthUp', [
            'exception' => $exception,
            'responseStart' => LARAVEL_START,
            'responseEnd' => microtime(true),
        ])->toResponse($request)->setStatusCode($exception ? 500 : 200);
    }
}
