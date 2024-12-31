<?php

declare(strict_types=1);

namespace Filczek\PhpPolishNotation\Expressions\MathematicalExpression;

use BackedEnum;
use Filczek\PhpPolishNotation\Core\Converters\Factory\DefaultExpressionConverterFactory;
use Filczek\PhpPolishNotation\Core\Converters\Factory\ExpressionConverterFactory;
use Filczek\PhpPolishNotation\Core\Converters\NotationConverter;

final readonly class MathematicalExpressionConverterFactory implements ExpressionConverterFactory
{
    public function createConverter(BackedEnum $from, BackedEnum $to): NotationConverter
    {
        $prioritizes_operator = new MathematicalOperatorPriority();
        $converter = new DefaultExpressionConverterFactory($prioritizes_operator);

        return $converter->createConverter($from, $to);
    }
}
