<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'email' => 'testuser@example.com',
            'password' => bcrypt('password123'),
        ]);
    }

    public function test_email_password_auth_success()
    {
        $this->post('/api/login', [
            'email' => 'testuser@example.com',
            'password' => 'password123',
        ])
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(['token']);
    }

    public function test_email_password_auth_fail_invalid_password()
    {
        $this->post('/api/login', [
            'email' => 'testuser@example.com',
            'password' => 'wrongpassword',
        ])
            ->assertStatus(Response::HTTP_UNAUTHORIZED)
            ->assertJson(['message' => 'Unauthorized']);
    }

    public function test_register_success()
    {
        $this->post('/api/register', [
            'name' => 'New User',
            'email' => 'newuser@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ])
            ->assertStatus(Response::HTTP_OK);
    }

    public function test_register_fail_password_mismatch()
    {
        $this->postJson('/api/register', [
            'name' => 'New User',
            'email' => 'newuser@example.com',
            'password' => 'password123',
            'password_confirmation' => 'wrongpassword',
        ])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
