<?php

declare(strict_types=1);

namespace Filczek\PhpPolishNotation\Core\Expression\Stringifier;

final readonly class WithParenthesesExpressionStringifier implements StringifiesExpression
{
    public function stringify(array $expression): string
    {
        $output = "";

        foreach ($expression as $element) {
            if (is_array($element)) {
                $output .= "(" . $this->stringify($element) . ") ";
                continue;
            }

            $output .= $element->value . " ";
        }

        $output = trim($output);

        return $output;
    }
}
