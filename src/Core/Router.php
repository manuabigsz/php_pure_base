<?php

namespace App\Core;

class Router
{
    private array $routes = [];
    private array $middlewares = [];
    private string $prefix = '';

    public function group(string $prefix, callable $callback)
    {
        $previousPrefix = $this->prefix;
        $this->prefix .= $prefix;
        $callback($this);
        $this->prefix = $previousPrefix;
    }

    public function add(string $method, string $path, callable $handler, array $middlewares = [])
    {
        $fullPath = $this->prefix . $path;
        $this->routes[$method][$fullPath] = ['handler' => $handler, 'middlewares' => $middlewares];
    }

    public function middleware(callable $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    public function dispatch(string $method, string $uri)
    {
        $route = $this->routes[$method][$uri] ?? null;
        if (!$route) {
            http_response_code(404);
            echo json_encode(['error' => 'Route not found']);
            return;
        }
        $handler = $route['handler'];
        $middlewares = array_merge($this->middlewares, $route['middlewares']);
        $pipeline = array_reduce(
            array_reverse($middlewares),
            fn($next, $mw) => fn() => $mw($next),
            $handler
        );
        $pipeline();
    }
}
