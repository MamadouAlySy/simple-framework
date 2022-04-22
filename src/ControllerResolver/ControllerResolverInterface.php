<?php

declare(strict_types=1);

namespace MamadouAlySy\SimpleFramework\ControllerResolver;

use MamadouAlySy\SimpleFramework\ControllerResolver\Exception\ControllerResolverException;
use MamadouAlySy\SimpleFramework\Http\ResponseInterface;

interface ControllerResolverInterface
{
    /**
     * Resolve the given controller callable
     *
     * @param array $callable
     * @throws ControllerResolverException
     * 
     * @return ResponseInterface
     */
    public function resolve(array $callable): ResponseInterface;
}