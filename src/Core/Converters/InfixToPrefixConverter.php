<?php

declare(strict_types=1);

namespace Filczek\PhpPolishNotation\Core\Converters;

use Filczek\PhpPolishNotation\Core\Expression\ExpressionElement;
use Filczek\PhpPolishNotation\Core\Expression\ExpressionElementType;
use Filczek\PhpPolishNotation\Core\Helpers\ArrayHelper;
use Filczek\PhpPolishNotation\Core\Priorities\PrioritizesOperator;

final readonly class InfixToPrefixConverter implements NotationConverter
{
    public function __construct(
        private PrioritizesOperator $prioritizes_operator,
    ) {
    }

    public function convert(array $expression): array
    {
        $array_helper = new ArrayHelper();

        $expression = $array_helper->deepReverse($expression);

        $postfix = $this->toPostfix($expression);

        $prefix = $array_helper->deepReverse($postfix);

        return $prefix;
    }

    private function toPostfix(array $expression): array
    {
        $operators = [];

        $output = [];
        for ($i = 0; $i < count($expression); $i++) {
            /** @var ExpressionElement $element */
            $element = $expression[$i];

            if (is_array($element)) {
                $output[] = $this->toPostfix($element);
                continue;
            }

            if ($element->type === ExpressionElementType::Operand) {
                $output[] = $element;
                continue;
            }

            if ($element->type === ExpressionElementType::Operator) {
                if ($this->prioritizes_operator->hasHighestPriority($element->value)) {
                    while ($this->prioritizes_operator->priorityOf($element->value) <= $this->prioritizes_operator->priorityOf($operators[count($operators) - 1]?->value)) {
                        $output[] = array_pop($operators);
                    }
                } else {
                    while ($this->prioritizes_operator->priorityOf($element->value) < $this->prioritizes_operator->priorityOf($operators[count($operators) - 1]?->value)) {
                        $output[] = array_pop($operators);
                    }
                }

                $operators[] = $element;
                continue;
            }
        }

        while (!empty($operators)) {
            $output[] = array_pop($operators);
        }

        return $output;
    }
}
