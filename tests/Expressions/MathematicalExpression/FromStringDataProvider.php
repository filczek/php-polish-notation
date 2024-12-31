<?php

declare(strict_types=1);

namespace Filczek\PhpPolishNotation\Expressions\MathematicalExpression;

use Filczek\PhpPolishNotation\Core\Expression\ExpressionElement;
use Filczek\PhpPolishNotation\Core\Expression\ExpressionElementType;
use Filczek\PhpPolishNotation\Core\Expression\ExpressionNotation;
use Filczek\PhpPolishNotation\MathNotationDataProvider;
use Generator;

final class FromStringDataProvider
{
    public static function edgeCases(): Generator
    {
        yield 'empty string' => [
            'expression' => '',
            'expression_without_parentheses' => '',
            'elements' => [],
            'notation' => ExpressionNotation::Infix,
        ];

        yield 'supports unicode: zażółć + gęślą * jaźń' => [
            'expression' => 'zażółć + gęślą * jaźń',
            'expression_without_parentheses' => 'zażółć + gęślą * jaźń',
            'elements' => [
                new ExpressionElement("zażółć", ExpressionElementType::Operand),
                new ExpressionElement("+", ExpressionElementType::Operator),
                new ExpressionElement("gęślą", ExpressionElementType::Operand),
                new ExpressionElement("*", ExpressionElementType::Operator),
                new ExpressionElement("jaźń", ExpressionElementType::Operand),
            ],
            'notation' => ExpressionNotation::Infix,
        ];
    }

    public static function mathNotation(): Generator
    {
        foreach (MathNotationDataProvider::data() as $item) {
            foreach ($item as $key => $element) {
                yield "from '$key' math notation: {$element['string_expression']}" => [
                    'expression' => $element['string_expression'],
                    'expression_without_parentheses' => $element['string_expression_without_parentheses'],
                    'elements' => $element['array_expression'],
                    'notation' => ExpressionNotation::from($key),
                ];
            }
        }
    }

    public static function convertsTo(): Generator
    {
        foreach (MathNotationDataProvider::data() as $item) {
            foreach ($item as $key => $element) {
                yield "from '$key' math notation: {$element['string_expression']}" => [
                    'expression' => $element['string_expression'],
                    'infix' => $item['infix'],
                    'prefix' => $item['prefix'],
                    'postfix' => $item['postfix'],
                ];
            }
        }
    }

    public static function unsupportedCharacters(): Generator
    {
        yield 'emoji' => [
            'expression' => '😀',
        ];

        yield "invalid operator: 2 @ 2" => [
            'expression' => '2 @ 2',
        ];

        yield "invalid operator: 2 + 2 ' 5" => [
            'expression' => "2 + 2 ' 5",
        ];
    }

    public static function unsupportedAsciiCharacters(): Generator
    {
        $supported_operators = MathematicalOperators::operators();

        $ascii_characters = [];
        for ($i = 0; $i <= 255; $i++) {
            // null character
            if ($i === 0) {
                continue;
            }

            if ($i >= 9 && $i <= 13) {
                continue;
            }

            // space
            if ($i === 32) {
                continue;
            }

            // ( )
            if ($i >= 40 && $i <= 41) {
                continue;
            }

            // .0-9
            if ($i >= 46 && $i <= 57) {
                continue;
            }

            // A-Za-z
            if (($i >= 65 && $i <= 90) || ($i >= 97 && $i <= 122)) {
                continue;
            }

            $char = chr($i);
            if (empty($char)) {
                continue;
            }

            if (in_array($char, $supported_operators, true)) {
                continue;
            }

            $ascii_characters[$i] = $char;
        }

        foreach ($ascii_characters as $char) {
            $ord = ord($char);
            yield "ascii character: $char ($ord)}" => ['expression' => $char];
        }
    }
}
