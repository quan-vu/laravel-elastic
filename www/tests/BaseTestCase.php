<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BaseTestCase extends TestCase
{
    use RefreshDatabase;

    protected $tester;

    protected function getTesterUser()
    {
        $email = 'tester01@example.com';
        if (! $this->tester) {
            $this->tester = User::factory()->create(['email' => $email]);
        }
        return $this->tester;
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
