<?php

declare(strict_types=1);

namespace Filczek\PhpPolishNotation\Core\Converters;

use Filczek\PhpPolishNotation\Core\Priorities\PrioritizesOperator;

final readonly class PostfixToPrefixConverter implements NotationConverter
{
    public function __construct(
        private PrioritizesOperator $prioritizes_operator,
    ) {
    }

    public function convert(array $expression): array
    {
        $infix = (new PostfixToInfixConverter())->convert($expression);
        $prefix = (new InfixToPrefixConverter($this->prioritizes_operator))->convert($infix);

        return $prefix;
    }
}
