<?php

declare(strict_types=1);

namespace Filczek\PhpPolishNotation\Core\Expression;

use BackedEnum;
use Stringable;

interface Expression extends Stringable
{
    public function notation(): BackedEnum;

    public function toString(): string;

    public function toArray(): array;
}
