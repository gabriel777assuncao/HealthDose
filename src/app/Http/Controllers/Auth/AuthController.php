<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\AuthRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class AuthController
{
    public function register(AuthRequest $request): JsonResponse
    {
        Log::info('Chegou no controller!');

        $data = $request->validated();

        dd($data);

        return response()->json(['message' => 'test']);
    }
}
