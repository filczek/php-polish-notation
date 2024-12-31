<?php

declare(strict_types=1);

namespace Filczek\PhpPolishNotation\Core\Expression\Classifier;

use Filczek\PhpPolishNotation\Core\Expression\ExpressionElement;
use Filczek\PhpPolishNotation\Core\Expression\ExpressionElementType;
use Filczek\PhpPolishNotation\Core\Expression\ExpressionNotation;

final readonly class DefaultExpressionClassifier implements ClassifiesExpression
{
    public function notationOf(array $expression): ExpressionNotation
    {
        if ($this->isPrefix($expression)) {
            return ExpressionNotation::Prefix;
        }

        if ($this->isPostfix($expression)) {
            return ExpressionNotation::Postfix;
        }

        return ExpressionNotation::Infix;
    }

    public function isPrefix(array $expression): bool
    {
        /** @var ExpressionElement|ExpressionElement[]|null $first_element */
        $first_element = $expression[array_key_first($expression)] ?? null;
        if (null === $first_element) {
            return false;
        }

        // [ ['+', ... ], ... ]
        if (is_array($first_element)) {
            return $this->isPrefix($first_element);
        }

        if ($first_element->type === ExpressionElementType::Operator) {
            return true;
        }

        return false;
    }

    public function isPostfix(array $expression): bool
    {
        /** @var ExpressionElement|ExpressionElement[]|null $last_element */
        $last_element = $expression[array_key_last($expression)] ?? null;
        if (null === $last_element) {
            return false;
        }

        // [ ..., [..., '+'] ]
        if (is_array($last_element)) {
            return $this->isPostfix($last_element);
        }

        if ($last_element->type === ExpressionElementType::Operator) {
            return true;
        }

        return false;
    }
}
