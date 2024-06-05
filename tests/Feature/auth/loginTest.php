<?php

namespace Tests\Feature\auth;


// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\User;
use Tests\TestCase;

class loginTest extends TestCase
{
    //  use RefreshDatabase;
    public function test_user_login_success()
    {
        // $user = User::factory()->create([
        //     'email' => 'test1@gmail.com',
        //     'password' => '123123123'
        // ]);

        $response = $this->postJson('api/v1/auth/Login', [
            'email' => 'test1@gmail.com',
            'password' => '123123123'
        ]);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'token',
                'data' => [
                    'user_id',
                    'name',
                    'email'
                ]
            ]);
    }


    public function test_user_login_failure()
    {
        $response = $this->postJson('api/v1/auth/Login', [
            'email' => 'test@example.com',
            'password' => 'wrongpassword'
        ]);

        $response->assertStatus(401)
            ->assertJson(['error' => 'Unauthorized']);
    }

    public function test_user_logout()
    {
        $user = User::factory()->create();

        $token = $user->createToken('TestToken')->accessToken;

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->postJson('api/v1/auth/Logout');

        $response->assertStatus(200)
            ->assertJson(['message' => 'logged out successfully ']);
    }

    public function test_unauthorized_auth_view()
    {
        $response = $this->get('/api/v1/Categories');

        $response->assertStatus(302)
            ->assertJson(['message' => 'Unauthenticated.']);
    }
}
