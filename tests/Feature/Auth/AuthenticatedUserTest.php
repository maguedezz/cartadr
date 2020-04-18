<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Users\Domain\Models\User;

class AuthenticatedUserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_fails_if_user_isnt_authencated()
    {
        $this->get('api/user')
            ->assertStatus(401);
    }

    public function test_it_return_user_details()
    {
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'GET', 'api/user')
            ->assertJsonFragment([
                'email' => $user->email,
            ]);

    }
}
