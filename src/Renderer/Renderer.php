<?php

declare(strict_types=1);

namespace MamadouAlySy\SimpleFramework\Renderer;

class Renderer
{
    protected string $defaulLayout = 'default';
    protected array $blocks = [];
    protected ?string $currentBlock = null;

    public function __construct(protected string $viewDir)
    {}

    /**
     * @inheritDoc
     */
    public function render(string $view, array $data = []): string
    {
        extract($data);
        $view = str_replace(['/','\\', '.'], '/', $view);
        require_once VIEWS_DIR . DS . $view . '.php';
        
        ob_start();
        $defaulLayout = str_replace(['/','\\', '.'], '/', $this->defaulLayout);
        require_once VIEWS_DIR . DS . $defaulLayout. '.php';

        return ob_get_clean();
    }

    /**
     * Set the default layout
     *
     * @param string $layout
     * @return void
     */
    protected function layout(string $layout)
    {
        $this->defaulLayout = $layout;
    }

    /**
     * Start a block a give it a name
     *
     * @param string $blockName
     * @return void
     */
    protected function block(string $blockName): void
    {
        $this->currentBlock = $blockName;
        ob_start();
    }

    /**
     * Ends a block
     *
     * @return void
     */
    protected function endBlock(): void
    {
        $this->blocks[$this->currentBlock] = ob_get_clean();
        $this->currentBlock = null;
    }

    /**
     * Display the block with the given name
     *
     * @param string $name
     * @return void
     */
    protected function displayBlock(string $name): void
    {
        echo $this->blocks[$name] ?? '';
    }

    /**
     * Include a partial file
     *
     * @param string $partial
     * @return void
     */
    protected function usePartial(string $partial): void
    {
        ob_start();
        $partial = str_replace(['/','\\', '.'], '/', $partial);
        require_once VIEWS_DIR . DS . $partial . '.php';

        echo ob_get_clean();
    }
}