<?php

declare(strict_types=1);

namespace Filczek\PhpPolishNotation\Core\Helpers;

final readonly class ArrayHelper
{
    /**
     * Return an array with elements in reverse order.
     *
     * @param array $array The input array.
     * @param bool $preserve_keys [optional] If set to true keys are preserved.
     * @return array the reversed array.
     */
    public function deepReverse(array $array, bool $preserve_keys = false): array
    {
        $reversed = array_reverse($array, $preserve_keys);

        for ($i = 0; $i < count($reversed); $i++) {
            $element = $reversed[$i];

            if (is_array($element)) {
                $reversed[$i] = $this->deepReverse($element, $preserve_keys);
            }
        }

        return $reversed;
    }
}
