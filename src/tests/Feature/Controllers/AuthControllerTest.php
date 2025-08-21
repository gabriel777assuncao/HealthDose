<?php

namespace Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\{LazilyRefreshDatabase, WithFaker};
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use LazilyRefreshDatabase;
    use WithFaker;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'gabrielassuncaocosta2@gmail.com',
            'password' => bcrypt('password'),
            'cellphone' => now(),
        ]);
    }

    public function test_if_user_can_register(): void
    {
        $response = $this->postJson('/api/auth/register', [
            'name' => 'Test User',
            'email' => $this->faker->unique()->safeEmail,
            'username' => $this->faker->userName,
            'password' => $this->faker->password,
            'cellphone' => $this->faker->phoneNumber,
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJsonFragment([
            'message' => 'user created successfully',
        ]);
        $this->assertDatabaseHas('users', [
            'email' => $response->json('user.email'),
            'name' => $response->json('user.name'),
            'username' => $response->json('user.username'),
            'cellphone' => $response->json('user.cellphone'),
        ]);
    }

    public function test_if_user_can_login(): void
    {
        $response = $this->postJson('/api/auth/login', [
            'email' => $this->user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonFragment([
            'token' => $response->json('token'),
            'token_type' => $response->json('token_type'),
        ]);
    }

    public function test_if_user_will_be_unauthorized_with_fake_credentials(): void
    {
        $response = $this->postJson('/api/auth/login', [
            'email' => $this->user->email,
            'password' => 'aaaaaaaaaaaa',
        ]);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function test_if_user_can_logout(): void
    {
        $this->postJson('/api/auth/login', [
            'email' => $this->user->email,
            'password' => 'password',
        ]);

        $response = $this->postJson('/api/auth/logout');
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonFragment([
            'message' => 'Successfully logged out',
        ]);
    }

    public function test_if_user_can_refresh_token(): void
    {
        $this->postJson('/api/auth/login', [
            'email' => $this->user->email,
            'password' => 'password',
        ]);

        $response = $this->postJson('/api/auth/refresh');
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonFragment([
            'token' => $response->json('token'),
            'token_type' => $response->json('token_type'),
        ]);
    }
}
