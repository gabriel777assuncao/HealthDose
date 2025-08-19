<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function __construct(private readonly User $user)
    {
    }

    public function register(AuthRequest $request): JsonResponse
    {
        Log::info('Chegou no controller!');
        dd('aaaaaaaa');

        $this->user->create($request->validated());
        return response()->json(['message' => 'user created successfully', Response::HTTP_CREATED]);
    }
}
