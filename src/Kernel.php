<?php

declare(strict_types=1);

namespace MamadouAlySy\SimpleFramework;

use MamadouAlySy\SimpleFramework\Container\Container;
use MamadouAlySy\SimpleFramework\Container\ContainerInterface;
use MamadouAlySy\SimpleFramework\ControllerResolver\ControllerResolver;
use MamadouAlySy\SimpleFramework\Http\RequestInterface;
use MamadouAlySy\SimpleFramework\Http\ResponseInterface;
use MamadouAlySy\SimpleFramework\Renderer\Renderer;
use MamadouAlySy\SimpleFramework\Renderer\RendererInterface;
use MamadouAlySy\SimpleFramework\Router\Router;
use MamadouAlySy\SimpleFramework\Router\RouterInterface;

class Kernel
{
    protected ContainerInterface $container;
    protected Router $router;

    public function __construct(string $publicDir)
    {
        $this->createConstants($publicDir);
        $this->container = new Container();

        $this->container->makeSingleton(RendererInterface::class, new Renderer(VIEWS_DIR));
    }

    public function createConstants(string $publicDir): void
    {
        define('DS', DIRECTORY_SEPARATOR);
        define('ROOT_DIR', dirname($publicDir));
        define('APP_DIR', ROOT_DIR . DS . 'app');
        define('VIEWS_DIR', ROOT_DIR . DS . 'views');
    }

    public function handle(RequestInterface $request): ResponseInterface
    {
        // Get All routes
        $this->router = require_once APP_DIR . DS . 'routes.php';

        $this->container->makeSingleton(RequestInterface::class, $request);
        $this->container->makeSingleton(RouterInterface::class, $router);
        
        $controllerResolver = new ControllerResolver($this->container);
        $route = $this->router->findRouteThatMatches($request);
        // $middlewares = $route->getMiddlewares();

        return $controllerResolver->resolve($route->getCallable());
    }

    /**
     * Get the value of container
     *
     * @return ContainerInterface
     */
    public function getContainer(): ContainerInterface
    {
        return $this->container;
    }
}