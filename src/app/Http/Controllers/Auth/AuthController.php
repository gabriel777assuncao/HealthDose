<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\{LoginRequest, RegisterRequest};
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function __construct(private readonly User $user)
    {
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $user = $this->user->create($request->validated());

        return response()->json(
            [
                'message' => 'user created successfully',
                'user' => $user,
            ],
            Response::HTTP_CREATED,
        );
    }

    public function me(): JsonResponse
    {
        return response()->json(
            [
                'message' => 'user created successfully',
                'user' => auth()->user(),
            ],
        );
    }

    public function logout(): JsonResponse
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $loggingCredentials = $request->validated();

        if (! $token = auth()->attempt($loggingCredentials)) {
            return response()->json(['message' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            'token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60,
        ]);
    }

    public function refresh(): JsonResponse
    {
        $newToken = auth()->refresh();

        return response()->json([
            'token' => $newToken,
            'token_type' => 'Bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60,
        ]);
    }
}
