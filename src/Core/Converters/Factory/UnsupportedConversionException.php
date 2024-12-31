<?php

declare(strict_types=1);

namespace Filczek\PhpPolishNotation\Core\Converters\Factory;

use BackedEnum;
use Exception;

final class UnsupportedConversionException extends Exception
{
    public function __construct(BackedEnum $from, BackedEnum $to)
    {
        parent::__construct("Conversion from '$from->value' to '$to->value' is not supported!");
    }
}
