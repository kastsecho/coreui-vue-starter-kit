<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Laravel\Fortify\Actions\DisableTwoFactorAuthentication;
use Laravel\Fortify\Actions\EnableTwoFactorAuthentication;

class TwoFactorAuthController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, EnableTwoFactorAuthentication $enable): JsonResponse
    {
        $enable($request->user());

        return response()->json([
            'qrCode' => $request->user()->twoFactorQrCodeSvg(),
            'secret' => decrypt($request->user()->two_factor_secret),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request): Response
    {
        $user = $request->user();
        $confirmed = !is_null($user->two_factor_confirmed_at);

        if (!$confirmed) {
            app(DisableTwoFactorAuthentication::class)($user);
        }

        return inertia('settings/TwoFactor', [
            'confirmed' => $confirmed,
            'recoveryCodes' => !is_null($user->two_factor_secret) ? $user->recoveryCodes() : [],
        ]);
    }
}
