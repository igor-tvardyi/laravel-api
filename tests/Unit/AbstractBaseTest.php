<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

abstract class AbstractBaseTest extends TestCase
{

    protected function setUp()
    {
        parent::setUp();

//        $user = new User(['name' => 'test']);
//        $this->be($user);

        $token = $this->login('test', 'test');

        $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ]);
    }

    protected function login($username, $password)
    {
        $params = [
            'name' => $username,
            'password' => $password,
        ];

        $response = $this->json('POST', '/api/auth/login', $params)->json();

        return $response['access_token'] ?? null;
    }

}
