<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Fortify\Actions\GenerateNewRecoveryCodes;

class RecoveryCodeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, GenerateNewRecoveryCodes $generate): JsonResponse
    {
        $generate($request->user());

        return response()->json([
            'recovery_codes' => $request->user()->recoveryCodes(),
        ]);
    }
}
