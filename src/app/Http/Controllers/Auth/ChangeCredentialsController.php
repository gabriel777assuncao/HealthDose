<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\{ResetPasswordRequest, SendResetLinkRequest};
use App\Models\User;
use App\Notifications\Authentication\{NotifyAboutChangeCredentials};
use Illuminate\Http\{JsonResponse};
use Illuminate\Support\Facades\{Cache, Hash};
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class ChangeCredentialsController extends Controller
{
    private const string RESET_TOKEN_CACHE_KEY = 'reset_token:';

    public function reset(ResetPasswordRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $user = User::where('email', $validated['email'])->first();
        $cacheKey = self::RESET_TOKEN_CACHE_KEY.$validated['email'];
        $cachedToken = Cache::get($cacheKey);

        if (! $cachedToken || ! Hash::check($validated['token'], $cachedToken)) {
            return response()->json(
                [
                    'message' => 'Invalid token.',
                ],
                Response::HTTP_BAD_REQUEST,
            );
        }

        if (! $user) {
            return response()->json(
                [
                    'message' => 'User not found.',
                ],
                Response::HTTP_NOT_FOUND,
            );
        }

        $user->update([
            'password' => bcrypt($validated['new_password']),
        ]);

        Cache::forget($cacheKey);

        return response()->json(
            [
                'message' => 'Password changed successfully.',
            ],
            Response::HTTP_OK,
        );
    }

    public function sendResetToken(SendResetLinkRequest $request): JsonResponse
    {
        $validated = $request->validated()['email'];
        $user = User::where('email', $validated)->first();
        $token = Str::random(5);
        Cache::put(self::RESET_TOKEN_CACHE_KEY.':'.$validated, Hash::make($token), now()->addMinutes(3));

        if (! $user) {
            return response()->json(
                [
                    'message' => 'User not found.',
                ],
                Response::HTTP_NOT_FOUND,
            );
        }

        $user->notify(new NotifyAboutChangeCredentials($user, $token));

        return response()->json(
            [
                'message' => 'Token was sent to email.',
                'token' => $token,
            ],
            Response::HTTP_OK,
        );
    }
}
