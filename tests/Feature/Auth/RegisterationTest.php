<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Users\Domain\Models\User;

class RegisterationTest extends TestCase
{
    public function test_it_registers_a_user()
    {
        $this->post('api/auth/register', [
            'name' => $name = 'magued',
            'email' => $email = 'nano@test.ch',
            'password' => 'secret',
        ])->assertStatus(201)->assertJsonFragment(compact('name', 'email'));
    }

    public function test_it_requires_a_unique_email()
    {
        $user = factory(User::class)->create();

        $this->post('api/auth/register', [
            'email' => 'nope',
        ])->assertJsonValidationErrors(['email']);
    }

    public function test_it_requires_a_valid_email()
    {
        $this->post('api/auth/register', [
            'email' => 'nope',
        ])->assertJsonValidationErrors(['name', 'password', 'email']);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_requires_data()
    {
        $this->post('api/auth/register')
            ->assertJsonValidationErrors(['name', 'password', 'email']);
    }
}
