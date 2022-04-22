<?php

declare(strict_types=1);

namespace MamadouAlySy\SimpleFramework\Router;

use MamadouAlySy\SimpleFramework\Http\RequestInterface;
use MamadouAlySy\SimpleFramework\Router\Exception\RouteNotFoundException;

interface RouterInterface
{
    /**
     * Register new Route
     *
     * @param string $methods you can multiple method separated with comma example: GET, POST, PUT ...
     * @param string $path
     * @param array $callback
     * @param string|null $name
     * 
     * @return RouteInterface
     */
    public function register(string $methods, string $path, array $callback, ?string $name = null): RouteInterface;

    /**
     * Generate the uri for the given route name
     *
     * @param string $name
     * 
     * @return string
     */
    public function generateUri(string $name): string;

    /**
     * Resolve route
     *
     * @param RequestInterface $request
     * @throws RouteNotFoundException
     * 
     * @return RouteInterface
     */
    public function findRouteThatMatches(RequestInterface $request): RouteInterface;
}