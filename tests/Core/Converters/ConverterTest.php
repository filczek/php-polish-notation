<?php

declare(strict_types=1);

namespace Filczek\PhpPolishNotation\Core\Converters;

use Filczek\PhpPolishNotation\Expressions\MathematicalExpression\MathematicalOperatorPriority;
use Filczek\PhpPolishNotation\MathNotationDataProvider;
use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class ConverterTest extends TestCase
{
    #[Test]
    #[DataProvider('convertExamples')]
    public function convert(array $infix, array $prefix, array $postfix): void
    {
        // Act
        $infix_to_prefix = $this->infix_to_prefix()->convert($infix['array_expression']);
        $prefix_to_infix = $this->prefix_to_infix()->convert($infix_to_prefix);

        $infix_to_postfix = $this->infix_to_postfix()->convert($infix['array_expression']);
        $postfix_to_infix = $this->postfix_to_infix()->convert($infix_to_postfix);

        $prefix_to_postfix = $this->prefix_to_postfix()->convert($infix_to_prefix);

        // Assert
        $this->assertSame(json_encode($prefix['array_expression'], JSON_PRETTY_PRINT), json_encode($infix_to_prefix, JSON_PRETTY_PRINT));
        $this->assertSame(json_encode($infix['array_expression'], JSON_PRETTY_PRINT), json_encode($prefix_to_infix, JSON_PRETTY_PRINT));

        $this->assertSame(json_encode($postfix['array_expression'], JSON_PRETTY_PRINT), json_encode($infix_to_postfix, JSON_PRETTY_PRINT));
        $this->assertSame(json_encode($infix['array_expression'], JSON_PRETTY_PRINT), json_encode($postfix_to_infix, JSON_PRETTY_PRINT));

        $this->assertSame(json_encode($postfix['array_expression'], JSON_PRETTY_PRINT), json_encode($prefix_to_postfix, JSON_PRETTY_PRINT));
    }

    public static function convertExamples(): Generator
    {
        foreach (MathNotationDataProvider::data() as $item) {
            yield $item['infix']['string_expression'] => [
                'infix' => $item['infix'],
                'prefix' => $item['prefix'],
                'postfix' => $item['postfix'],
            ];
        }
    }

    public function infix_to_prefix(): NotationConverter
    {
        return new InfixToPrefixConverter(
            prioritizes_operator: new MathematicalOperatorPriority(),
        );
    }

    public function prefix_to_infix(): NotationConverter
    {
        return new PrefixToInfixConverter();
    }

    public function infix_to_postfix(): NotationConverter
    {
        return new InfixToPostfixConverter(
            prioritizes_operator: new MathematicalOperatorPriority(),
        );
    }

    public function postfix_to_infix(): NotationConverter
    {
        return new PostfixToInfixConverter();
    }

    public function prefix_to_postfix(): NotationConverter
    {
        return new PrefixToPostfixConverter();
    }
}
