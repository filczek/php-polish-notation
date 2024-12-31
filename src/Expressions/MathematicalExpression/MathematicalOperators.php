<?php

declare(strict_types=1);

namespace Filczek\PhpPolishNotation\Expressions\MathematicalExpression;

enum MathematicalOperators: string
{
    case Addition = '+';
    case Subtraction = '-';
    case Multiplication = '*';
    case Division = '/';
    case Exponentiation = '^';

    /** @return array ['+', '-', '*', ...] */
    public static function operators(): array
    {
        return array_map(fn (\BackedEnum $enum) => $enum->value, self::cases());
    }
}
