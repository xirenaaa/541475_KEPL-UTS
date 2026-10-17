<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test user can login and receive a token.
     */
    public function test_user_can_login_and_receive_token(): void
    {
        $user = User::factory()->create([
            'email'    => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->postJson('/api/login', [
            'email'    => 'test@example.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'message',
                     'user' => ['id', 'name', 'email'],
                     'token',
                 ]);
    }

    /**
     * Test unauthenticated user cannot access protected routes.
     */
    public function test_unauthenticated_user_cannot_access_books(): void
    {
        $response = $this->getJson('/api/books');

        $response->assertStatus(401);
    }

    /**
     * Test login fails with wrong credentials.
     */
    public function test_login_fails_with_wrong_credentials(): void
    {
        User::factory()->create([
            'email'    => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->postJson('/api/login', [
            'email'    => 'test@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(422);
    }
}
