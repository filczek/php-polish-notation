<?php

declare(strict_types=1);

namespace Filczek\PhpPolishNotation\Core\Expression;

final readonly class ExpressionElement
{
    public function __construct(
        public mixed $value,
        public ExpressionElementType $type,
    ) {
    }
}
