<?php

declare(strict_types=1);

namespace Filczek\PhpPolishNotation\Expressions\MathematicalExpression\Tokenizer\Exceptions;

final class MathematicalExpressionPatternInvalidException extends InvalidMathematicalExpressionException
{
    public function __construct(string $pattern)
    {
        $last_error_message = preg_last_error_msg();

        parent::__construct("Failed to tokenize Mathematical String! Pattern '$pattern' is invalid. - '$last_error_message'");
    }
}
