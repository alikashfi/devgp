<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function getJsonRoute(string $route, mixed $routeParams = [], array $headers = [])
    {
        return $this->json('GET', route($route, $routeParams), [], $headers);
    }

    public function postJsonRoute(string $route, string|array $routeParams = [], array $data = [], array $headers = [])
    {
        return $this->json('POST', route($route, $routeParams), $data, $headers);
    }
}
