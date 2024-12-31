<?php

declare(strict_types=1);

namespace Filczek\PhpPolishNotation\Core\Expression;

enum ExpressionElementType: string
{
    case Operand = "operand";
    case Operator = "operator";
}
