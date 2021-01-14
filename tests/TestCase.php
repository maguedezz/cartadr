<?php

namespace Tests;

use Illuminate\Support\Arr;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

    /**
     * @param $response
     * @param $keys
     * @return mixed
     */
    public function assertJsonValidationMessages($response, $keys)
    {
        $errors = $response->json()['errors'];

        foreach (Arr::wrap($keys) as $key => $message) {
            $this->assertEquals($message, $errors[$key][0]);
        }

        return $this;
    }

    /**
     * @param JWTSubject $user
     * @param $method
     * @param $endpoint
     * @param array $data
     * @param array $headers
     */
    public function jsonAs(JWTSubject $user, $method, $endpoint, $data = [], $headers = [])
    {
        $token = auth()->tokenById($user->id);

        return $this->json($method, $endpoint, $data, array_merge($headers, [
            'Authorization' => 'Bearer' . $token,
        ]));
    }
}
