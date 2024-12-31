<?php

declare(strict_types=1);

namespace Filczek\PhpPolishNotation\Core\Converters;

interface NotationConverter
{
    public function convert(array $expression): array;
}
