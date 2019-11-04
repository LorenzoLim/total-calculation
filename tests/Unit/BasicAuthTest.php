<?php

namespace Tests\Unit;

use Tests\TestCase;

class BasicAuthTest extends TestCase
{
    /**
     * @test
     */
    public function basic_auth_test()
    {
        $client = new \GuzzleHttp\Client();
        $username = env('API_USERNAME');
        $password = env('API_PASSWORD');

        $response = $client->request('POST', 'http://127.0.0.1:8000/test', ['auth' => [
            $username,
            $password
        ]]);

        $statusCode = $response->getStatusCode();
        $this->assertEquals($statusCode, 200);
    }
}
