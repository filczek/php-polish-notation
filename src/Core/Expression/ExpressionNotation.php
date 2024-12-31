<?php

declare(strict_types=1);

namespace Filczek\PhpPolishNotation\Core\Expression;

enum ExpressionNotation: string
{
    case Infix = "infix";
    case Prefix = "prefix";
    case Postfix = "postfix";
}
