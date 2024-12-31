<?php

declare(strict_types=1);

namespace Filczek\PhpPolishNotation\Core\Expression\Stringifier;

interface StringifiesExpression
{
    public function stringify(array $expression): string;
}
