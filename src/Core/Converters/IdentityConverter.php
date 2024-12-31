<?php

declare(strict_types=1);

namespace Filczek\PhpPolishNotation\Core\Converters;

final readonly class IdentityConverter implements NotationConverter
{
    public function convert(array $expression): array
    {
        return $expression;
    }
}
