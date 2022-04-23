<?php

declare(strict_types=1);

namespace MamadouAlySy\SimpleFramework;

use MamadouAlySy\SimpleFramework\Container\Container;
use MamadouAlySy\SimpleFramework\Container\ContainerInterface;
use MamadouAlySy\SimpleFramework\ControllerResolver\ControllerResolver;
use MamadouAlySy\SimpleFramework\ControllerResolver\ControllerResolverInterface;
use MamadouAlySy\SimpleFramework\DatabaseConnection\DatabaseConnection;
use MamadouAlySy\SimpleFramework\DatabaseConnection\DatabaseConnectionInterface;
use MamadouAlySy\SimpleFramework\Http\RequestInterface;
use MamadouAlySy\SimpleFramework\Http\ResponseInterface;
use MamadouAlySy\SimpleFramework\QueryBuilder\QueryBuilder;
use MamadouAlySy\SimpleFramework\QueryBuilder\QueryBuilderInterface;
use MamadouAlySy\SimpleFramework\Renderer\Renderer;
use MamadouAlySy\SimpleFramework\Renderer\RendererInterface;
use MamadouAlySy\SimpleFramework\Router\RouterInterface;

class Kernel
{
    protected static ContainerInterface $container;

    public function __construct(string $publicDir)
    {
        $this->createConstants($publicDir);
        static::$container = new Container();

        static::$container->makeSingleton(RendererInterface::class, new Renderer(VIEWS_DIR));
        static::$container->makeSingleton(QueryBuilderInterface::class, new QueryBuilder());

        static::$container->makeSingleton(DatabaseConnectionInterface::class, function () {
            $databaseConfiguration = require_once CONFIG_DIR . DS . 'database.php';
            return new DatabaseConnection($databaseConfiguration['mysql']);
        });

        static::$container->makeSingleton(RouterInterface::class, function () {
            return require_once APP_DIR . DS . 'routes.php';
        });

        static::$container->makeSingleton(ControllerResolverInterface::class, function($container) {
            return new ControllerResolver($container);
        });
    }

    public function createConstants(string $publicDir): void
    {
        define('DS', DIRECTORY_SEPARATOR);
        define('ROOT_DIR', dirname($publicDir));
        define('APP_DIR', ROOT_DIR . DS . 'app');
        define('VIEWS_DIR', ROOT_DIR . DS . 'views');
        define('CONFIG_DIR', ROOT_DIR . DS . 'config');
    }

    public function handle(RequestInterface $request): ResponseInterface
    {
        static::$container->makeSingleton(RequestInterface::class, $request);

        $controllerResolver = static::$container->get(ControllerResolverInterface::class);
        $router = static::$container->get(RouterInterface::class);
        $route = $router->findRouteThatMatches($request);

        return $controllerResolver->resolve($route->getCallable());
    }

    /**
     * Get the value of container
     *
     * @return ContainerInterface
     */
    public static function getContainer(): ContainerInterface
    {
        return static::$container;
    }
}