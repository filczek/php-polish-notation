<?php

declare(strict_types=1);

namespace Filczek\PhpPolishNotation\Core\Converters\Factory;

use BackedEnum;
use Filczek\PhpPolishNotation\Core\Converters\IdentityConverter;
use Filczek\PhpPolishNotation\Core\Converters\InfixToPostfixConverter;
use Filczek\PhpPolishNotation\Core\Converters\InfixToPrefixConverter;
use Filczek\PhpPolishNotation\Core\Converters\NotationConverter;
use Filczek\PhpPolishNotation\Core\Converters\PostfixToInfixConverter;
use Filczek\PhpPolishNotation\Core\Converters\PostfixToPrefixConverter;
use Filczek\PhpPolishNotation\Core\Converters\PrefixToInfixConverter;
use Filczek\PhpPolishNotation\Core\Converters\PrefixToPostfixConverter;
use Filczek\PhpPolishNotation\Core\Expression\ExpressionNotation;
use Filczek\PhpPolishNotation\Core\Priorities\PrioritizesOperator;

final readonly class DefaultExpressionConverterFactory implements ExpressionConverterFactory
{
    public function __construct(
        private PrioritizesOperator $prioritizes_operator,
    ) {
    }

    public function createConverter(BackedEnum $from, BackedEnum $to): NotationConverter
    {
        $from = ExpressionNotation::from($from->value);
        $to = ExpressionNotation::from($to->value);

        return match ([$from, $to]) {
            [ExpressionNotation::Infix, ExpressionNotation::Infix],
            [ExpressionNotation::Prefix, ExpressionNotation::Prefix],
            [ExpressionNotation::Postfix, ExpressionNotation::Postfix] => new IdentityConverter(),

            [ExpressionNotation::Infix, ExpressionNotation::Prefix] => new InfixToPrefixConverter($this->prioritizes_operator),
            [ExpressionNotation::Infix, ExpressionNotation::Postfix] => new InfixToPostfixConverter($this->prioritizes_operator),

            [ExpressionNotation::Prefix, ExpressionNotation::Infix] => new PrefixToInfixConverter(),
            [ExpressionNotation::Prefix, ExpressionNotation::Postfix] => new PrefixToPostfixConverter(),

            [ExpressionNotation::Postfix, ExpressionNotation::Infix] => new PostfixToInfixConverter(),
            [ExpressionNotation::Postfix, ExpressionNotation::Prefix] => (new PostfixToPrefixConverter($this->prioritizes_operator)),

            default => throw new UnsupportedConversionException($from, $to),
        };
    }
}
