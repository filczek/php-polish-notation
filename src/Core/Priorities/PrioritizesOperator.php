<?php

declare(strict_types=1);

namespace Filczek\PhpPolishNotation\Core\Priorities;

interface PrioritizesOperator
{
    public function priorityOf(mixed $operator): int;

    public function hasHighestPriority(mixed $operator): bool;

    public function hasLowestPriority(mixed $operator): bool;
}
