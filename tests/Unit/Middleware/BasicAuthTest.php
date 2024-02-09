<?php

namespace Tests\Unit\Middleware;

use Illuminate\Http\Request;
use App\Http\Middleware\BasicAuth;
use Closure;
use Tests\TestCase;

class BasicAuthTest extends TestCase
{
    /** @test */
    public function it_allows_request_with_valid_credentials()
    {
        // Set the environment variables
        config(['services.partner_in_auth_username' => env('PARTNER_IN_AUTH_USERNAME')]);
        config(['services.partner_in_auth_password' => env('PARTNER_IN_AUTH_PASSWORD')]);

        // Create a request with valid credentials
        $request = $this->createRequest(env('PARTNER_IN_AUTH_USERNAME'), env('PARTNER_IN_AUTH_PASSWORD'));

        // Create a middleware instance
        $middleware = new BasicAuth();

        // Define a closure for the next middleware
        $nextMiddleware = function ($request) {
            return response('Passed the middleware');
        };

        // Call the handle method of the middleware
        $response = $middleware->handle($request, $nextMiddleware);

        // Assert that the response is as expected
        $this->assertEquals('Passed the middleware', $response->getContent());
    }

    /** @test */
    public function it_returns_401_response_with_invalid_credentials()
    {
        // Set the environment variables
        config(['services.partner_in_auth_username' => 'valid_username']);
        config(['services.partner_in_auth_password' => 'valid_password']);

        // Create a request with invalid credentials
        $request = $this->createRequest('invalid_username', 'invalid_password');

        // Create a middleware instance
        $middleware = new BasicAuth();

        // Define a closure for the next middleware
        $nextMiddleware = function ($request) {
            return response('Passed the middleware');
        };

        // Call the handle method of the middleware
        $response = $middleware->handle($request, $nextMiddleware);

        // Assert that the response has a 401 status code
        $this->assertEquals(401, $response->getStatusCode());

        // Assert that the response contains 'Invalid credentials.'
        $this->assertEquals('Invalid credentials.', $response->getContent());

        // Assert that the response has the 'WWW-Authenticate' header
        $this->assertTrue($response->headers->has('WWW-Authenticate'));
    }

    /**
     * Helper method to create a Request with basic auth credentials.
     *
     * @param string $username
     * @param string $password
     * @return Request
     */
    private function createRequest($username, $password)
    {
        return Request::create('/', 'GET', [], [], [], [
            'PHP_AUTH_USER' => $username,
            'PHP_AUTH_PW' => $password,
        ]);
    }
}
