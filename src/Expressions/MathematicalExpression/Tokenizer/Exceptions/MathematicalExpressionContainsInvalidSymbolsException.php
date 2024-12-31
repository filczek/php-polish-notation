<?php

declare(strict_types=1);

namespace Filczek\PhpPolishNotation\Expressions\MathematicalExpression\Tokenizer\Exceptions;

final class MathematicalExpressionContainsInvalidSymbolsException extends InvalidMathematicalExpressionException
{
    private array $invalid_symbols;

    public function __construct(array $invalid_symbols)
    {
        $this->invalid_symbols = $invalid_symbols;

        $invalid_symbols = array_map(fn ($symbol) => "'$symbol'", $invalid_symbols);
        $invalid_symbols = implode(', ', $invalid_symbols);
        $message = "Cannot tokenize Mathematical String! String contains invalid symbols ($invalid_symbols).";

        parent::__construct($message);
    }

    public function invalidSymbols(): array
    {
        return $this->invalid_symbols;
    }
}
