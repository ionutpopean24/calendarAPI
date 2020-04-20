<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    public function testUserLogout()
    {
        $user = factory(User::class)->create(['email' => 'user@test.com']);
        $token = $user->generateToken();
        $payload = ['api_token' => $token];

        $this->json('post', '/api/logout', [], $payload)->assertStatus(200);

        $user = User::find($user->id);

        $this->assertEquals(null, $user->api_token);
    }
}
