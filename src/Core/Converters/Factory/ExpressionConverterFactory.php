<?php

declare(strict_types=1);

namespace Filczek\PhpPolishNotation\Core\Converters\Factory;

use BackedEnum;
use Filczek\PhpPolishNotation\Core\Converters\NotationConverter;

interface ExpressionConverterFactory
{
    public function createConverter(BackedEnum $from, BackedEnum $to): NotationConverter;
}
