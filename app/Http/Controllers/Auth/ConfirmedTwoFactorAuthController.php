<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Fortify\Actions\ConfirmTwoFactorAuthentication;
use Laravel\Fortify\Actions\GenerateNewRecoveryCodes;

class ConfirmedTwoFactorAuthController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, ConfirmTwoFactorAuthentication $confirm): JsonResponse
    {
        $confirm($request->user(), $request->input('code'));

        app(GenerateNewRecoveryCodes::class)($request->user());

        return response()->json([
            'status' => 'two-factor-authentication-confirmed',
            'recovery_codes' => $request->user()->recoveryCodes(),
        ]);
    }
}
