<?php

declare(strict_types=1);

namespace Filczek\PhpPolishNotation\Core\Expression\Classifier;

use BackedEnum;

interface ClassifiesExpression
{
    public function notationOf(array $expression): BackedEnum;
}
