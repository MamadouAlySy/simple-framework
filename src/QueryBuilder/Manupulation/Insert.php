<?php

declare(strict_types=1);

namespace MamadouAlySy\SimpleFramework\QueryBuilder\Manupulation;

use MamadouAlySy\SimpleFramework\QueryBuilder\Manupulation\Traits\IntoTait;
use MamadouAlySy\SimpleFramework\QueryBuilder\Manupulation\Traits\ValuesTrait;
use MamadouAlySy\SimpleFramework\QueryBuilder\Statement;

class Insert extends Statement
{
    use IntoTait;
    use ValuesTrait;

    /**
     * @inheritDoc
     */
    public function toSql(): string
    {
        return 'INSERT ' . $this->getInto() . ' ' . $this->getValues();
    }

    /**
     * @inheritDoc
     */
    public function getParameters(): array
    {
        return $this->values;
    }
}