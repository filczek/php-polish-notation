<?php

declare(strict_types=1);

namespace Filczek\PhpPolishNotation\Expressions\MathematicalExpression;

use Filczek\PhpPolishNotation\Core\Expression\ExpressionNotation;
use Filczek\PhpPolishNotation\Expressions\MathematicalExpression\Tokenizer\Exceptions\InvalidMathematicalExpressionException;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class MathematicalExpressionTest extends TestCase
{
    #[Test]
    #[DataProviderExternal(FromStringDataProvider::class, 'edgeCases')]
    #[DataProviderExternal(FromStringDataProvider::class, 'mathNotation')]
    public function fromString(
        string $expression,
        string $expression_without_parentheses,
        array $elements,
        ExpressionNotation $notation,
    ): void {
        $actual = MathematicalExpression::fromString($expression);

        $this->assertSame($expression, $actual->withParentheses()->toString());
        $this->assertSame($expression_without_parentheses, $actual->withoutParentheses()->toString());
        $this->assertEquals($elements, $actual->toArray());
        $this->assertSame($notation, $actual->notation());
    }

    #[Test]
    #[DataProviderExternal(FromStringDataProvider::class, 'unsupportedCharacters')]
    #[DataProviderExternal(FromStringDataProvider::class, 'unsupportedAsciiCharacters')]
    public function fromStringWithInvalidCharacters(string $expression): void
    {
        $this->expectException(InvalidMathematicalExpressionException::class);

        MathematicalExpression::fromString($expression);
    }

    #[Test]
    #[DataProviderExternal(FromStringDataProvider::class, 'convertsTo')]
    public function convertsTo(string $expression, array $infix, array $prefix, array $postfix): void
    {
        $actual = MathematicalExpression::fromString($expression);

        $to_infix = $actual->toInfix();
        $to_prefix = $actual->toPrefix();
        $to_postfix = $actual->toPostfix();

        $this->assertSame($infix['string_expression'], $to_infix->toString());
        $this->assertSame($prefix['string_expression'], $to_prefix->toString());
        $this->assertSame($postfix['string_expression'], $to_postfix->toString());
    }
}
