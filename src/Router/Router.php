<?php

declare(strict_types=1);

namespace MamadouAlySy\SimpleFramework\Router;

use MamadouAlySy\SimpleFramework\Http\Request;
use MamadouAlySy\SimpleFramework\Http\RequestInterface;
use MamadouAlySy\SimpleFramework\Router\Exception\RouteNotFoundException;

class Router implements RouterInterface
{
    /**
     * @param array $routes
     * @param array $namedRoutes
     */
    public function __construct(protected array $routes = [], protected array $namedRoutes = [])
    {}
    
    /**
     * @inheritDoc
     */
    public function register(string $methods, string $path, array $callback, ?string $name = null): RouteInterface
    {
        $route = new Route($path, $callback,$name);
        $methodsArray = explode(',', $methods);

        if (!is_null($name)) {
            $this->namedRoutes[$name] = $route;
        }

        foreach ($methodsArray as $method) {
            $method = strtolower(trim($method));
            $this->routes[$method][$path] = $route;
        }

        return $route;
    }

    /**
     * @inheritDoc
     */
    public function generateUri(string $name): string
    {
        return $this->namedRoutes[$name] ?? '';
    }

    /**
     * @inheritDoc
     */
    public function findRouteThatMatches(RequestInterface $request): RouteInterface
    {
        $method = strtolower($request->getMethod());
        $uri = $request->getUri();
        $route = $this->routes[$method][$uri] ?? null;

        return $route ?? throw new RouteNotFoundException();
    }
}