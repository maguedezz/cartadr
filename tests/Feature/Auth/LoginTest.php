<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Users\Domain\Models\User;

class LoginTest extends TestCase
{
    public function test_it_returns_a_token_if_credentials_do_match()
    {
        $user = factory(User::class)->create([
            'password' => 'cats',
        ]);

        $this->post('api/auth/login', [
            'email' => $user->email,
            'password' => 'cats',
        ])->assertJsonStructure([
            'meta' => [
                'token',
            ],
        ]);
    }

    public function test_it_returns_a_user_if_credentials_do_match()
    {
        $user = factory(User::class)->create([
            'password' => 'cats',
        ]);

        $this->post('api/auth/login', [
            'email' => $user->email,
            'password' => 'cats',

        ])
            ->assertJsonFragment([
                'id' => $user->id,

            ]);
    }

    public function test_it_returns_a_validation_error_if_credentials_dont_match()
    {
        $user = factory(User::class)->create();

        $this->post('api/auth/login', [
            'email' => $user->email,
            'password' => 'nope',
        ])->assertStatus(401);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_requires_an_email_and_password()
    {
        $this->post('/api/auth/login')
            ->assertJsonValidationErrors(['email', 'password']);
    }
}
