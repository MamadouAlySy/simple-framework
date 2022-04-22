<?php

declare(strict_types=1);

namespace MamadouAlySy\SimpleFramework;

use MamadouAlySy\SimpleFramework\Http\Response;
use MamadouAlySy\SimpleFramework\Renderer\Renderer;
use MamadouAlySy\SimpleFramework\Renderer\RendererInterface;

abstract class Controller
{
    public function __construct(protected RendererInterface $renderer)
    {}

    public function render(string $view, array $data = []): Response
    {
        $content = $this->renderer->render($view, $data);

        return new Response(200, $content, ['Content-Type' => 'text/html; chrset=utf-8']);
    }
}