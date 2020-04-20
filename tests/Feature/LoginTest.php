<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testInvalidLogin()
    {
        $this->json('POST', 'api/login')
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'email' => ['The email field is required.'],
                    'password' => ['The password field is required.'],
                ]
            ]);
    }

    public function testUserLogin()
    {
        $user = factory(User::class)->create([
            'email' => 'test@test.com',
            'password' => bcrypt('test@123'),
            'password_confirmation' => bcrypt('test@123')
        ]);

        $payload = array('email' => 'test@test.com', 'password' => 'test@123');

        $this->json('POST', '/api/login', $payload)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email',
                    'email_verified_at',
                    'created_at',
                    'updated_at',
                    'api_token',
                ],
            ]);
    }
}
