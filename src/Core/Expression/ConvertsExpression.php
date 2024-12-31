<?php

declare(strict_types=1);

namespace Filczek\PhpPolishNotation\Core\Expression;

interface ConvertsExpression
{
    public function toInfix(): static;

    public function toPrefix(): static;

    public function toPostfix(): static;
}
