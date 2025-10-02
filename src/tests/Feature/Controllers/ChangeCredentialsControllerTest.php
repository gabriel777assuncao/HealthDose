<?php

namespace Feature\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\{LazilyRefreshDatabase, WithFaker};
use Illuminate\Support\Facades\{Cache, Hash};
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ChangeCredentialsControllerTest extends TestCase
{
    use LazilyRefreshDatabase;
    use WithFaker;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => bcrypt('old-password'),
        ]);
    }

    public function test_it_sends_reset_token_to_existing_user(): void
    {
        Cache::shouldReceive('put')->once();

        $response = $this->postJson('/api/auth/request-reset-password', [
            'email' => $this->user->email,
        ]);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(['message', 'token']);
    }

    public function test_it_returns_404_when_sending_token_to_nonexistent_user(): void
    {
        Cache::shouldReceive('put')->once();

        $response = $this->postJson('/api/auth/request-reset-password', [
            'email' => 'nonexistent@example.com',
        ]);

        $response->assertStatus(Response::HTTP_NOT_FOUND)
            ->assertJson([
                'message' => 'User not found.',
            ]);
    }

    public function test_it_resets_password_with_valid_token(): void
    {
        $token = 'valid-token';
        $hashedToken = Hash::make($token);

        Cache::shouldReceive('get')
            ->once()
            ->with('reset_token:'.$this->user->email)
            ->andReturn($hashedToken);

        Cache::shouldReceive('forget')
            ->once()
            ->with('reset_token:'.$this->user->email);

        $response = $this->postJson('/api/auth/reset-password', [
            'email' => $this->user->email,
            'token' => $token,
            'new_password' => '35314131aSd@',
            'new_password_confirmation' => '35314131aSd@',
        ]);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'message' => 'Password changed successfully.',
            ]);

        $this->assertTrue(
            Hash::check('35314131aSd@', $this->user->fresh()->password)
        );
    }

    public function test_it_rejects_invalid_token_on_password_reset(): void
    {
        Cache::shouldReceive('get')
            ->once()
            ->with('reset_token:'.$this->user->email)
            ->andReturn(Hash::make('correct-token'));

        $response = $this->postJson('/api/auth/reset-password', [
            'email' => $this->user->email,
            'token' => 'wrong-token',
            'new_password' => '35314131aSd@',
            'new_password_confirmation' => '35314131aSd@',
        ]);

        $response->assertStatus(Response::HTTP_BAD_REQUEST)
            ->assertJson([
                'message' => 'Invalid token.',
            ]);
    }

    public function test_it_returns_404_when_user_not_found_on_password_reset(): void
    {
        $token = 'valid-token';

        Cache::shouldReceive('get')
            ->once()
            ->with('reset_token:ghost@example.com')
            ->andReturn(Hash::make($token));

        $response = $this->postJson('/api/auth/reset-password', [
            'email' => 'ghost@example.com',
            'token' => $token,
            'new_password' => '35314131aSd@',
            'new_password_confirmation' => '35314131aSd@',
        ]);

        $response->assertStatus(Response::HTTP_NOT_FOUND)
            ->assertJson([
                'message' => 'User not found.',
            ]);
    }
}
