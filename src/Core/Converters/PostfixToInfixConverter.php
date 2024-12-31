<?php

declare(strict_types=1);

namespace Filczek\PhpPolishNotation\Core\Converters;

use Filczek\PhpPolishNotation\Core\Expression\ExpressionElement;
use Filczek\PhpPolishNotation\Core\Expression\ExpressionElementType;

final readonly class PostfixToInfixConverter implements NotationConverter
{
    public function convert(array $expression): array
    {
        $stack = [];

        for ($i = 0; $i < count($expression); $i++) {
            /** @var ExpressionElement $element */
            $element = $expression[$i];

            if (is_array($element)) {
                $stack[] = $this->convert($element);
                continue;
            }

            if ($element->type === ExpressionElementType::Operand) {
                $stack[] = $element;
                continue;
            }

            if ($element->type === ExpressionElementType::Operator) {
                $operand1 = array_pop($stack);
                $operand2 = array_pop($stack);

                $stack[] = [$operand2, $element, $operand1];

                continue;
            }
        }

        return $stack[0];
    }
}
