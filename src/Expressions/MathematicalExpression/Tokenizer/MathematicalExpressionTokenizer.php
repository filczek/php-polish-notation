<?php

declare(strict_types=1);

namespace Filczek\PhpPolishNotation\Expressions\MathematicalExpression\Tokenizer;

use Filczek\PhpPolishNotation\Core\Expression\ExpressionElement;
use Filczek\PhpPolishNotation\Core\Expression\ExpressionElementType;
use Filczek\PhpPolishNotation\Expressions\MathematicalExpression\MathematicalOperators;
use Filczek\PhpPolishNotation\Expressions\MathematicalExpression\Tokenizer\Exceptions\InvalidMathematicalExpressionException;
use Filczek\PhpPolishNotation\Expressions\MathematicalExpression\Tokenizer\Exceptions\MathematicalExpressionContainsInvalidSymbolsException;
use Filczek\PhpPolishNotation\Expressions\MathematicalExpression\Tokenizer\Exceptions\MathematicalExpressionPatternInvalidException;

final readonly class MathematicalExpressionTokenizer
{
    /**
     * Transforms mathematical expression to array of ExpressionElement.
     *
     * @param string $string
     * @return (ExpressionElement|ExpressionElement[])[]
     * @throws InvalidMathematicalExpressionException
     * @throws MathematicalExpressionPatternInvalidException
     * @throws MathematicalExpressionContainsInvalidSymbolsException
     */
    public function parse(string $string): array
    {
        $this->throwIfContainsInvalidSymbols($string);

        $tokens = $this->tokenize($string);

        return $this->buildExpression($tokens);
    }

    private function throwIfContainsInvalidSymbols(string $string): void
    {
        $matches = [];

        $pattern = "/{$this->buildInversePattern()}/u";
        if (false === preg_match_all($pattern, $string, $matches)) {
            throw new MathematicalExpressionPatternInvalidException($pattern);
        }

        $invalid_symbols = array_filter(
            array: array_map('trim', $matches[0]),
            callback: fn ($token) => $token !== '',
        );

        if (empty($invalid_symbols)) {
            return;
        }

        throw new MathematicalExpressionContainsInvalidSymbolsException($invalid_symbols);
    }

    private function buildInversePattern(): string
    {
        return "(?:(?!{$this->buildPattern()}).)";
    }

    private function buildPattern(): string
    {
        $operators = MathematicalOperators::operators();
        $parentheses = ["(", ")"];

        $mathematical_symbols = [...$operators, ...$parentheses];
        $mathematical_symbols = array_map(fn (string $symbol) => "\\$symbol", $mathematical_symbols);
        $mathematical_symbols = implode("", $mathematical_symbols);

        // Match words, numbers and given mathematical symbols.
        return '(\d+(\.\d+)?|\.\d+|[^\W_]+|[' . $mathematical_symbols . ']|\s+)';
    }

    private function tokenize(string $string): array
    {
        $pattern = "/{$this->buildPattern()}/u";

        $matches = [];
        if (false === preg_match_all($pattern, $string, $matches)) {
            throw new MathematicalExpressionPatternInvalidException($pattern);
        }

        // remove empty strings
        return array_filter(
            array: array_map('trim', $matches[0]),
            callback: fn ($token) => $token !== '',
        );
    }

    private function buildExpression(array &$tokens): array
    {
        $elements = [];

        while (!empty($tokens)) {
            $token = array_shift($tokens);

            if ($token === '(') {
                // Start of a sub-expression.
                $elements[] = $this->buildExpression($tokens);
                continue;
            } elseif ($token === ')') {
                // End of a sub-expression.
                break;
            }

            $element_type = MathematicalOperators::tryFrom($token)
                ? ExpressionElementType::Operator
                : ExpressionElementType::Operand;

            $elements[] = new ExpressionElement($token, $element_type);
        }

        return $elements;
    }
}
