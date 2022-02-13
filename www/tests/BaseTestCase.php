<?php

namespace Tests;

use App\Models\User;

class BaseTestCase extends TestCase
{
    protected function getTesterUser()
    {
        $email = 'tester01@example.com';
        $user = User::where(['email' => $email])->first();
        if (!$user) {
            User::factory()->create(['email' => $email]);
        }
        return $user;
    }

    protected function getToken(string $tokenName = 'Personal Access Token')
    {
        return $this->getTesterUser()->createToken($tokenName)->plainTextToken;
    }

    protected function api(array $headers = [])
    {
        $token = $this->getToken();
        // echo $token;
        $authorizationHeader = [
            'Authorization' => "Bearer $token"
        ];
        $headers = !empty($headers) ? array_merge($headers, $authorizationHeader) : $authorizationHeader;
        return $this->withHeaders($headers);
    }
}
