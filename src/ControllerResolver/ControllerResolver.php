<?php

declare(strict_types=1);

namespace MamadouAlySy\SimpleFramework\ControllerResolver;

use MamadouAlySy\SimpleFramework\Container\ContainerInterface;
use MamadouAlySy\SimpleFramework\ControllerResolver\Exception\ControllerResolverException;
use MamadouAlySy\SimpleFramework\Http\ResponseInterface;
use ReflectionMethod;

class ControllerResolver implements ControllerResolverInterface
{
    public function __construct(protected ContainerInterface $container)
    {}

    /**
     * @inheritDoc
     */
    public function resolve(array $callable): ResponseInterface
    {
        list($controllerName, $actionName) = $callable;
        if (class_exists($controllerName)) {
            $controllerObject = $this->container->get($controllerName);
            if (method_exists($controllerObject, $actionName)) {
                $reflectionMethod = new ReflectionMethod($controllerObject, $actionName);
                $dependencies = $this->container->resolveDependencies($reflectionMethod->getParameters());
                return call_user_func_array([$controllerObject, $actionName], $dependencies);
            }
            throw new ControllerResolverException("Unable to call " . "$controllerName::$actionName");
        }
        throw new ControllerResolverException($controllerName . ' class does not exists.');
    }
}