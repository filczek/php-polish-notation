<?php

declare(strict_types=1);

namespace Filczek\PhpPolishNotation\Expressions\MathematicalExpression;

use Filczek\PhpPolishNotation\Core\Priorities\PrioritizesOperator;

final readonly class MathematicalOperatorPriority implements PrioritizesOperator
{
    private const HIGHEST_PRIORITY = 3;
    private const LOWEST_PRIORITY = 0;

    public function priorityOf(mixed $operator): int
    {
        if (false === $operator instanceof MathematicalOperators) {
            $operator = is_string($operator)
                ? MathematicalOperators::tryFrom($operator)
                : null;
        }

        return match ($operator) {
            MathematicalOperators::Exponentiation => self::HIGHEST_PRIORITY,
            MathematicalOperators::Multiplication, MathematicalOperators::Division => 2,
            MathematicalOperators::Addition, MathematicalOperators::Subtraction => 1,
            default => self::LOWEST_PRIORITY,
        };
    }

    public function hasHighestPriority(mixed $operator): bool
    {
        return self::HIGHEST_PRIORITY === $this->priorityOf($operator);
    }

    public function hasLowestPriority(mixed $operator): bool
    {
        return self::LOWEST_PRIORITY === $this->priorityOf($operator);
    }
}
