<?php

declare(strict_types=1);

namespace MamadouAlySy\SimpleFramework\Renderer;

interface RendererInterface
{
    /**
     * Render a view by passing somme data
     *
     * @param string $view
     * @param array $data
     * 
     * @return string
     */
    public function render(string $view, array $data = []): string;
}